@extends('layouts.medecin')

@section('title', 'Nouvelle prescription · SynergyAI')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('medecin.patients.show', $patient) }}" class="text-warm-gray hover:text-primary transition">
            <i class="fas fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-3xl font-display font-bold text-primary">Prescription pour {{ $patient->prenom }}</h1>
    </div>

    <form method="POST" action="{{ route('medecin.prescriptions.store', $patient) }}">
        @csrf
        <div class="glass-card p-6 space-y-5">
            <div>
                <label for="medicament_id" class="block font-medium text-warm-gray mb-1">Médicament *</label>
                <select name="medicament_id" id="medicament_id" required class="input-field w-full">
                    <option value="">Sélectionnez</option>
                    @foreach($medicaments as $med)
                        <option value="{{ $med->id }}" {{ old('medicament_id') == $med->id ? 'selected' : '' }}>
                            {{ $med->nom }} ({{ $med->forme ?? 'n/a' }})
                        </option>
                    @endforeach
                </select>
                @error('medicament_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="posologie" class="block font-medium text-warm-gray mb-1">Posologie *</label>
                <input type="text" name="posologie" id="posologie" value="{{ old('posologie') }}" required class="input-field w-full" placeholder="Ex: 1 comprimé matin et soir">
                @error('posologie') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="instructions" class="block font-medium text-warm-gray mb-1">Instructions supplémentaires</label>
                <textarea name="instructions" id="instructions" rows="2" class="input-field w-full" placeholder="Conseils, précautions...">{{ old('instructions') }}</textarea>
                @error('instructions') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="duree_jours" class="block font-medium text-warm-gray mb-1">Durée (jours)</label>
                    <input type="number" name="duree_jours" id="duree_jours" value="{{ old('duree_jours') }}" class="input-field w-full" placeholder="7">
                </div>
                <div>
                    <label for="date_debut" class="block font-medium text-warm-gray mb-1">Date de début</label>
                    <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut') }}" class="input-field w-full">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-white/30">
                <a href="{{ route('medecin.patients.show', $patient) }}" class="btn-outline text-sm">Annuler</a>
                <button type="submit" class="btn-primary text-sm">Prescrire</button>
            </div>
        </div>
    </form>
</div>
@endsection