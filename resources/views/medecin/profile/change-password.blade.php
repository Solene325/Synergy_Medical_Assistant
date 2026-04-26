@extends('layouts.medecin')

@section('title', 'Changer mot de passe')

@section('content')
<div class="max-w-md mx-auto">
    <h1 class="text-3xl font-bold text-[#2d4e57] mb-6">Changer mon mot de passe</h1>

    <div class="glass-card p-6">
        <form method="POST" action="{{ route('medecin.profile.change-password') }}">
            @csrf
            <div class="mb-5">
                <label for="current_password" class="block font-medium mb-2">Mot de passe actuel *</label>
                <input type="password" name="current_password" id="current_password" required class="w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="block font-medium mb-2">Nouveau mot de passe *</label>
                <input type="password" name="password" id="password" required class="w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
            </div>

            <div class="mb-5">
                <label for="password_confirmation" class="block font-medium mb-2">Confirmer le mot de passe *</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('medecin.profile.edit') }}" class="btn-soft-secondary bg-white/30 text-[#3a4e5e] border-white/70 mr-3">Annuler</a>
                <button type="submit" class="btn-soft-primary">Changer</button>
            </div>
        </form>
    </div>
</div>
@endsection