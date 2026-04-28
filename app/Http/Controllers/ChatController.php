<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'patient') {
            // Le patient voit tous les médecins avec qui il a déjà échangé
            $contacts = User::where('role', 'medecin')
                ->where(function ($q) use ($user) {
                    $q->whereHas('receivedMessages', fn($sub) => $sub->where('sender_id', $user->id))
                      ->orWhereHas('sentMessages', fn($sub) => $sub->where('receiver_id', $user->id));
                })->get();
        } else {
            // Le médecin voit tous les patients avec qui il a échangé
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
        
        // Récupérer tous les messages entre les deux utilisateurs
        $messages = Message::where(function ($q) use ($authUser, $user) {
            $q->where('sender_id', $authUser->id)->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($authUser, $user) {
            $q->where('sender_id', $user->id)->where('receiver_id', $authUser->id);
        })->orderBy('created_at')->get();
        
        // Marquer comme lus les messages reçus de cet utilisateur
        Message::where('receiver_id', $authUser->id)
              ->where('sender_id', $user->id)
              ->update(['is_read' => true, 'read_at' => now()]);
        
        return view('chat.conversation', compact('user', 'messages'));
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
}