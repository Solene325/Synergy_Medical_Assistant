@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#f9f3e8]">
    <div class="max-w-md w-full glass-card p-8">
        <h2 class="text-3xl font-bold text-[#2d4e57] text-center mb-8">Connexion</h2>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-5">
                <label for="identifiant_unique" class="block text-sm font-medium text-[#4f6b73]">Identifiant unique</label>
                <input type="text" name="identifiant_unique" id="identifiant_unique" value="{{ old('identifiant_unique') }}" required class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                @error('identifiant_unique') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-[#4f6b73]">Mot de passe</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full px-4 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit" class="btn-soft-primary w-full">Se connecter</button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-[#527a84]">
            Pas encore de compte ? <a href="{{ route('register.step1') }}" class="font-medium text-[#4f9da6] hover:underline">Inscrivez-vous</a>
        </p>
    </div>
</div>
@endsection