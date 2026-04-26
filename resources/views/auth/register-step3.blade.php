@extends('layouts.app')

@section('title', 'Inscription - Étape 3')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#f9f3e8]">
    <div class="max-w-md w-full glass-card p-8">
        <h2 class="text-3xl font-bold text-[#2d4e57] text-center mb-8">Vérification</h2>
        <p class="text-center text-[#527a84] mb-6">Un code à 6 chiffres vous a été envoyé par email.</p>

        <form method="POST" action="{{ route('register.step3.post') }}">
            @csrf

            <div>
                <label for="code" class="block text-sm font-medium text-[#4f6b73]">Code de vérification</label>
                <input type="text" name="code" id="code" maxlength="6" pattern="\d{6}" inputmode="numeric" required class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none text-center text-2xl tracking-widest">
                @error('code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-8 flex justify-between">
                <a href="{{ route('register.step2') }}" class="btn-soft-secondary bg-white/30 text-[#3a4e5e] border-white/70"><i class="fas fa-arrow-left mr-2"></i> Retour</a>
                <button type="submit" class="btn-soft-primary">Vérifier</button>
            </div>
        </form>
    </div>
</div>
@endsection