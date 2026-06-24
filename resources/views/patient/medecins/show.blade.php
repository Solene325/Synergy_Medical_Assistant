@extends('layouts.chat')
@section('title', 'Dr. ' . $medecin->nom)
@section('content')
<div class="container mx-auto px-6 py-12 max-w-3xl">
    <div class="glass-card p-8">
        <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
            <!-- Photo -->
            <div class="w-40 h-40 rounded-full bg-white/50 flex items-center justify-center overflow-hidden border-4 border-white shadow-lg">
                @if($medecin->photo_profil)
                    <img src="{{ Storage::url($medecin->photo_profil) }}" class="w-full h-full object-cover">
                @else
                    <i class="fas fa-user-md text-7xl text-[#4f9da6]"></i>
                @endif
            </div>
            <!-- Infos -->
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-3xl font-bold">Dr. {{ $medecin->prenom }} {{ $medecin->nom }}</h1>
                <p class="text-xl text-[#4f9da6] mt-1">
                    <i class="fas fa-stethoscope mr-2"></i>
                    {{ $medecin->specialite ?? 'Généraliste' }}
                </p>
                <div class="mt-4 space-y-1 text-[#527a84]">
                    <p><i class="fas fa-envelope w-6"></i> {{ $medecin->email }}</p>
                    @if($medecin->telephone)
                        <p><i class="fas fa-phone w-6"></i> {{ $medecin->telephone }}</p>
                    @endif
                </div>
                <div class="mt-6 flex justify-center md:justify-start gap-4">
                    <a href="{{ route('chat.conversation', $medecin) }}" class="btn-soft-primary">
                        <i class="fas fa-comment-dots mr-2"></i> Envoyer un message
                    </a>
                    <a href="{{ route('patient.medecins.index') }}" class="btn-soft-secondary bg-white/30">
                        <i class="fas fa-arrow-left mr-2"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection