@extends('layouts.app')

@section('title', 'Tableau de bord Administrateur')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-[#2d4e57] mb-6">Bonjour {{ Auth::user()->prenom }} !</h1>
    <p class="text-[#527a84]">Bienvenue dans votre espace admin.</p>
</div>
@endsection