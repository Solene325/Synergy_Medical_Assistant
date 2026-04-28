@extends('layouts.medecin')
@section('title', 'Messagerie')

@section('content')
<div class="container mx-auto px-6 py-8 max-w-5xl">
    <h1 class="text-3xl font-bold text-[#2d4e57] mb-6">Messagerie</h1>

    <div class="glass-card p-0 overflow-hidden">
        @if($contacts->isEmpty())
            <div class="text-center py-12 text-gray-500">
                <i class="fas fa-comments text-5xl mb-3 opacity-30"></i>
                <p>Aucune conversation pour le moment.</p>
                @if(Auth::user()->role === 'patient')
                    <a href="{{ route('patient.medecins.index') }}" class="btn-soft-primary mt-4 inline-block">
                        Trouver un médecin
                    </a>
                @endif
            </div>
        @else
            <div class="divide-y divide-gray-100">
                @foreach($contacts as $contact)
                    <a href="{{ route('chat.conversation', $contact) }}" 
                       class="flex items-center gap-4 p-4 hover:bg-white/30 transition-colors">
                        <!-- Avatar -->
                        <div class="w-14 h-14 rounded-full bg-white/50 flex items-center justify-center overflow-hidden">
                            @if($contact->photo_profil)
                                <img src="{{ Storage::url($contact->photo_profil) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-{{ $contact->role === 'patient' ? 'user' : 'user-md' }} text-2xl text-[#4f9da6]"></i>
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-[#2d4e57]">
                                @if($contact->role === 'medecin') Dr. @endif{{ $contact->prenom }} {{ $contact->nom }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $contact->role === 'medecin' ? ($contact->specialite ?? 'Généraliste') : 'Patient' }}
                            </p>
                        </div>
                        <!-- Badge messages non lus -->
                        @php
                            $unreadCount = $contact->receivedMessages
                                ->where('receiver_id', Auth::id())
                                ->where('is_read', false)
                                ->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="bg-[#4f9da6] text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">
                                {{ $unreadCount }}
                            </span>
                        @else
                            <i class="fas fa-chevron-right text-gray-300"></i>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection