@extends('layouts.app')

@section('title', 'SynergyAI · Inscription (1/5)')

@section('content')
<div class="w-full max-w-6xl h-auto md:min-h-[90vh] bg-white/30 backdrop-blur-sm rounded-4xl shadow-soft-lg flex flex-col md:flex-row overflow-hidden border border-white/50">

    {{-- PARTIE GAUCHE --}}
    <div class="w-full md:w-1/2 p-8 md:p-10 flex flex-col justify-between relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-gradient-to-r from-accent/30 via-gold/20 to-primary/30 rounded-full blur-3xl opacity-40"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-2 text-sm font-semibold text-accent mb-6">
                <i class="fas fa-user-plus"></i>
                <span>Nouveau patient</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-display font-bold text-primary leading-tight">
                Créez votre<br>espace santé
            </h1>
            <p class="text-warm-gray mt-2 text-sm md:text-base">
                Une inscription rapide et sécurisée pour accéder aux soins augmentés.
            </p>
        </div>

        {{-- Stepper vertical (5 étapes) --}}
        <div class="relative z-10 my-6 md:my-8 space-y-3">
            {{-- Étape 1 active --}}
            <div class="flex items-start gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-r from-accent to-primary text-white flex items-center justify-center font-bold text-sm shadow-lg shadow-primary/20">1</div>
                    <div class="w-0.5 h-8 bg-gradient-to-b from-primary/50 to-gray-200/50 mt-1"></div>
                </div>
                <div>
                    <p class="font-bold text-primary text-sm">Identité</p>
                    <p class="text-xs text-warm-gray">Vos informations personnelles</p>
                </div>
            </div>
            {{-- Étape 2 --}}
            <div class="flex items-start gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-9 h-9 rounded-full border-2 border-gray-300 bg-white/60 text-warm-gray flex items-center justify-center font-bold text-sm">2</div>
                    <div class="w-0.5 h-8 bg-gray-200/50 mt-1"></div>
                </div>
                <div>
                    <p class="font-semibold text-warm-gray text-sm">Données médicales</p>
                    <p class="text-xs text-warm-gray/70">Antécédents & traitements</p>
                </div>
            </div>
            {{-- Étape 3 --}}
            <div class="flex items-start gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-9 h-9 rounded-full border-2 border-gray-300 bg-white/60 text-warm-gray flex items-center justify-center font-bold text-sm">3</div>
                    <div class="w-0.5 h-8 bg-gray-200/50 mt-1"></div>
                </div>
                <div>
                    <p class="font-semibold text-warm-gray text-sm">Vérification</p>
                    <p class="text-xs text-warm-gray/70">Code email</p>
                </div>
            </div>
            {{-- Étape 4 --}}
            <div class="flex items-start gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-9 h-9 rounded-full border-2 border-gray-300 bg-white/60 text-warm-gray flex items-center justify-center font-bold text-sm">4</div>
                    <div class="w-0.5 h-8 bg-gray-200/50 mt-1"></div>
                </div>
                <div>
                    <p class="font-semibold text-warm-gray text-sm">Localisation</p>
                    <p class="text-xs text-warm-gray/70">Adresse & langue</p>
                </div>
            </div>
            {{-- Étape 5 --}}
            <div class="flex items-start gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-9 h-9 rounded-full border-2 border-gray-300 bg-white/60 text-warm-gray flex items-center justify-center font-bold text-sm">5</div>
                </div>
                <div>
                    <p class="font-semibold text-warm-gray text-sm">Confirmation</p>
                    <p class="text-xs text-warm-gray/70">CGU & validation</p>
                </div>
            </div>
        </div>

        <div class="relative z-10 flex items-center gap-3 mt-6 pt-4 border-t border-white/40">
            <div class="w-8 h-8 bg-white/80 rounded-xl flex items-center justify-center">
                <i class="fas fa-heartbeat text-primary"></i>
            </div>
            <span class="font-display font-semibold text-primary text-lg">SynergyAI</span>
        </div>
    </div>

    {{-- PARTIE DROITE : FORMULAIRE --}}
    <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-8">
        <div class="w-full max-w-md glass-card rounded-3xl p-8 shadow-soft">

            {{-- Barre de progression --}}
            <div class="mb-6">
                <div class="flex justify-between items-center text-sm text-warm-gray mb-1">
                    <span class="font-semibold text-primary">Étape 1 / 5</span>
                    <span>Identité</span>
                </div>
                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full w-1/5 bg-gradient-to-r from-accent to-primary rounded-full transition-all duration-500"></div>
                </div>
            </div>

            <h2 class="text-2xl font-display font-bold text-primary text-center mb-1">Vos informations</h2>
            <p class="text-warm-gray text-sm text-center mb-6">Tous les champs sont obligatoires</p>

            <form method="POST" action="{{ route('register.step1.post') }}" enctype="multipart/form-data" class="space-y-5" x-data="{
                photoPreview: null,
                photoName: 'Aucun fichier',
                idPreview: null,
                idName: 'Aucun fichier',
                photoError: '',
                idError: '',
                validateFile(file, maxSize, allowedTypes) {
                    if (!file) return '';
                    if (!allowedTypes.includes(file.type)) return 'Format non accepté (PNG, JPG, JPEG, WEBP, PDF).';
                    if (file.size > maxSize) return `Taille maximale : ${maxSize / 1024 / 1024} Mo.`;
                    return '';
                },
                handlePhoto(e) {
                    const file = e.target.files[0];
                    this.photoError = this.validateFile(file, 5 * 1024 * 1024, ['image/png','image/jpeg','image/webp','application/pdf']);
                    if (!this.photoError) {
                        this.photoName = file.name;
                        const reader = new FileReader();
                        reader.onload = (ev) => this.photoPreview = ev.target.result;
                        reader.readAsDataURL(file);
                    } else {
                        this.photoName = 'Aucun fichier';
                        this.photoPreview = null;
                        e.target.value = '';
                    }
                },
                handleId(e) {
                    const file = e.target.files[0];
                    this.idError = this.validateFile(file, 5 * 1024 * 1024, ['image/png','image/jpeg','image/webp','application/pdf']);
                    if (!this.idError) {
                        this.idName = file.name;
                        const reader = new FileReader();
                        reader.onload = (ev) => this.idPreview = ev.target.result;
                        reader.readAsDataURL(file);
                    } else {
                        this.idName = 'Aucun fichier';
                        this.idPreview = null;
                        e.target.value = '';
                    }
                }
            }" @submit.prevent="
                if (!document.getElementById('photo').files.length || !document.getElementById('piece').files.length) {
                    alert('Veuillez sélectionner les deux fichiers requis.');
                    return;
                }
                if (this.photoError || this.idError) {
                    alert('Veuillez corriger les erreurs de fichier.');
                    return;
                }
                $el.submit();
            ">

                @csrf

                {{-- Prénom & Nom --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="prenom" class="block text-sm font-medium text-warm-gray">Prénom <span class="text-red-500">*</span></label>
                        <div class="relative mt-1">
                            <i class="fas fa-user absolute left-3 top-1/2 -translate-y-1/2 text-warm-gray/60"></i>
                            <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required maxlength="50" pattern="[A-Za-zÀ-ÿ\- ]+" class="input-field pl-10 w-full" placeholder="Jean">
                        </div>
                        @error('prenom') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="nom" class="block text-sm font-medium text-warm-gray">Nom <span class="text-red-500">*</span></label>
                        <div class="relative mt-1">
                            <i class="fas fa-user-tag absolute left-3 top-1/2 -translate-y-1/2 text-warm-gray/60"></i>
                            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required maxlength="50" pattern="[A-Za-zÀ-ÿ\- ]+" class="input-field pl-10 w-full" placeholder="Dupont">
                        </div>
                        @error('nom') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-warm-gray">Email <span class="text-red-500">*</span></label>
                    <div class="relative mt-1">
                        <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-warm-gray/60"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="input-field pl-10 w-full" placeholder="jean.dupont@email.fr">
                    </div>
                    @error('email') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Téléphone --}}
                <div>
                    <label for="telephone" class="block text-sm font-medium text-warm-gray">Téléphone <span class="text-red-500">*</span></label>
                    <div class="relative mt-1">
                        <i class="fas fa-phone absolute left-3 top-1/2 -translate-y-1/2 text-warm-gray/60"></i>
                        <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}" required pattern="[0-9+\-\(\) ]+" maxlength="20" class="input-field pl-10 w-full" placeholder="+33 6 12 34 56 78">
                    </div>
                    @error('telephone') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Photo de profil --}}
                <div>
                    <label for="photo" class="block text-sm font-medium text-warm-gray">
                        Photo de profil <span class="text-red-500">*</span>
                        <span class="text-xs font-normal text-warm-gray/70">(PNG, JPG, WEBP, PDF · max 5 Mo)</span>
                    </label>
                    <div class="mt-1 flex flex-wrap items-center gap-4">
                        <input type="file" id="photo" name="photo_profil" accept="image/png,image/jpeg,image/webp,application/pdf" required class="hidden" @change="handlePhoto($event)">
                        <button type="button" class="btn-secondary text-sm" @click="document.getElementById('photo').click()">
                            <i class="fas fa-upload mr-1"></i> Choisir
                        </button>
                        <span class="text-sm text-warm-gray" x-text="photoName"></span>
                        <template x-if="photoPreview">
                            <img :src="photoPreview" alt="Aperçu photo" class="w-12 h-12 rounded-full object-cover border-2 border-accent">
                        </template>
                    </div>
                    <p class="text-red-500 text-xs mt-1" x-text="photoError" x-show="photoError"></p>
                    @error('photo_profil') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Pièce d'identité --}}
                <div>
                    <label for="piece" class="block text-sm font-medium text-warm-gray">
                        Pièce d'identité <span class="text-red-500">*</span>
                        <span class="text-xs font-normal text-warm-gray/70">(PNG, JPG, WEBP, PDF · max 5 Mo)</span>
                    </label>
                    <div class="mt-1 flex flex-wrap items-center gap-4">
                        <input type="file" id="piece" name="piece_identite" accept="image/png,image/jpeg,image/webp,application/pdf" required class="hidden" @change="handleId($event)">
                        <button type="button" class="btn-secondary text-sm" @click="document.getElementById('piece').click()">
                            <i class="fas fa-id-card mr-1"></i> Choisir
                        </button>
                        <span class="text-sm text-warm-gray" x-text="idName"></span>
                        <template x-if="idPreview && !idPreview.includes('pdf')">
                            <img :src="idPreview" alt="Aperçu pièce" class="w-12 h-12 object-cover border-2 border-accent rounded">
                        </template>
                        <template x-if="idPreview && idPreview.includes('pdf')">
                            <i class="fas fa-file-pdf text-3xl text-red-500"></i>
                        </template>
                    </div>
                    <p class="text-red-500 text-xs mt-1" x-text="idError" x-show="idError"></p>
                    @error('piece_identite') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Boutons --}}
                <div class="flex justify-between items-center pt-4 border-t border-white/30">
                    <a href="{{ route('login') }}" class="text-sm text-warm-gray hover:text-primary transition">
                        <i class="fas fa-arrow-left mr-1"></i> Déjà inscrit ?
                    </a>
                    <button type="submit" class="btn-primary flex items-center gap-2 px-6">
                        Suivant
                        <i class="fas fa-arrow-right text-sm"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection