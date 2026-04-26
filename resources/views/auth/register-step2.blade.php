@extends('layouts.app')

@section('title', 'Inscription - Étape 2')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#f9f3e8]">
    <div class="max-w-2xl w-full glass-card p-8">
        <h2 class="text-3xl font-bold text-[#2d4e57] text-center mb-8">Inscription patient - Étape 2</h2>
        <p class="text-center text-[#527a84] mb-6">Vos données biométriques et antécédents</p>

        <form method="POST" action="{{ route('register.step2.post') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Date de naissance -->
                <div>
                    <label for="date_naissance" class="block text-sm font-medium text-[#4f6b73]">Date de naissance</label>
                    <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance') }}" required class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                    @error('date_naissance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Poids -->
                <div>
                    <label for="poids" class="block text-sm font-medium text-[#4f6b73]">Poids (kg)</label>
                    <input type="number" step="0.1" name="poids" id="poids" value="{{ old('poids') }}" required class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                    @error('poids') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Taille -->
                <div>
                    <label for="taille" class="block text-sm font-medium text-[#4f6b73]">Taille (cm)</label>
                    <input type="number" name="taille" id="taille" value="{{ old('taille') }}" required class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                    @error('taille') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Groupe sanguin -->
                <div>
                    <label for="groupe_sanguin" class="block text-sm font-medium text-[#4f6b73]">Groupe sanguin</label>
                    <select name="groupe_sanguin" id="groupe_sanguin" class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                        <option value="">-- Sélectionnez --</option>
                        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $g)
                            <option value="{{ $g }}" {{ old('groupe_sanguin') == $g ? 'selected' : '' }}>{{ $g }}</option>
                        @endforeach
                    </select>
                    @error('groupe_sanguin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Antécédents personnels -->
                <div class="col-span-2">
                    <label for="antecedents_personnels" class="block text-sm font-medium text-[#4f6b73]">Antécédents personnels</label>
                    <textarea name="antecedents_personnels" id="antecedents_personnels" rows="3" class="mt-1 block w-full px-4 py-3 rounded-2xl border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">{{ old('antecedents_personnels') }}</textarea>
                    @error('antecedents_personnels') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Antécédents familiaux -->
                <div class="col-span-2">
                    <label for="antecedents_familiaux" class="block text-sm font-medium text-[#4f6b73]">Antécédents familiaux</label>
                    <textarea name="antecedents_familiaux" id="antecedents_familiaux" rows="3" class="mt-1 block w-full px-4 py-3 rounded-2xl border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">{{ old('antecedents_familiaux') }}</textarea>
                    @error('antecedents_familiaux') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-between">
                <a href="{{ route('register.step1') }}" class="btn-soft-secondary bg-white/30 text-[#3a4e5e] border-white/70"><i class="fas fa-arrow-left mr-2"></i> Retour</a>
                <button type="submit" class="btn-soft-primary">Suivant <i class="fas fa-arrow-right ml-2"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection