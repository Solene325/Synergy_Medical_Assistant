@extends('layouts.medecin')

@section('title', 'Changer mot de passe · SynergyAI')

@section('content')
<div class="max-w-md mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('medecin.profile.edit') }}" class="text-warm-gray hover:text-primary transition">
            <i class="fas fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-3xl font-display font-bold text-primary">Changer mot de passe</h1>
    </div>

    <div class="glass-card p-6">
        <form method="POST" action="{{ route('medecin.profile.change-password') }}">
            @csrf
            <div class="mb-5">
                <label for="current_password" class="block font-medium text-warm-gray mb-1">Mot de passe actuel *</label>
                <input type="password" name="current_password" id="current_password" required class="input-field w-full">
                @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="block font-medium text-warm-gray mb-1">Nouveau mot de passe *</label>
                <input type="password" name="password" id="password" required class="input-field w-full">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <label for="password_confirmation" class="block font-medium text-warm-gray mb-1">Confirmer *</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="input-field w-full">
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-white/30">
                <a href="{{ route('medecin.profile.edit') }}" class="btn-outline text-sm">Annuler</a>
                <button type="submit" class="btn-primary text-sm">Changer</button>
            </div>
        </form>
    </div>
</div>
@endsection