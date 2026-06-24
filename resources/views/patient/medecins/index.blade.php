@extends('layouts.chat')
@section('title', 'Médecins disponibles')
@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-[#2d4e57] mb-6">Médecins disponibles</h1>
    
    <!-- Formulaire de filtre -->
    <form method="GET" class="mb-8 flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-medium mb-1">Spécialité</label>
            <select name="specialite" class="w-full px-4 py-3 rounded-full bg-white/70 border-0">
                <option value="">Toutes spécialités</option>
                @foreach($specialites as $spec)
                    <option value="{{ $spec }}" {{ request('specialite') == $spec ? 'selected' : '' }}>{{ $spec }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="btn-soft-primary">Filtrer</button>
        </div>
    </form>
    
    <!-- Liste des médecins -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($medecins as $medecin)
        <div class="glass-card p-6 text-center hover:scale-[1.02] transition-transform">
            <div class="w-28 h-28 mx-auto rounded-full bg-white/50 flex items-center justify-center mb-4 overflow-hidden border-2 border-[#4f9da6]/30">
                @if($medecin->photo_profil)
                    <img src="{{ Storage::url($medecin->photo_profil) }}" class="w-full h-full object-cover">
                @else
                    <i class="fas fa-user-md text-5xl text-[#4f9da6]"></i>
                @endif
            </div>
            <h3 class="text-xl font-semibold">Dr. {{ $medecin->prenom }} {{ $medecin->nom }}</h3>
            <p class="text-[#4f9da6] font-medium mt-1">
                <i class="fas fa-stethoscope mr-1"></i>
                {{ $medecin->specialite ?? 'Généraliste' }}
            </p>
            <p class="text-sm text-gray-500 mt-2">{{ $medecin->email }}</p>
            <div class="mt-5 flex justify-center gap-3">
                <a href="{{ route('patient.medecins.show', $medecin) }}" class="btn-soft-primary text-sm py-2 px-4">
                    <i class="fas fa-user-circle mr-1"></i> Profil
                </a>
                <a href="{{ route('chat.conversation', $medecin) }}" class="btn-soft-secondary text-sm py-2 px-4 bg-white/30">
                    <i class="fas fa-comment-dots mr-1"></i> Contacter
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-500">
            <i class="fas fa-user-md text-5xl mb-3 opacity-30"></i>
            <p>Aucun médecin trouvé pour cette spécialité.</p>
        </div>
        @endforelse
    </div>
    
    <div class="mt-10">
        {{ $medecins->withQueryString()->links() }}
    </div>
</div>
@endsection