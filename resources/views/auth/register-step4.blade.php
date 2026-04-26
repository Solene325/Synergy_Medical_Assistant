@extends('layouts.app')

@section('title', 'Inscription - Étape 4')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#f9f3e8]">
    <div class="max-w-2xl w-full glass-card p-8">
        <h2 class="text-3xl font-bold text-[#2d4e57] text-center mb-8">Politiques de confidentialité</h2>
        <div class="prose prose-sm max-w-none text-[#527a84] bg-white/40 rounded-2xl p-6 mb-6">
            <p>Veuillez lire attentivement nos politiques de confidentialité...</p>
            <!-- Insérez ici le texte des CGU / confidentialité -->
        </div>

        <form method="POST" action="{{ route('register.step4.post') }}">
            @csrf

            <div class="flex items-center">
                <input type="checkbox" name="accept" id="accept" value="1" required class="h-5 w-5 text-[#4f9da6] rounded border-gray-300 focus:ring-[#4f9da6]">
                <label for="accept" class="ml-3 text-sm text-[#4f6b73]">J'accepte les politiques de confidentialité et les conditions d'utilisation.</label>
            </div>
            @error('accept') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <div class="mt-8 flex justify-between">
                <a href="{{ route('register.step3') }}" class="btn-soft-secondary bg-white/30 text-[#3a4e5e] border-white/70"><i class="fas fa-arrow-left mr-2"></i> Retour</a>
                <button type="submit" class="btn-soft-primary">Finaliser l'inscription</button>
            </div>
        </form>
    </div>
</div>
@endsection