@extends('layouts.app')

@section('title', 'SynergyAI · Changer votre mot de passe')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#f9f3e8]">
    <div class="w-full max-w-md">
        <div class="glass-card rounded-3xl p-8 shadow-soft">
            <div class="text-center mb-6">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-white/80 rounded-2xl flex items-center justify-center shadow-md">
                        <i class="fas fa-key text-primary text-2xl"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-display font-bold text-primary">Changement de mot de passe</h2>
                <p class="text-warm-gray mt-2 text-sm">Vous devez changer votre mot de passe temporaire pour continuer.</p>
            </div>

            <form method="POST" action="{{ route('password.change.post') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="current_password" class="block text-sm font-medium text-warm-gray">Mot de passe actuel</label>
                    <div class="relative mt-1">
                        <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-warm-gray/60"></i>
                        <input type="password" name="current_password" id="current_password" required
                               class="input-field pl-10 w-full" placeholder="Entrez votre mot de passe actuel">
                    </div>
                    @error('current_password') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-warm-gray">Nouveau mot de passe</label>
                    <div class="relative mt-1">
                        <i class="fas fa-key absolute left-3 top-1/2 -translate-y-1/2 text-warm-gray/60"></i>
                        <input type="password" name="password" id="password" required
                               class="input-field pl-10 w-full" placeholder="Nouveau mot de passe (min. 8 caractères)">
                    </div>
                    @error('password') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-warm-gray">Confirmer le mot de passe</label>
                    <div class="relative mt-1">
                        <i class="fas fa-check-circle absolute left-3 top-1/2 -translate-y-1/2 text-warm-gray/60"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               class="input-field pl-10 w-full" placeholder="Confirmez le nouveau mot de passe">
                    </div>
                </div>

                <div class="pt-4 border-t border-white/30">
                    <button type="submit" class="btn-primary w-full flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i>
                        Changer le mot de passe
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-sm text-warm-gray hover:text-primary transition">
                    <i class="fas fa-sign-out-alt mr-1"></i> Se déconnecter
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection