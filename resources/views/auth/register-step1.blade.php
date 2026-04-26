@extends('layouts.app')

@section('title', 'Inscription - Étape 1')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#f9f3e8]">
    <div class="max-w-2xl w-full glass-card p-8">
        <h2 class="text-3xl font-bold text-[#2d4e57] text-center mb-8">Inscription patient - Étape 1</h2>
        <p class="text-center text-[#527a84] mb-6">Vos informations personnelles</p>

        <form method="POST" action="{{ route('register.step1.post') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Prénom -->
                <div>
                    <label for="prenom" class="block text-sm font-medium text-[#4f6b73]">Prénom</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                    @error('prenom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-sm font-medium text-[#4f6b73]">Nom</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                    @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-[#4f6b73]">Adresse e-mail</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Téléphone -->
                <div>
                    <label for="telephone" class="block text-sm font-medium text-[#4f6b73]">Téléphone</label>
                    <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}" required class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                    @error('telephone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Photo de profil -->
                <div>
                    <label for="photo_profil" class="block text-sm font-medium text-[#4f6b73]">Photo de profil</label>
                    <input type="file" name="photo_profil" id="photo_profil" accept="image/*" required class="mt-1 block w-full text-sm text-[#527a84] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-[#4f9da6] file:text-white hover:file:bg-[#3c838c]">
                    @error('photo_profil') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Pièce d'identité -->
                <div>
                    <label for="piece_identite" class="block text-sm font-medium text-[#4f6b73]">Pièce d'identité</label>
                    <input type="file" name="piece_identite" id="piece_identite" accept="image/*" required class="mt-1 block w-full text-sm text-[#527a84] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-[#4f9da6] file:text-white hover:file:bg-[#3c838c]">
                    @error('piece_identite') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="btn-soft-primary">Suivant <i class="fas fa-arrow-right ml-2"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection