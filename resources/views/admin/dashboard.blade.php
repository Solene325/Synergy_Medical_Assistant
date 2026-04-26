@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-4xl font-bold text-[#2d4e57]">Bonjour, {{ Auth::user()->prenom }} 👋</h1>
        <p class="text-[#527a84] text-lg">Bienvenue dans votre tableau de bord administrateur.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <div class="glass-card p-6 text-center">
            <i class="fas fa-users text-3xl text-[#4f9da6] mb-3"></i>
            <p class="text-3xl font-bold text-[#2d4e57]">{{ $totalUsers }}</p>
            <p class="text-[#527a84]">Total utilisateurs</p>
        </div>
        <div class="glass-card p-6 text-center">
            <i class="fas fa-user-injured text-3xl text-[#4f9da6] mb-3"></i>
            <p class="text-3xl font-bold text-[#2d4e57]">{{ $totalPatients }}</p>
            <p class="text-[#527a84]">Patients</p>
        </div>
        <div class="glass-card p-6 text-center">
            <i class="fas fa-user-md text-3xl text-[#4f9da6] mb-3"></i>
            <p class="text-3xl font-bold text-[#2d4e57]">{{ $totalMedecins }}</p>
            <p class="text-[#527a84]">Médecins</p>
        </div>
        <div class="glass-card p-6 text-center">
            <i class="fas fa-user-shield text-3xl text-[#4f9da6] mb-3"></i>
            <p class="text-3xl font-bold text-[#2d4e57]">{{ $totalAdmins }}</p>
            <p class="text-[#527a84]">Administrateurs</p>
        </div>
        <div class="glass-card p-6 text-center">
            <i class="fas fa-capsules text-3xl text-[#4f9da6] mb-3"></i>
            <p class="text-3xl font-bold text-[#2d4e57]">{{ $totalMedicaments }}</p>
            <p class="text-[#527a84]">Médicaments référencés</p>
        </div>
    </div>
</div>
@endsection