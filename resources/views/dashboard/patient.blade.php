@extends('layouts.pat')
@section('title', 'Tableau de bord · SynergyAI')
@section('content')
<div class="space-y-8">
    <!-- En-tête de bienvenue -->
    <div class="glass-card p-10">
        <div class="flex items-center justify-between flex-wrap gap-6">
            <div>
                <h1 class="text-5xl font-bold text-[#2d4e57] mb-3">
                    Bonjour, {{ auth()->user()->name }} 👋
                </h1>
                <p class="text-[#527a84] text-lg flex items-center gap-2">
                    <i class="fas fa-clock"></i>
                    Dernière connexion : 
                    <span class="font-semibold">
                    {{ auth()->user()->last_login_at?->diffForHumans() ?? 'Première connexion' }}
                    </span>
                </p>
            </div>
            <div class="hidden md:block">
                <div class="soft-icon !w-24 !h-24">
                    <i class="fas fa-user-md text-5xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques biométriques -->
    <div>
        <h2 class="text-3xl font-bold text-[#2d4e57] mb-6 section-title-soft">
            Mes informations biométriques
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="stat-card-soft text-center">
                <div class="soft-icon mx-auto mb-4">
                    <i class="fas fa-weight-scale text-3xl"></i>
                </div>
                <p class="text-4xl font-light text-[#2d4e57] mb-1">
                    {{ auth()->user()->poids ?? '—' }}
                    <span class="text-xl font-normal text-[#527a84]">kg</span>
                </p>
                <p class="text-[#527a84] font-medium">Poids</p>
                <div class="w-16 h-1 bg-[#f9c7b5] mx-auto mt-3 rounded-full"></div>
            </div>

            <div class="stat-card-soft text-center">
                <div class="soft-icon mx-auto mb-4">
                    <i class="fas fa-ruler-vertical text-3xl"></i>
                </div>
                <p class="text-4xl font-light text-[#2d4e57] mb-1">
                    {{ auth()->user()->taille ?? '—' }}
                    <span class="text-xl font-normal text-[#527a84]">cm</span>
                </p>
                <p class="text-[#527a84] font-medium">Taille</p>
                <div class="w-16 h-1 bg-[#f9c7b5] mx-auto mt-3 rounded-full"></div>
            </div>

            <div class="stat-card-soft text-center">
                <div class="soft-icon mx-auto mb-4">
                    <i class="fas fa-calendar-alt text-3xl"></i>
                </div>
                <p class="text-4xl font-light text-[#2d4e57] mb-1">
                    {{ auth()->user()->age ?? '—' }}
                    <span class="text-xl font-normal text-[#527a84]">ans</span>
                </p>
                <p class="text-[#527a84] font-medium">Âge</p>
                <div class="w-16 h-1 bg-[#f9c7b5] mx-auto mt-3 rounded-full"></div>
            </div>

            <div class="stat-card-soft text-center">
                <div class="soft-icon mx-auto mb-4">
                    <i class="fas fa-droplet text-3xl"></i>
                </div>
                <p class="text-4xl font-light text-[#2d4e57] mb-1">
                    {{ auth()->user()->groupe_sanguin ?? '—' }}
                </p>
                <p class="text-[#527a84] font-medium">Groupe sanguin</p>
                <div class="w-16 h-1 bg-[#f9c7b5] mx-auto mt-3 rounded-full"></div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div>
        <h2 class="text-3xl font-bold text-[#2d4e57] mb-6 section-title-soft">
            Actions rapides
        </h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Diagnostic IA -->
            <div class="action-card bg-gradient-to-br from-[#e1f3f0] to-[#f9eae1]">
                <div class="flex items-start gap-5">
                    <div class="soft-icon !w-16 !h-16 flex-shrink-0">
                        <i class="fas fa-robot text-3xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-[#2d4e57] mb-3">Diagnostic IA</h3>
                        <p class="text-[#527a84] mb-5 leading-relaxed">
                            Décrivez vos symptômes et obtenez une première analyse en quelques secondes grâce à notre intelligence artificielle.
                        </p>
                        <a href="{{ route('patient.chat') }}" class="btn-soft-primary inline-flex items-center gap-2">
                            <i class="fas fa-stethoscope"></i>
                            Démarrer maintenant
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contacter un médecin -->
            <div class="action-card bg-gradient-to-br from-[#fef3f0] to-[#f9e8e4]">
                <div class="flex items-start gap-5">
                    <div class="soft-icon !w-16 !h-16 flex-shrink-0 !bg-[#f9c7b5]/30">
                        <i class="fas fa-user-doctor text-3xl text-[#d97706]"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-[#2d4e57] mb-3">Consulter un médecin</h3>
                        <p class="text-[#527a84] mb-5 leading-relaxed">
                            Besoin d'un avis médical professionnel ? Contactez nos médecins disponibles pour une consultation.
                        </p>
                        <a href="{{ route('chat.index') }}" class="btn-soft-primary inline-flex items-center gap-2" style="background: linear-gradient(135deg, #f9c7b5 0%, #ffd4c5 100%);">
                            <i class="fas fa-comments"></i>
                            Prendre rendez-vous
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Prescriptions récentes -->
    <div>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-[#2d4e57] section-title-soft">
                Mes prescriptions récentes
            </h2>
            <a href="#" class="text-[#4f9da6] hover:text-[#3c838c] font-semibold flex items-center gap-2 transition-colors">
                Voir tout
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="glass-card p-10">
            @php
                $prescriptions = auth()->user()->prescriptionsAsPatient()->latest()->take(3)->get();
            @endphp

            @if($prescriptions->isEmpty())
                <div class="text-center py-16">
                    <div class="soft-icon !w-28 !h-28 mx-auto mb-6 opacity-60">
                        <i class="fas fa-prescription-bottle text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-[#2d4e57] mb-2">Aucune prescription disponible</h3>
                    <p class="text-[#527a84] text-lg">Vos ordonnances apparaîtront ici après votre consultation</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($prescriptions as $prescription)
                        <div class="stat-card-soft hover:shadow-xl transition-all duration-300">
                            <div class="flex items-center justify-between flex-wrap gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <h4 class="font-bold text-[#2d4e57] text-xl">Ordonnance #{{ $prescription->id }}</h4>
                                        <span class="badge-success">Disponible</span>
                                    </div>
                                    <p class="text-[#527a84] flex items-center gap-2 mb-2">
                                        <i class="fas fa-user-doctor"></i>
                                        <span class="font-medium">Dr. {{ $prescription->doctor->name ?? 'Non spécifié' }}</span>
                                    </p>
                                    <p class="text-sm text-[#527a84] flex items-center gap-2">
                                        <i class="fas fa-calendar"></i>
                                        {{ $prescription->created_at->format('d/m/Y à H:i') }}
                                    </p>
                                </div>
                                <a href="#" class="btn-soft-primary">
                                    <i class="fas fa-download mr-2"></i>
                                    Télécharger
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Conseil santé -->
    <div class="glass-card p-10 bg-gradient-to-br from-blue-50/50 to-indigo-50/50 border-blue-200/40">
        <div class="flex items-start gap-5">
            <div class="soft-icon !bg-blue-100/80 flex-shrink-0">
                <i class="fas fa-lightbulb text-3xl !text-blue-600"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#2d4e57] mb-3 flex items-center gap-2">
                    💡 Conseil santé du jour
                </h3>
                <p class="text-[#527a84] text-lg leading-relaxed">
                    N'oubliez pas de boire au moins 1,5L d'eau par jour pour rester hydraté. Une bonne hydratation améliore votre concentration et votre bien-être général.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection