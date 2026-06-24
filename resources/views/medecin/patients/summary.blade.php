@extends('layouts.medecin')

@section('title', 'Résumé IA du patient · SynergyAI')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('medecin.patients.show', $patient) }}" class="text-warm-gray hover:text-primary transition">
            <i class="fas fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-3xl font-display font-bold text-primary">Résumé IA</h1>
    </div>

    <div class="glass-card p-6 space-y-6">
        <!-- Informations patient -->
        <div>
            <h2 class="font-display font-semibold text-primary text-lg flex items-center gap-2">
                <i class="fas fa-user-circle text-accent"></i> Patient
            </h2>
            <div class="grid grid-cols-2 gap-2 text-sm mt-2">
                <p><span class="font-medium text-warm-gray">Nom :</span> {{ $patient->prenom }} {{ $patient->nom }}</p>
                <p><span class="font-medium text-warm-gray">Âge :</span> {{ $patient->age ?? '—' }} ans</p>
                <p><span class="font-medium text-warm-gray">Sexe :</span> {{ $patient->sexe_label ?? '—' }}</p>
                <p><span class="font-medium text-warm-gray">Groupe sanguin :</span> {{ $patient->groupe_sanguin ?? '—' }}</p>
                <p><span class="font-medium text-warm-gray">Poids :</span> {{ $patient->poids ?? '—' }} kg</p>
                <p><span class="font-medium text-warm-gray">Taille :</span> {{ $patient->taille ?? '—' }} cm</p>
            </div>
        </div>

        <hr class="border-white/30">

        <!-- Résumé médical généré par l'IA -->
        <div>
            <h2 class="font-display font-semibold text-primary text-lg flex items-center gap-2">
                <i class="fas fa-robot text-accent"></i> Résumé du chat IA
            </h2>
            <div class="bg-white/30 rounded-xl p-4 text-sm text-warm-gray leading-relaxed space-y-3">
                @if($medicalSummary)
                    <div>
                        <span class="font-semibold text-primary">Symptômes :</span>
                        <p class="mt-1">{{ $medicalSummary['symptomes'] ?? 'Aucun' }}</p>
                    </div>
                    <div>
                        <span class="font-semibold text-primary">Antécédents :</span>
                        <p class="mt-1">{{ $medicalSummary['antecedents'] ?? 'Aucun' }}</p>
                    </div>
                    <div>
                        <span class="font-semibold text-primary">Allergies :</span>
                        <p class="mt-1">{{ $medicalSummary['allergies'] ?? 'Aucune' }}</p>
                    </div>
                    <div>
                        <span class="font-semibold text-primary">Traitements :</span>
                        <p class="mt-1">{{ $medicalSummary['traitements'] ?? 'Aucun' }}</p>
                    </div>
                    @if(isset($medicalSummary['notes']))
                        <div>
                            <span class="font-semibold text-primary">Notes supplémentaires :</span>
                            <p class="mt-1">{{ $medicalSummary['notes'] }}</p>
                        </div>
                    @endif
                @else
                    <p class="text-warm-gray/60">Aucun résumé disponible. Le patient n'a pas encore utilisé le Chat IA.</p>
                @endif
            </div>
        </div>

        <!-- Bouton pour lancer une consultation -->
        <div class="flex justify-end gap-3 pt-4 border-t border-white/30">
            <a href="{{ route('chat.conversation', $patient) }}" class="btn-primary text-sm">
                <i class="fas fa-comment"></i> Discuter avec le patient
            </a>
            <a href="{{ route('medecin.patients.show', $patient) }}" class="btn-outline text-sm">
                <i class="fas fa-arrow-left"></i> Retour à la fiche
            </a>
        </div>
    </div>
</div>
@endsection