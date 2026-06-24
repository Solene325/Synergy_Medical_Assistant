@extends('layouts.medecin')

@section('title', 'Diagnostiquer · SynergyAI')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('medecin.patients.show', $consultation->patient_id) }}" class="text-warm-gray hover:text-primary transition">
            <i class="fas fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-3xl font-display font-bold text-primary">Diagnostic pour {{ $consultation->patient->prenom }} {{ $consultation->patient->nom }}</h1>
    </div>

    <div class="glass-card p-6 mb-6">
        <h2 class="text-xl font-display font-semibold text-primary mb-3">Symptômes rapportés</h2>
        <p class="text-warm-gray">{{ $consultation->symptomes ?: 'Aucun symptôme renseigné.' }}</p>
        @if($consultation->diagnostic_ia)
            <hr class="my-3 border-white/30">
            <h2 class="text-xl font-display font-semibold text-primary mb-3">Prédiction IA</h2>
            <p class="text-warm-gray">{{ $consultation->diagnostic_ia }}</p>
        @endif
    </div>

    <form method="POST" action="{{ route('medecin.patients.diagnose.store', $consultation) }}">
        @csrf
        <div class="glass-card p-6 space-y-5">
            <div>
                <label for="diagnostic_medecin" class="block font-medium text-warm-gray mb-1">Diagnostic final *</label>
                <textarea name="diagnostic_medecin" id="diagnostic_medecin" rows="4" class="input-field w-full" required>{{ old('diagnostic_medecin') }}</textarea>
                @error('diagnostic_medecin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="recommandations" class="block font-medium text-warm-gray mb-1">Recommandations</label>
                <textarea name="recommandations" id="recommandations" rows="3" class="input-field w-full">{{ old('recommandations') }}</textarea>
                @error('recommandations') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-white/30">
                <a href="{{ route('medecin.patients.show', $consultation->patient_id) }}" class="btn-outline text-sm">Annuler</a>
                <button type="submit" class="btn-primary text-sm">Enregistrer</button>
            </div>
        </div>
    </form>
</div>
@endsection