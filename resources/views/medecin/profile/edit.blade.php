@extends('layouts.medecin')

@section('title', 'Mon profil · SynergyAI')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-display font-bold text-primary mb-6">Mon profil</h1>

    <div class="glass-card p-6">
        <form method="POST" action="{{ route('medecin.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block font-medium text-warm-gray mb-2">Photo de profil</label>
                <div class="flex items-center gap-4">
                    @if(auth()->user()->photo_profil)
                        <img src="{{ Storage::url(auth()->user()->photo_profil) }}" class="w-20 h-20 rounded-full object-cover border-2 border-white shadow-md">
                    @else
                        <div class="w-20 h-20 rounded-full bg-white/40 flex items-center justify-center text-3xl text-warm-gray/40">
                            <i class="fas fa-user-md"></i>
                        </div>
                    @endif
                    <input type="file" name="photo_profil" accept="image/*" class="text-sm input-field w-auto">
                </div>
                @error('photo_profil') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <label for="prenom" class="block font-medium text-warm-gray mb-1">Prénom *</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom', auth()->user()->prenom) }}" required class="input-field w-full">
                </div>
                <div>
                    <label for="nom" class="block font-medium text-warm-gray mb-1">Nom *</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', auth()->user()->nom) }}" required class="input-field w-full">
                </div>
            </div>

            <div class="mb-5">
                <label for="email" class="block font-medium text-warm-gray mb-1">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required class="input-field w-full">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <label for="telephone" class="block font-medium text-warm-gray mb-1">Téléphone</label>
                <input type="text" name="telephone" id="telephone" value="{{ old('telephone', auth()->user()->telephone) }}" class="input-field w-full">
            </div>

            <div class="flex flex-wrap justify-between items-center gap-3 pt-4 border-t border-white/30">
                <button type="submit" class="btn-primary text-sm">Mettre à jour</button>
                <a href="{{ route('medecin.profile.change-password') }}" class="text-sm text-accent hover:underline">Changer mon mot de passe</a>
            </div>
        </form>
    </div>
</div>
@endsection