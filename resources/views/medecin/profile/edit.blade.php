@extends('layouts.medecin')

@section('title', 'Mon profil')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-[#2d4e57] mb-6">Mon profil</h1>

    <div class="glass-card p-6">
        <form method="POST" action="{{ route('medecin.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block font-medium mb-2">Photo de profil</label>
                <div class="flex items-center gap-4">
                    @if(auth()->user()->photo_profil)
                        <img src="{{ Storage::url(auth()->user()->photo_profil) }}" class="w-20 h-20 rounded-full object-cover">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-user-md text-3xl text-gray-400"></i>
                        </div>
                    @endif
                    <input type="file" name="photo_profil" accept="image/*" class="text-sm">
                </div>
                @error('photo_profil') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <label for="prenom" class="block font-medium mb-2">Prénom *</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom', auth()->user()->prenom) }}" required class="w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                </div>
                <div>
                    <label for="nom" class="block font-medium mb-2">Nom *</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', auth()->user()->nom) }}" required class="w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                </div>
            </div>

            <div class="mb-5">
                <label for="email" class="block font-medium mb-2">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <label for="telephone" class="block font-medium mb-2">Téléphone</label>
                <input type="text" name="telephone" id="telephone" value="{{ old('telephone', auth()->user()->telephone) }}" class="w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" class="btn-soft-primary">Mettre à jour</button>
                <a href="{{ route('medecin.profile.change-password') }}" class="text-[#4f9da6] hover:underline">Changer mon mot de passe</a>
            </div>
        </form>
    </div>
</div>
@endsection