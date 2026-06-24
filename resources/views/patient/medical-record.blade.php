@extends('layouts.medical')

@section('title', 'Dossier médical · SynergyAI')

@section('content')
<div x-data="{ activeTab: 'profil' }" class="space-y-6">

    <!-- En-tête -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-primary">Mon dossier médical</h1>
            <p class="text-warm-gray text-sm">Consultez et gérez vos informations médicales</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('patient.medical-record.edit') }}" class="btn-primary text-sm">
                <i class="fas fa-edit mr-1"></i> Modifier
            </a>
            <a href="{{ route('patient.medical-record.export-pdf') }}" class="btn-primary text-sm !bg-accent hover:!bg-[#c46a37]">
                <i class="fas fa-file-pdf mr-1"></i> Exporter
            </a>
        </div>
    </div>

    <!-- Messages flash -->
    @if(session('success'))
        <div class="p-4 bg-soft-green/60 backdrop-blur-sm rounded-2xl border border-green-200/50 text-green-700 text-sm flex items-center gap-2">
            <i class="fas fa-check-circle text-green-500"></i>
            {{ session('success') }}
        </div>
    @endif
    @if(session('info'))
        <div class="p-4 bg-soft-blue/60 backdrop-blur-sm rounded-2xl border border-blue-200/50 text-slate text-sm flex items-center gap-2">
            <i class="fas fa-info-circle text-slate"></i>
            {{ session('info') }}
        </div>
    @endif

    <!-- Onglets -->
    <div class="flex flex-wrap gap-2 border-b border-white/40 pb-2">
        <button @click="activeTab = 'profil'" 
                class="px-4 py-2 rounded-full text-sm font-medium transition"
                :class="activeTab === 'profil' ? 'bg-primary text-white shadow-md' : 'text-warm-gray hover:bg-white/30'">
            <i class="fas fa-user mr-1.5"></i> Profil
        </button>
        <button @click="activeTab = 'medical'" 
                class="px-4 py-2 rounded-full text-sm font-medium transition"
                :class="activeTab === 'medical' ? 'bg-primary text-white shadow-md' : 'text-warm-gray hover:bg-white/30'">
            <i class="fas fa-notes-medical mr-1.5"></i> Dossier médical
        </button>
        <button @click="activeTab = 'prescriptions'" 
                class="px-4 py-2 rounded-full text-sm font-medium transition"
                :class="activeTab === 'prescriptions' ? 'bg-primary text-white shadow-md' : 'text-warm-gray hover:bg-white/30'">
            <i class="fas fa-prescription-bottle mr-1.5"></i> Prescriptions
        </button>
        <button @click="activeTab = 'medecin'" 
                class="px-4 py-2 rounded-full text-sm font-medium transition"
                :class="activeTab === 'medecin' ? 'bg-primary text-white shadow-md' : 'text-warm-gray hover:bg-white/30'">
            <i class="fas fa-user-md mr-1.5"></i> Médecin traitant
        </button>
    </div>

    <!-- ============================================ -->
    <!-- ONGLET : PROFIL                              -->
    <!-- ============================================ -->
    <div x-show="activeTab === 'profil'" x-transition.duration.300ms>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Carte photo et identité -->
            <div class="glass-card p-6 md:col-span-1">
                <div class="flex flex-col items-center text-center">
                    @if($user->photo_profil)
                        <img src="{{ asset('storage/' . $user->photo_profil) }}" 
                             alt="Photo de profil" 
                             class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                    @else
                        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-primary/10 to-accent/10 flex items-center justify-center text-5xl text-primary/30 border-4 border-white shadow-lg">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                    <h3 class="text-xl font-display font-bold text-primary mt-4">{{ $user->prenom }} {{ $user->nom }}</h3>
                    <p class="text-sm text-warm-gray">{{ $user->email }}</p>
                    <p class="text-sm text-warm-gray mt-1">
                        <i class="fas fa-phone mr-1"></i> {{ $user->telephone ?? 'Non renseigné' }}
                    </p>
                    <div class="mt-3 flex gap-2">
                        <span class="text-xs px-3 py-1 rounded-full bg-primary/10 text-primary">{{ ucfirst($user->role) }}</span>
                        <span class="text-xs px-3 py-1 rounded-full bg-accent/10 text-accent">Identifiant: {{ $user->identifiant_unique ?? '—' }}</span>
                    </div>
                </div>
            </div>

            <!-- Informations personnelles -->
            <div class="glass-card p-6 md:col-span-2">
                <h4 class="font-display font-semibold text-primary text-lg mb-4 flex items-center gap-2">
                    <i class="fas fa-id-card text-accent"></i> Informations personnelles
                </h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-warm-gray/60 text-xs uppercase tracking-wider">Prénom</p>
                        <p class="font-medium text-primary">{{ $user->prenom }}</p>
                    </div>
                    <div>
                        <p class="text-warm-gray/60 text-xs uppercase tracking-wider">Nom</p>
                        <p class="font-medium text-primary">{{ $user->nom }}</p>
                    </div>
                    <div>
                        <p class="text-warm-gray/60 text-xs uppercase tracking-wider">Email</p>
                        <p class="font-medium text-primary">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-warm-gray/60 text-xs uppercase tracking-wider">Téléphone</p>
                        <p class="font-medium text-primary">{{ $user->telephone ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-warm-gray/60 text-xs uppercase tracking-wider">Date de naissance</p>
                        <p class="font-medium text-primary">{{ $user->date_naissance ? \Carbon\Carbon::parse($user->date_naissance)->format('d/m/Y') : '—' }}</p>
                    </div>
                    <div>
                        <p class="text-warm-gray/60 text-xs uppercase tracking-wider">Sexe</p>
                        <p class="font-medium text-primary">{{ $user->sexe_label ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-warm-gray/60 text-xs uppercase tracking-wider">Âge</p>
                        <p class="font-medium text-primary">{{ $user->age ?? '—' }} ans</p>
                    </div>
                    <div>
                        <p class="text-warm-gray/60 text-xs uppercase tracking-wider">Groupe sanguin</p>
                        <p class="font-medium text-primary">{{ $user->groupe_sanguin ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-warm-gray/60 text-xs uppercase tracking-wider">Poids</p>
                        <p class="font-medium text-primary">{{ $user->poids ?? '—' }} kg</p>
                    </div>
                    <div>
                        <p class="text-warm-gray/60 text-xs uppercase tracking-wider">Taille</p>
                        <p class="font-medium text-primary">{{ $user->taille ?? '—' }} cm</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-warm-gray/60 text-xs uppercase tracking-wider">Adresse</p>
                        <p class="font-medium text-primary">
                            {{ $user->adresse_rue ? $user->adresse_rue . ', ' : '' }}
                            {{ $user->code_postal ? $user->code_postal . ' ' : '' }}
                            {{ $user->ville ?? '' }}
                            {{ $user->pays ? ' - ' . $user->pays : '' }}
                            @if(!$user->adresse_rue && !$user->ville)
                                —
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-warm-gray/60 text-xs uppercase tracking-wider">Téléphone d'urgence</p>
                        <p class="font-medium text-primary">{{ $user->telephone_urgence ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-warm-gray/60 text-xs uppercase tracking-wider">Langue préférée</p>
                        <p class="font-medium text-primary">{{ $user->langue_preferee ?? 'Français' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- ONGLET : DOSSIER MÉDICAL                     -->
    <!-- ============================================ -->
    <div x-show="activeTab === 'medical'" x-transition.duration.300ms>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Antécédents personnels -->
            <div class="glass-card p-6">
                <h4 class="font-display font-semibold text-primary text-lg mb-3 flex items-center gap-2">
                    <i class="fas fa-history text-accent"></i> Antécédents personnels
                </h4>
                <div class="bg-white/30 rounded-xl p-4 text-sm text-warm-gray leading-relaxed min-h-[100px]">
                    @if($user->antecedents_personnels)
                        {!! nl2br(e($user->antecedents_personnels)) !!}
                    @else
                        <span class="text-warm-gray/40">Aucun antécédent personnel renseigné</span>
                    @endif
                </div>
            </div>

            <!-- Antécédents familiaux -->
            <div class="glass-card p-6">
                <h4 class="font-display font-semibold text-primary text-lg mb-3 flex items-center gap-2">
                    <i class="fas fa-users text-slate"></i> Antécédents familiaux
                </h4>
                <div class="bg-white/30 rounded-xl p-4 text-sm text-warm-gray leading-relaxed min-h-[100px]">
                    @if($user->antecedents_familiaux)
                        {!! nl2br(e($user->antecedents_familiaux)) !!}
                    @else
                        <span class="text-warm-gray/40">Aucun antécédent familial renseigné</span>
                    @endif
                </div>
            </div>

            <!-- Allergies -->
            <div class="glass-card p-6">
                <h4 class="font-display font-semibold text-primary text-lg mb-3 flex items-center gap-2">
                    <i class="fas fa-allergies text-gold"></i> Allergies
                </h4>
                <div class="bg-white/30 rounded-xl p-4 text-sm text-warm-gray leading-relaxed min-h-[80px]">
                    @if($user->allergies)
                        {!! nl2br(e($user->allergies)) !!}
                    @else
                        <span class="text-warm-gray/40">Aucune allergie renseignée</span>
                    @endif
                </div>
            </div>

            <!-- Traitements -->
            <div class="glass-card p-6">
                <h4 class="font-display font-semibold text-primary text-lg mb-3 flex items-center gap-2">
                    <i class="fas fa-pills text-primary-light"></i> Traitements en cours
                </h4>
                <div class="bg-white/30 rounded-xl p-4 text-sm text-warm-gray leading-relaxed min-h-[80px]">
                    @if($user->traitements)
                        {!! nl2br(e($user->traitements)) !!}
                    @else
                        <span class="text-warm-gray/40">Aucun traitement renseigné</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Métriques de santé -->
        <div class="glass-card p-6 mt-6">
            <h4 class="font-display font-semibold text-primary text-lg mb-4 flex items-center gap-2">
                <i class="fas fa-heartbeat text-accent"></i> Métriques de santé
            </h4>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                <div class="bg-white/30 rounded-xl p-4">
                    <p class="text-2xl font-display font-bold text-primary">{{ $user->poids ?? '—' }}</p>
                    <p class="text-xs text-warm-gray">Poids (kg)</p>
                </div>
                <div class="bg-white/30 rounded-xl p-4">
                    <p class="text-2xl font-display font-bold text-primary">{{ $user->taille ?? '—' }}</p>
                    <p class="text-xs text-warm-gray">Taille (cm)</p>
                </div>
                <div class="bg-white/30 rounded-xl p-4">
                    <p class="text-2xl font-display font-bold text-primary">{{ $user->imc ?? '—' }}</p>
                    <p class="text-xs text-warm-gray">IMC</p>
                </div>
                <div class="bg-white/30 rounded-xl p-4">
                    <p class="text-2xl font-display font-bold text-primary">{{ $user->groupe_sanguin ?? '—' }}</p>
                    <p class="text-xs text-warm-gray">Groupe sanguin</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- ONGLET : PRESCRIPTIONS                       -->
    <!-- ============================================ -->
    <div x-show="activeTab === 'prescriptions'" x-transition.duration.300ms>

        <div class="glass-card p-6">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-display font-semibold text-primary text-lg flex items-center gap-2">
                    <i class="fas fa-prescription-bottle text-accent"></i> Mes prescriptions
                </h4>
                <span class="text-sm text-warm-gray">{{ $prescriptions->count() }} prescription(s)</span>
            </div>

            @if($prescriptions->isEmpty())
                <div class="text-center py-10 text-warm-gray/60">
                    <i class="fas fa-prescription-bottle text-4xl text-warm-gray/20 mb-3"></i>
                    <p>Aucune prescription disponible.</p>
                </div>
            @else
                <div class="divide-y divide-white/30">
                    @foreach($prescriptions as $prescription)
                        <div class="py-4 flex flex-wrap items-center justify-between gap-3">
                            <div>
                                <p class="font-semibold text-primary">Ordonnance #{{ $prescription->id }}</p>
                                <p class="text-sm text-warm-gray">
                                    <i class="fas fa-user-md mr-1 text-accent"></i>
                                    Dr. {{ $prescription->doctor->name ?? 'Non spécifié' }}
                                </p>
                                <p class="text-xs text-warm-gray/60">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ $prescription->created_at->format('d/m/Y à H:i') }}
                                </p>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-xs px-3 py-1 rounded-full bg-soft-green/60 text-green-700">
                                    <i class="fas fa-check-circle mr-0.5"></i> Valide
                                </span>
                                <a href="#" class="btn-primary text-xs !py-1.5 !px-3">
                                    <i class="fas fa-download"></i> PDF
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($prescriptions->count() > 10)
                    <div class="text-center mt-4">
                        <a href="#" class="text-sm text-accent hover:underline">Voir toutes les prescriptions</a>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <!-- ============================================ -->
    <!-- ONGLET : MÉDECIN TRAITANT                    -->
    <!-- ============================================ -->
    <div x-show="activeTab === 'medecin'" x-transition.duration.300ms>

        <div class="glass-card p-6">
            <h4 class="font-display font-semibold text-primary text-lg mb-4 flex items-center gap-2">
                <i class="fas fa-user-md text-accent"></i> Médecin traitant
            </h4>

            @if($medecinTraitant)
                <div class="flex flex-col md:flex-row md:items-center gap-6 bg-white/30 rounded-2xl p-5">
                    <div class="w-20 h-20 rounded-full bg-primary/10 flex items-center justify-center text-3xl text-primary shadow-inner">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="flex-1">
                        <h5 class="text-xl font-display font-semibold text-primary">Dr. {{ $medecinTraitant->name ?? $medecinTraitant->prenom . ' ' . $medecinTraitant->nom }}</h5>
                        <p class="text-warm-gray text-sm">{{ $medecinTraitant->specialite ?? 'Médecin généraliste' }}</p>
                        <div class="flex flex-wrap gap-4 mt-2 text-sm">
                            <span><i class="fas fa-envelope text-accent mr-1"></i> {{ $medecinTraitant->email ?? '—' }}</span>
                            <span><i class="fas fa-phone text-accent mr-1"></i> {{ $medecinTraitant->telephone ?? '—' }}</span>
                        </div>
                    </div>
                    <a href="#" class="btn-primary text-sm !bg-accent hover:!bg-[#c46a37]">
                        <i class="fas fa-comment mr-1"></i> Contacter
                    </a>
                </div>
            @else
                <div class="text-center py-8 text-warm-gray/60">
                    <i class="fas fa-user-md text-4xl text-warm-gray/20 mb-3"></i>
                    <p>Aucun médecin traitant assigné.</p>
                    <p class="text-sm mt-2">Vous pouvez rechercher un médecin dans l'onglet "Médecins".</p>
                    <a href="{{ route('patient.medecins.index') }}" class="btn-primary text-sm mt-4 inline-flex">
                        <i class="fas fa-search mr-1"></i> Rechercher un médecin
                    </a>
                </div>
            @endif

            <!-- Informations du médecin traitant renseignées par le patient -->
            @if($user->medecin_nom || $user->medecin_telephone)
                <div class="mt-4 p-4 bg-white/20 rounded-xl">
                    <p class="text-xs text-warm-gray/60 uppercase tracking-wider mb-2">Informations renseignées par le patient</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                        <div>
                            <span class="text-warm-gray/60">Nom :</span>
                            <span class="text-primary font-medium">{{ $user->medecin_nom ?? '—' }}</span>
                        </div>
                        <div>
                            <span class="text-warm-gray/60">Téléphone :</span>
                            <span class="text-primary font-medium">{{ $user->medecin_telephone ?? '—' }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection