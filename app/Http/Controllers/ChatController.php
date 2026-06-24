<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\Medicament;
use App\Models\DistributeurCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'patient') {
            $contacts = User::where('role', 'medecin')
                ->where(function ($q) use ($user) {
                    $q->whereHas('receivedMessages', fn($sub) => $sub->where('sender_id', $user->id))
                      ->orWhereHas('sentMessages', fn($sub) => $sub->where('receiver_id', $user->id));
                })->get();
        } else {
            $contacts = User::where('role', 'patient')
                ->where(function ($q) use ($user) {
                    $q->whereHas('receivedMessages', fn($sub) => $sub->where('sender_id', $user->id))
                      ->orWhereHas('sentMessages', fn($sub) => $sub->where('receiver_id', $user->id));
                })->get();
        }
        
        return view('chat.index', compact('contacts'));
    }
    
    public function conversation(User $user)
    {
        $authUser = Auth::user();
        
        $messages = Message::where(function ($q) use ($authUser, $user) {
            $q->where('sender_id', $authUser->id)->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($authUser, $user) {
            $q->where('sender_id', $user->id)->where('receiver_id', $authUser->id);
        })->orderBy('created_at')->get();
        
        // Marquer comme lus
        Message::where('receiver_id', $authUser->id)
              ->where('sender_id', $user->id)
              ->update(['is_read' => true, 'read_at' => now()]);
        
        // Récupérer les médicaments pour le formulaire de prescription
        $medicaments = Medicament::orderBy('nom')->get();
        
        return view('chat.conversation', compact('user', 'messages', 'medicaments'));
    }
    
    public function sendMessage(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);
        
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'message' => $request->message,
        ]);
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message->load('sender')
            ]);
        }
        
        return back()->with('success', 'Message envoyé.');
    }
    
    public function getNewMessages(User $user)
    {
        $lastId = request('last_message_id', 0);
        $newMessages = Message::where('sender_id', $user->id)
                              ->where('receiver_id', Auth::id())
                              ->where('id', '>', $lastId)
                              ->orderBy('created_at')
                              ->get();
        
        if ($newMessages->isNotEmpty()) {
            Message::whereIn('id', $newMessages->pluck('id'))
                   ->update(['is_read' => true, 'read_at' => now()]);
        }
        
        return response()->json($newMessages->load('sender'));
    }

    // --- NOUVELLES MÉTHODES ---

    public function storeDiagnosis(Request $request, User $user)
    {
        $request->validate([
            'diagnostic' => 'required|string',
            'recommandations' => 'nullable|string',
        ]);

        // Créer ou mettre à jour une consultation
        $consultation = Consultation::updateOrCreate(
            [
                'patient_id' => $user->id,
                'medecin_id' => Auth::id(),
                'statut' => 'en_attente', // on prend la première en attente
            ],
            [
                'diagnostic_medecin' => $request->diagnostic,
                'recommandations' => $request->recommandations,
                'statut' => 'traite',
            ]
        );

        // Envoyer un message automatique au patient
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'message' => "Diagnostic posé : " . $request->diagnostic . "\nRecommandations : " . ($request->recommandations ?? 'Aucune'),
        ]);

        return back()->with('success', 'Diagnostic enregistré et envoyé au patient.');
    }

    public function storePrescription(Request $request, User $user)
    {
        $request->validate([
            'medicament_id' => 'required|exists:medicaments,id',
            'posologie' => 'required|string|max:255',
            'instructions' => 'nullable|string',
            'duree_jours' => 'nullable|integer|min:1',
            'date_debut' => 'nullable|date',
        ]);

        $prescription = Prescription::create([
            'patient_id' => $user->id,
            'medecin_id' => Auth::id(),
            'medicament_id' => $request->medicament_id,
            'posologie' => $request->posologie,
            'instructions' => $request->instructions,
            'duree_jours' => $request->duree_jours,
            'date_debut' => $request->date_debut,
            'statut' => 'active',
        ]);

        // Générer le code distributeur
        $code = strtoupper(Str::random(8));
        DistributeurCode::create([
            'prescription_id' => $prescription->id,
            'code' => $code,
            'expires_at' => now()->addDays(30),
        ]);

        // Message automatique au patient
        $medicament = Medicament::find($request->medicament_id);
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'message' => "Nouvelle prescription : {$medicament->nom} - {$request->posologie}. Code distributeur : {$code} (valable 30 jours).",
        ]);

        return back()->with('success', 'Prescription enregistrée et code généré.');
    }

    public function videoCall(User $user)
    {
        return view('chat.video', compact('user'));
    }

    public function requestConsultation(Request $request, User $user)
    {
        $request->validate([
            'symptomes' => 'required|string|max:500',
        ]);

        // Le patient demande une consultation au médecin
        Consultation::create([
            'patient_id' => Auth::id(),
            'medecin_id' => $user->id,
            'symptomes' => $request->symptomes,
            'statut' => 'en_attente',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'message' => "Demande de consultation : " . $request->symptomes,
        ]);

        return back()->with('success', 'Demande de consultation envoyée au médecin.');
    }
}