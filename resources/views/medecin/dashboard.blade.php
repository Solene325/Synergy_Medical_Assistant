@extends('layouts.medecin')

@section('title', 'Tableau de bord · SynergyAI')

@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-display font-bold text-primary">Tableau de bord</h1>
        <p class="text-warm-gray">Bonjour Dr. {{ auth()->user()->prenom }} {{ auth()->user()->nom }}, bienvenue !</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <i class="fas fa-clock text-4xl text-accent"></i>
                <span class="text-3xl font-bold text-primary">{{ $consultationsEnAttente ?? 0 }}</span>
            </div>
            <p class="mt-3 text-warm-gray text-sm">Consultations en attente</p>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <i class="fas fa-prescription-bottle text-4xl text-gold"></i>
                <span class="text-3xl font-bold text-primary">{{ $prescriptionsActives ?? 0 }}</span>
            </div>
            <p class="mt-3 text-warm-gray text-sm">Prescriptions actives</p>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <i class="fas fa-user-friends text-4xl text-slate"></i>
                <span class="text-3xl font-bold text-primary">{{ $patientsUniques ?? 0 }}</span>
            </div>
            <p class="mt-3 text-warm-gray text-sm">Patients suivis</p>
        </div>
    </div>

    <div class="glass-card p-6">
        <h2 class="text-xl font-display font-semibold text-primary mb-4">Dernières consultations</h2>
        @forelse(auth()->user()->consultationsAsMedecin()->latest()->limit(5)->get() as $consult)
            <div class="flex flex-wrap items-center justify-between border-b border-white/30 py-3 last:border-0">
                <div>
                    <p class="font-medium text-primary">{{ $consult->patient->prenom }} {{ $consult->patient->nom }}</p>
                    <p class="text-sm text-warm-gray">{{ $consult->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs px-2 py-1 rounded-full 
                        {{ $consult->statut == 'en_attente' ? 'bg-yellow-100 text-yellow-700' : 'bg-soft-green text-green-700' }}">
                        {{ $consult->statut == 'en_attente' ? 'En attente' : 'Traité' }}
                    </span>
                    @if($consult->statut == 'en_attente')
                        <a href="{{ route('medecin.patients.diagnose', ['patient' => $consult->patient_id, 'consultation' => $consult->id]) }}" 
                           class="text-sm text-accent hover:underline">Diagnostiquer</a>
                    @else
                        <a href="{{ route('medecin.patients.show', $consult->patient_id) }}" 
                           class="text-sm text-accent hover:underline">Voir détails</a>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-warm-gray/60">Aucune consultation récente.</p>
        @endforelse
    </div>
</div>
@endsection