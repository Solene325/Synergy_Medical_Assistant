@extends('layouts.medecin')

@section('title', 'Résumé IA · SynergyAI')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('medecin.patients.show', $patient) }}" class="text-warm-gray hover:text-primary transition">
            <i class="fas fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-3xl font-display font-bold text-primary">Résumé IA</h1>
    </div>

    <div class="glass-card p-6 space-y-6">
        <div>
            <h2 class="font-display font-semibold text-primary text-lg">Profil patient</h2>
            <div class="grid grid-cols-2 gap-2 text-sm mt-2">
                <p><span class="font-medium text-warm-gray">Nom :</span> {{ $patient->prenom }} {{ $patient->nom }}</p>
                <p><span class="font-medium text-warm-gray">Âge :</span> {{ $patient->age ?? '—' }} ans</p>
                <p><span class="font-medium text-warm-gray">Sexe :</span> {{ $patient->sexe_label ?? '—' }}</p>
                <p><span class="font-medium text-warm-gray">Groupe sanguin :</span> {{ $patient->groupe_sanguin ?? '—' }}</p>
            </div>
        </div>

        <div>
            <h2 class="font-display font-semibold text-primary text-lg">Antécédents</h2>
            <div class="bg-white/30 rounded-xl p-4 text-sm">
                <p><span class="font-medium">Personnels :</span> {{ $patient->antecedents_personnels ?: 'Aucun' }}</p>
                <p class="mt-2"><span class="font-medium">Familiaux :</span> {{ $patient->antecedents_familiaux ?: 'Aucun' }}</p>
            </div>
        </div>

        <div>
            <h2 class="font-display font-semibold text-primary text-lg">Allergies et traitements</h2>
            <div class="bg-white/30 rounded-xl p-4 text-sm">
                <p><span class="font-medium">Allergies :</span> {{ $patient->allergies ?: 'Aucune' }}</p>
                <p class="mt-2"><span class="font-medium">Traitements :</span> {{ $patient->traitements ?: 'Aucun' }}</p>
            </div>
        </div>

        <div>
            <h2 class="font-display font-semibold text-primary text-lg">Dernières consultations</h2>
            @forelse($patient->consultationsAsPatient()->latest()->take(5)->get() as $consult)
                <div class="bg-white/30 rounded-xl p-3 mt-2 text-sm">
                    <p class="font-medium">{{ $consult->created_at->format('d/m/Y') }} — {{ $consult->statut }}</p>
                    <p class="text-warm-gray">Symptômes : {{ $consult->symptomes ?: '—' }}</p>
                    @if($consult->diagnostic_medecin)
                        <p class="text-warm-gray">Diagnostic : {{ $consult->diagnostic_medecin }}</p>
                    @endif
                </div>
            @empty
                <p class="text-warm-gray/60">Aucune consultation récente.</p>
            @endforelse
        </div>

        <div>
            <h2 class="font-display font-semibold text-primary text-lg">Prescriptions en cours</h2>
            @forelse($patient->prescriptionsAsPatient()->where('statut', 'active')->get() as $presc)
                <div class="bg-white/30 rounded-xl p-3 mt-2 text-sm">
                    <p><span class="font-medium">{{ $presc->medicament->nom }}</span> — {{ $presc->posologie }}</p>
                    <p class="text-warm-gray">Prescrit par Dr. {{ $presc->medecin->prenom }} {{ $presc->medecin->nom }}</p>
                </div>
            @empty
                <p class="text-warm-gray/60">Aucune prescription active.</p>
            @endforelse
        </div>

        <div class="flex justify-end">
            <a href="{{ route('medecin.patients.show', $patient) }}" class="btn-primary text-sm">Retour à la fiche</a>
        </div>
    </div>
</div>
@endsection