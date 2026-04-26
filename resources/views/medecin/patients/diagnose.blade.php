@extends('layouts.medecin')

@section('title', 'Diagnostiquer une consultation')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-[#2d4e57] mb-6">Diagnostic pour {{ $consultation->patient->prenom }} {{ $consultation->patient->nom }}</h1>

    <div class="glass-card p-6 mb-6">
        <h2 class="text-xl font-semibold mb-3">Symptômes rapportés</h2>
        <p class="text-gray-700">{{ $consultation->symptomes ?: 'Aucun symptôme renseigné.' }}</p>
        @if($consultation->diagnostic_ia)
            <hr class="my-3">
            <h2 class="text-xl font-semibold mb-3">Prédiction IA</h2>
            <p class="text-gray-700">{{ $consultation->diagnostic_ia }}</p>
        @endif
    </div>

    <form method="POST" action="{{ route('medecin.patients.diagnose.store', $consultation) }}">
        @csrf
        <div class="glass-card p-6">
            <div class="mb-5">
                <label for="diagnostic_medecin" class="block font-medium mb-2">Diagnostic final *</label>
                <textarea name="diagnostic_medecin" id="diagnostic_medecin" rows="4" class="w-full px-4 py-3 rounded-2xl border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none" required>{{ old('diagnostic_medecin') }}</textarea>
                @error('diagnostic_medecin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <label for="recommandations" class="block font-medium mb-2">Recommandations (traitement, suivi, etc.)</label>
                <textarea name="recommandations" id="recommandations" rows="3" class="w-full px-4 py-3 rounded-2xl border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">{{ old('recommandations') }}</textarea>
                @error('recommandations') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('medecin.patients.show', $consultation->patient_id) }}" class="btn-soft-secondary bg-white/30 text-[#3a4e5e] border-white/70 mr-3">Annuler</a>
                <button type="submit" class="btn-soft-primary">Enregistrer le diagnostic</button>
            </div>
        </div>
    </form>
</div>
@endsection