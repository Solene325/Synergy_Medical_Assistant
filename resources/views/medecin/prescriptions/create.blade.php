@extends('layouts.medecin')

@section('title', 'Nouvelle prescription')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-[#2d4e57] mb-6">Prescription pour {{ $patient->prenom }} {{ $patient->nom }}</h1>

    <form method="POST" action="{{ route('medecin.prescriptions.store', $patient) }}">
        @csrf
        <div class="glass-card p-6 space-y-5">
            <div>
                <label for="medicament_id" class="block font-medium mb-2">Médicament *</label>
                <select name="medicament_id" id="medicament_id" required class="w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                    <option value="">-- Sélectionnez --</option>
                    @foreach($medicaments as $med)
                        <option value="{{ $med->id }}" {{ old('medicament_id') == $med->id ? 'selected' : '' }}>{{ $med->nom }} ({{ $med->forme ?? 'n/a' }})</option>
                    @endforeach
                </select>
                @error('medicament_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="posologie" class="block font-medium mb-2">Posologie *</label>
                <input type="text" name="posologie" id="posologie" value="{{ old('posologie') }}" required class="w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                @error('posologie') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="instructions" class="block font-medium mb-2">Instructions supplémentaires</label>
                <textarea name="instructions" id="instructions" rows="2" class="w-full px-4 py-3 rounded-2xl border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">{{ old('instructions') }}</textarea>
                @error('instructions') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="duree_jours" class="block font-medium mb-2">Durée (jours)</label>
                    <input type="number" name="duree_jours" id="duree_jours" value="{{ old('duree_jours') }}" class="w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                </div>
                <div>
                    <label for="date_debut" class="block font-medium mb-2">Date de début</label>
                    <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut') }}" class="w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('medecin.patients.show', $patient) }}" class="btn-soft-secondary bg-white/30 text-[#3a4e5e] border-white/70 mr-3">Annuler</a>
                <button type="submit" class="btn-soft-primary">Prescrire</button>
            </div>
        </div>
    </form>
</div>
@endsection