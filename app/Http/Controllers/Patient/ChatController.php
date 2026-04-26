<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    private $groqApiKey;
    private $model;

    public function __construct()
    {
        $this->groqApiKey = env('GROQ_API_KEY');
        $this->model = env('MODEL_NAME', 'llama3-70b-8192'); // modèle valide Groq
    }

    public function index()
    {
        $history = session()->get('chat_history', []);
        return view('patient.chat', compact('history'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000'
        ]);

        $user = Auth::user();
        $userMessage = $request->input('message');

        // Construction du profil patient à partir de la base de données
        $patientProfile = $this->buildPatientProfile($user);

        // Historique de conversation (max 6 derniers tours)
        $history = session()->get('chat_history', []);
        $recentHistory = array_slice($history, -6);

        // Construction du prompt système enrichi
        $systemPrompt = $this->buildSystemPrompt($patientProfile);

        // Messages pour l'API
        $messages = [
            ['role' => 'system', 'content' => $systemPrompt]
        ];

        foreach ($recentHistory as $turn) {
            $messages[] = ['role' => 'user', 'content' => $turn['user']];
            $messages[] = ['role' => 'assistant', 'content' => $turn['assistant']];
        }
        $messages[] = ['role' => 'user', 'content' => $userMessage];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->groqApiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => $this->model,
                'messages' => $messages,
                'temperature' => 0.3,
                'max_tokens' => 1200,
                'response_format' => ['type' => 'json_object'] // Demander JSON
            ]);

            if (!$response->successful()) {
                Log::error('Groq API error', ['status' => $response->status(), 'body' => $response->body()]);
                return response()->json(['error' => 'Service temporairement indisponible. Veuillez réessayer.'], 500);
            }

            $content = $response->json()['choices'][0]['message']['content'];
            $parsed = json_decode($content, true);

            // Vérifier si le JSON est valide
            if (json_last_error() !== JSON_ERROR_NONE) {
                // Fallback : traiter comme texte brut
                $reply = $content;
                $diseases = [];
                $urgent = false;
            } else {
                $reply = $parsed['message'] ?? $parsed['conclusion'] ?? 'Analyse terminée.';
                $diseases = $parsed['diseases'] ?? [];
                $urgent = $parsed['urgent'] ?? false;
            }

            // Sauvegarder l'historique
            $history[] = [
                'user' => $userMessage,
                'assistant' => $reply,
                'diseases' => $diseases,
                'timestamp' => now()->toDateTimeString()
            ];
            session()->put('chat_history', $history);

            return response()->json([
                'reply' => $reply,
                'diseases' => $diseases,
                'urgent' => $urgent,
                'warning' => $urgent ? "⚠️ URGENCE POTENTIELLE : contactez un médecin ou appelez le 15." : null
            ]);

        } catch (\Exception $e) {
            Log::error('Chat exception', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Erreur de communication avec l’IA.'], 500);
        }
    }

    private function buildPatientProfile($user)
    {
        $profile = [];
        $profile['age'] = $user->age ?? ($user->date_naissance ? now()->diffInYears($user->date_naissance) : 'non renseigné');
        $profile['sexe'] = $user->sexe ?? ($user->gender ?? 'non renseigné');
        $profile['poids'] = $user->poids ? $user->poids . ' kg' : 'non renseigné';
        $profile['taille'] = $user->taille ? $user->taille . ' cm' : 'non renseigné';
        $profile['groupe_sanguin'] = $user->groupe_sanguin ?? 'non renseigné';
        $profile['antecedents_personnels'] = $user->antecedents_personnels ?? 'Aucun connu';
        $profile['antecedents_familiaux'] = $user->antecedents_familiaux ?? 'Aucun connu';

        return $profile;
    }

    private function buildSystemPrompt($profile)
    {
        return "Tu es un assistant médical expert. Tu reçois les symptômes d'un patient et tu dois produire **uniquement** un JSON valide avec cette structure :
{
  \"diseases\": [
    {\"name\": \"Maladie 1\", \"probability\": 75, \"advice\": \"Conseil personnalisé 1\"},
    {\"name\": \"Maladie 2\", \"probability\": 60, \"advice\": \"Conseil personnalisé 2\"},
    ...
  ],
  \"urgent\": false,
  \"message\": \"Message d'introduction ou conclusion (pas plus de 2 phrases)\"
}

Règles :
- Toujours 5 maladies maximum, classées par probabilité décroissante (0-100).
- Utilise les antécédents du patient pour affiner les probabilités et les conseils.
- Si un symptôme urgent est évoqué (douleur thoracique, difficulté respiratoire, perte de conscience, hémorragie...), mets \"urgent\": true.
- Les conseils doivent être précis, adaptés au profil (âge, poids, antécédents).
- Ne mentionne jamais de médicaments sur ordonnance sans avis médical.
- Réponds uniquement en JSON, sans texte avant ou après.

Profil patient :
- Âge : {$profile['age']} ans
- Sexe : {$profile['sexe']}
- Poids : {$profile['poids']}
- Taille : {$profile['taille']}
- Groupe sanguin : {$profile['groupe_sanguin']}
- Antécédents personnels : {$profile['antecedents_personnels']}
- Antécédents familiaux : {$profile['antecedents_familiaux']}
";
    }
}