@extends('layouts.medecin')

@section('title', 'Fiche patient · SynergyAI')

@section('content')
<div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-3xl font-display font-bold text-primary">{{ $patient->prenom }} {{ $patient->nom }}</h1>
        <div class="flex gap-3">
            @if(!$patient->medecin_id || $patient->medecin_id != auth()->id())
                <form action="{{ route('medecin.patients.assign', $patient) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary text-sm !bg-accent hover:!bg-[#c46a37]">
                        <i class="fas fa-user-plus"></i> M'assigner ce patient
                    </button>
                </form>
            @endif
            <a href="{{ route('medecin.patients.resume', $patient) }}" class="btn-primary text-sm !bg-slate hover:!bg-[#1f4a63]">
                <i class="fas fa-file-alt"></i> Résumé IA
            </a>
            <a href="{{ route('medecin.patients.index') }}" class="btn-outline text-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <!-- Infos patient -->
    <div class="grid md:grid-cols-2 gap-6">
        <div class="glass-card p-6">
            <h2 class="text-xl font-display font-semibold text-primary mb-4">Informations personnelles</h2>
            <div class="space-y-2 text-sm">
                <p><span class="font-medium text-warm-gray">Email :</span> {{ $patient->email }}</p>
                <p><span class="font-medium text-warm-gray">Téléphone :</span> {{ $patient->telephone ?? '—' }}</p>
                <p><span class="font-medium text-warm-gray">Date de naissance :</span> {{ $patient->date_naissance ? \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y') : '—' }}</p>
                <p><span class="font-medium text-warm-gray">Âge :</span> {{ $patient->date_naissance ? \Carbon\Carbon::parse($patient->date_naissance)->age : '—' }} ans</p>
                <p><span class="font-medium text-warm-gray">Groupe sanguin :</span> {{ $patient->groupe_sanguin ?? '—' }}</p>
                @if($patient->medecin_id)
                    <p><span class="font-medium text-warm-gray">Médecin traitant :</span> 
                        <span class="text-primary font-medium">
                            {{ $patient->medecinTraitant->prenom ?? '' }} {{ $patient->medecinTraitant->nom ?? '' }}
                        </span>
                    </p>
                @endif
            </div>
        </div>
        <div class="glass-card p-6">
            <h2 class="text-xl font-display font-semibold text-primary mb-4">Données biométriques</h2>
            <div class="space-y-2 text-sm">
                <p><span class="font-medium text-warm-gray">Poids :</span> {{ $patient->poids ?? '—' }} kg</p>
                <p><span class="font-medium text-warm-gray">Taille :</span> {{ $patient->taille ?? '—' }} cm</p>
                <p><span class="font-medium text-warm-gray">Antécédents personnels :</span> {{ $patient->antecedents_personnels ?: 'Aucun' }}</p>
                <p><span class="font-medium text-warm-gray">Antécédents familiaux :</span> {{ $patient->antecedents_familiaux ?: 'Aucun' }}</p>
                <p><span class="font-medium text-warm-gray">Allergies :</span> {{ $patient->allergies ?: 'Aucune' }}</p>
                <p><span class="font-medium text-warm-gray">Traitements :</span> {{ $patient->traitements ?: 'Aucun' }}</p>
            </div>
        </div>
    </div>

    <!-- Consultations -->
    <div class="glass-card p-6">
        <div class="flex flex-wrap items-center justify-between mb-4">
            <h2 class="text-xl font-display font-semibold text-primary">Consultations</h2>
            <a href="#" class="text-sm text-accent hover:underline">+ Nouvelle consultation</a>
        </div>
        @forelse($consultations as $consult)
            <div class="border-b border-white/30 pb-3 mb-3 last:border-0">
                <div class="flex flex-wrap items-start justify-between">
                    <div>
                        <span class="font-medium text-primary">{{ $consult->created_at->format('d/m/Y H:i') }}</span>
                        <span class="ml-3 text-xs px-2 py-1 rounded-full 
                            {{ $consult->statut == 'en_attente' ? 'bg-yellow-100 text-yellow-700' : 'bg-soft-green text-green-700' }}">
                            {{ $consult->statut == 'en_attente' ? 'En attente' : 'Traité' }}
                        </span>
                    </div>
                    @if($consult->statut == 'en_attente')
                        <a href="{{ route('medecin.patients.diagnose', ['patient' => $consult->patient_id, 'consultation' => $consult->id]) }}" 
                           class="text-sm text-accent hover:underline">Diagnostiquer</a>
                    @endif
                </div>
                <p class="text-sm text-warm-gray mt-1"><strong>Symptômes :</strong> {{ $consult->symptomes ?: '—' }}</p>
                @if($consult->diagnostic_ia)
                    <p class="text-sm text-warm-gray"><strong>Prédiction IA :</strong> {{ $consult->diagnostic_ia }}</p>
                @endif
                @if($consult->diagnostic_medecin)
                    <p class="text-sm text-warm-gray"><strong>Diagnostic médecin :</strong> {{ $consult->diagnostic_medecin }}</p>
                @endif
                @if($consult->recommandations)
                    <p class="text-sm text-warm-gray"><strong>Recommandations :</strong> {{ $consult->recommandations }}</p>
                @endif
            </div>
        @empty
            <p class="text-warm-gray/60">Aucune consultation pour ce patient.</p>
        @endforelse
    </div>

    <!-- Prescriptions -->
    <div class="glass-card p-6">
        <div class="flex flex-wrap items-center justify-between mb-4">
            <h2 class="text-xl font-display font-semibold text-primary">Prescriptions</h2>
            <a href="{{ route('medecin.prescriptions.create', $patient) }}" class="btn-primary text-sm !py-1.5 !px-4">
                <i class="fas fa-plus"></i> Prescrire
            </a>
        </div>
        @forelse($prescriptions as $presc)
            <div class="flex flex-wrap items-center justify-between border-b border-white/30 py-2 last:border-0">
                <div>
                    <span class="font-medium text-primary">{{ $presc->medicament->nom }}</span>
                    <span class="text-sm text-warm-gray">— {{ $presc->posologie }}</span>
                    <span class="text-xs text-warm-gray/60 ml-2">{{ $presc->statut }}</span>
                </div>
                <div class="flex items-center gap-3">
                    @if($presc->distributeurCode && !$presc->distributeurCode->utilise)
                        <span class="text-xs px-2 py-1 bg-accent/10 text-accent rounded-full">Code: {{ $presc->distributeurCode->code }}</span>
                    @endif
                    <a href="{{ route('medecin.prescriptions.edit', $presc) }}" class="text-sm text-accent hover:underline">Modifier</a>
                    <form action="{{ route('medecin.prescriptions.destroy', $presc) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-sm text-red-400 hover:text-red-600" onclick="return confirm('Supprimer ?')">Supprimer</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-warm-gray/60">Aucune prescription.</p>
        @endforelse
    </div>
</div>
@endsection