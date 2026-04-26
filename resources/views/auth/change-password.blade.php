@extends('layouts.app')

@section('title', 'Changer votre mot de passe')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#f9f3e8]">
    <div class="max-w-md w-full glass-card p-8">
        <h2 class="text-3xl font-bold text-[#2d4e57] text-center mb-8">Changement de mot de passe</h2>
        <p class="text-center text-[#527a84] mb-6">Vous devez changer votre mot de passe temporaire pour continuer.</p>

        <form method="POST" action="{{ route('password.change.post') }}">
            @csrf

            <div class="mb-5">
                <label for="current_password" class="block text-sm font-medium text-[#4f6b73]">Mot de passe actuel</label>
                <input type="password" name="current_password" id="current_password" required class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-[#4f6b73]">Nouveau mot de passe</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <label for="password_confirmation" class="block text-sm font-medium text-[#4f6b73]">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
            </div>

            <div>
                <button type="submit" class="btn-soft-primary w-full">Changer le mot de passe</button>
            </div>
        </form>
    </div>
</div>
@endsection