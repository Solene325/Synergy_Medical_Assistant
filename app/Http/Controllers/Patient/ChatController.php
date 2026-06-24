<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    private $groqApiKey;
    private $model;

    public function __construct()
    {
        $this->groqApiKey = env('GROQ_API_KEY');
        $this->model = env('MODEL_NAME', 'llama-3.1-8b-instant');
    }

    public function index()
    {
        $user = Auth::user();
        $history = Session::get('chat_history', []);
        $medicalSummary = Session::get('medical_summary', $this->generateInitialSummary($user));
        return view('patient.chat', compact('history', 'medicalSummary'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'lang' => 'nullable|string|in:fr,ar'
        ]);

        $user = Auth::user();
        $userMessage = $request->input('message');
        $lang = $request->input('lang', 'fr');

        $patientProfile = $this->buildPatientProfile($user);
        $history = Session::get('chat_history', []);
        // Augmentation du contexte à 15 messages récents
        $recentHistory = array_slice($history, -15);

        $systemPrompt = $this->buildSystemPrompt($patientProfile, $lang);

        $messages = [
            ['role' => 'system', 'content' => $systemPrompt]
        ];

        foreach ($recentHistory as $turn) {
            $messages[] = ['role' => 'user', 'content' => $turn['user']];
            $messages[] = ['role' => 'assistant', 'content' => $turn['assistant']];
        }
        $messages[] = ['role' => 'user', 'content' => $userMessage];

        try {
            if (empty($this->groqApiKey) || $this->groqApiKey === 'your_api_key_here') {
                Log::error('Groq API key is not set');
                return $this->fallbackResponse('Clé API non configurée.', $user);
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->groqApiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => $this->model,
                'messages' => $messages,
                'temperature' => 0.3,
                'max_tokens' => 1200,
            ]);

            if (!$response->successful()) {
                Log::error('Groq API error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return $this->fallbackResponse('Je rencontre des difficultés techniques.', $user, $userMessage);
            }

            $content = $response->json()['choices'][0]['message']['content'] ?? '';
            Log::info('Réponse brute Groq : ' . $content);

            // Extraction JSON
            $jsonString = $this->extractJsonString($content);
            Log::info('JSON extrait : ' . $jsonString);

            $parsed = json_decode($jsonString, true);
            if ($parsed === null) {
                $jsonString = $this->repairJsonString($jsonString);
                Log::info('JSON réparé : ' . $jsonString);
                $parsed = json_decode($jsonString, true);
            }

            if ($parsed === null) {
                // Si toujours pas de JSON, on utilise le contenu brut
                $reply = $content;
                $diseases = [];
                $urgent = false;
                $summaryUpdate = null;
            } else {
                $reply = $parsed['message'] ?? $parsed['conclusion'] ?? 'Je vous ai écouté. Que puis-je faire pour vous aider ?';
                $diseases = $parsed['diseases'] ?? [];
                $urgent = $parsed['urgent'] ?? false;
                $summaryUpdate = $parsed['medical_summary_update'] ?? null;
            }

            // Mise à jour du résumé
            $medicalSummary = Session::get('medical_summary', $this->generateInitialSummary($user));
            if ($summaryUpdate) {
                $medicalSummary = $this->mergeSummary($medicalSummary, $summaryUpdate);
                Session::put('medical_summary', $medicalSummary);
                // Sauvegarde en base
                $user->medical_summary = $medicalSummary;
                $user->save();
            }

            // Historique
            $history[] = [
                'user' => $userMessage,
                'assistant' => $reply,
                'diseases' => $diseases,
                'urgent' => $urgent,
                'timestamp' => now()->toDateTimeString()
            ];
            Session::put('chat_history', $history);

            return response()->json([
                'reply' => $reply,
                'diseases' => $diseases,
                'urgent' => $urgent,
                'summary' => $medicalSummary,
                'warning' => $urgent ? "⚠️ URGENCE POTENTIELLE : contactez un médecin ou appelez le 15." : null
            ]);

        } catch (\Exception $e) {
            Log::error('Chat exception', ['message' => $e->getMessage()]);
            return $this->fallbackResponse('Je rencontre des difficultés techniques.', $user, $userMessage);
        }
    }

    /**
     * Extrait la chaîne JSON de la réponse (gère les backticks et le texte environnant)
     */
    private function extractJsonString($content)
    {
        $content = preg_replace('/```(?:json)?\s*/', '', $content);
        $content = trim($content, "` \t\n\r\0\x0B");

        $start = strpos($content, '{');
        if ($start === false) {
            return $content;
        }

        $depth = 0;
        $inString = false;
        $escape = false;
        $end = $start;
        for ($i = $start; $i < strlen($content); $i++) {
            $char = $content[$i];
            if ($escape) {
                $escape = false;
                continue;
            }
            if ($char === '\\') {
                $escape = true;
                continue;
            }
            if ($char === '"' && !$escape) {
                $inString = !$inString;
            }
            if (!$inString) {
                if ($char === '{') $depth++;
                if ($char === '}') {
                    $depth--;
                    if ($depth === 0) {
                        $end = $i;
                        break;
                    }
                }
            }
        }

        if ($end === $start) {
            return $content;
        }

        $jsonString = substr($content, $start, $end - $start + 1);
        $jsonString = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function($matches) {
            return mb_convert_encoding(pack('H*', $matches[1]), 'UTF-8', 'UTF-16BE');
        }, $jsonString);

        return $jsonString;
    }

    /**
     * Répare un JSON invalide (supprime les clés dupliquées et les virgules en trop)
     */
    private function repairJsonString($jsonString)
    {
        $pattern = '/"([^"]+)":\s*"([^"]*)"\s*(?=.*"\1":\s*"([^"]*)")/';
        while (preg_match($pattern, $jsonString)) {
            $jsonString = preg_replace($pattern, '', $jsonString);
        }

        $jsonString = preg_replace('/,\s*}/', '}', $jsonString);
        $jsonString = preg_replace('/,\s*]/', ']', $jsonString);
        $jsonString = preg_replace('/,\s*,/', ',', $jsonString);

        return $jsonString;
    }

    private function fallbackResponse($message, $user, $userMessage = null)
    {
        $medicalSummary = Session::get('medical_summary', $this->generateInitialSummary($user));
        
        if ($userMessage) {
            $history = Session::get('chat_history', []);
            $history[] = [
                'user' => $userMessage,
                'assistant' => $message,
                'diseases' => [],
                'urgent' => false,
                'timestamp' => now()->toDateTimeString()
            ];
            Session::put('chat_history', $history);
        }

        return response()->json([
            'reply' => $message,
            'diseases' => [],
            'urgent' => false,
            'summary' => $medicalSummary,
            'warning' => null
        ]);
    }

    private function buildPatientProfile($user)
    {
        return [
            'age' => $user->age ?? ($user->date_naissance ? now()->diffInYears($user->date_naissance) : 'non renseigné'),
            'sexe' => $user->sexe ?? ($user->gender ?? 'non renseigné'),
            'poids' => $user->poids ? $user->poids . ' kg' : 'non renseigné',
            'taille' => $user->taille ? $user->taille . ' cm' : 'non renseigné',
            'groupe_sanguin' => $user->groupe_sanguin ?? 'non renseigné',
            'allergies' => $user->allergies ?? 'Aucune connue',
            'traitements' => $user->traitements ?? 'Aucun traitement en cours',
            'antecedents_personnels' => $user->antecedents_personnels ?? 'Aucun connu',
            'antecedents_familiaux' => $user->antecedents_familiaux ?? 'Aucun connu',
            'medecin_nom' => $user->medecin_nom ?? 'Non renseigné',
            'medecin_telephone' => $user->medecin_telephone ?? 'Non renseigné'
        ];
    }

    /**
     * Nouveau prompt système bienveillant et questionneur
     */
    private function buildSystemPrompt($profile, $lang = 'fr')
    {
        $base = "Tu es un assistant médical bienveillant et empathique. Ton rôle est d'écouter le patient, de poser des questions pour comprendre ses symptômes (localisation, durée, intensité, facteurs aggravants/soulageants, antécédents, traitements en cours), et de le rassurer. Tu ne donnes jamais de diagnostic définitif. Tu formules des hypothèses prudentes uniquement lorsque tu as recueilli suffisamment d'informations (au moins 3 échanges sur les symptômes).\n";
        $base .= "Tu réponds en français (sauf si le patient parle arabe, auquel cas tu réponds en arabe).\n";
        $base .= "Structure ta réponse en JSON avec les clés suivantes :\n";
        $base .= "  - \"message\" : ta réponse textuelle au patient, bienveillante et claire.\n";
        $base .= "  - \"diseases\" : un tableau d'objets contenant 'name', 'probability' (entier 0-100), 'advice' (conseil simple). Ne le renseigne que si tu as assez d'éléments (au moins 3 échanges) et si tu as une hypothèse raisonnable. Sinon, laisse vide.\n";
        $base .= "  - \"urgent\" : true si tu détectes des signes d'urgence (douleur thoracique, détresse respiratoire, perte de connaissance, etc.), sinon false.\n";
        $base .= "  - \"medical_summary_update\" : un objet avec les champs 'symptomes', 'antecedents', 'allergies', 'traitements'. Mets à jour ces champs en fonction des informations recueillies, sans écraser les données précédentes.\n";
        $base .= "N'ajoute aucun texte hors du JSON. Sois précis et concis dans le message, mais n'hésite pas à poser des questions ouvertes pour approfondir.\n\n";

        $instructions = [
            'fr' => "Commence par saluer chaleureusement le patient. Pose des questions sur son ressenti général, puis sur les symptômes spécifiques. Reformule ses réponses pour montrer que tu écoutes. N'utilise pas de jargon médical complexe. Propose des conseils simples (repos, hydratation, etc.) si approprié.",
            'ar' => "ابدأ بتحية المريض بحرارة. اسأل عن شعوره العام، ثم عن الأعراض المحددة. أعد صياغة إجاباته لإظهار أنك تستمع. لا تستخدم مصطلحات طبية معقدة. قدم نصائح بسيطة (الراحة، الترطيب، إلخ) إذا كان ذلك مناسبًا."
        ];
        $langText = $instructions[$lang] ?? $instructions['fr'];

        return $base . $langText . "\n\nProfil patient (à utiliser pour personnaliser les questions) :\n" .
            "- Âge : {$profile['age']} ans\n" .
            "- Sexe : {$profile['sexe']}\n" .
            "- Poids : {$profile['poids']}\n" .
            "- Taille : {$profile['taille']}\n" .
            "- Groupe sanguin : {$profile['groupe_sanguin']}\n" .
            "- Allergies : {$profile['allergies']}\n" .
            "- Traitements : {$profile['traitements']}\n" .
            "- Antécédents personnels : {$profile['antecedents_personnels']}\n" .
            "- Antécédents familiaux : {$profile['antecedents_familiaux']}\n" .
            "- Médecin traitant : {$profile['medecin_nom']} ({$profile['medecin_telephone']})";
    }

    private function generateInitialSummary($user)
    {
        return [
            'symptomes' => 'Aucun symptôme décrit pour le moment.',
            'antecedents' => $user->antecedents_personnels ?? 'Aucun connu',
            'allergies' => $user->allergies ?? 'Aucune connue',
            'traitements' => $user->traitements ?? 'Aucun',
        ];
    }

    private function mergeSummary($current, $update)
    {
        if (is_string($update)) {
            $decoded = json_decode($update, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $update = $decoded;
            } else {
                $current['notes'] = ($current['notes'] ?? '') . "\n" . $update;
                return $current;
            }
        }
        foreach ($update as $key => $value) {
            if (!empty($value)) {
                $current[$key] = $value;
            }
        }
        return $current;
    }

    public function clearHistory()
    {
        Session::forget('chat_history');
        return response()->json(['success' => true]);
    }

    public function getHistory()
    {
        $history = Session::get('chat_history', []);
        return response()->json(['history' => $history]);
    }

    public function generateSummary()
    {
        $user = Auth::user();
        $summary = $user->medical_summary ?? Session::get('medical_summary', $this->generateInitialSummary($user));
        return response()->json(['summary' => $summary]);
    }
}