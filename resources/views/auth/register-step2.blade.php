@extends('layouts.app')

@section('title', 'SynergyAI · Inscription (2/5)')

@section('content')
<div class="w-full max-w-6xl h-auto md:min-h-[90vh] bg-white/30 backdrop-blur-sm rounded-4xl shadow-soft-lg flex flex-col md:flex-row overflow-hidden border border-white/50">

    {{-- PARTIE GAUCHE (stepper) --}}
    <div class="w-full md:w-2/5 p-8 md:p-10 flex flex-col justify-between relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-gradient-to-br from-accent/20 via-primary/10 to-transparent rounded-full blur-2xl opacity-30"></div>

        <div class="relative z-10 flex flex-col h-full">
            <div class="flex items-center gap-2 text-sm font-semibold text-accent mb-6">
                <i class="fas fa-notes-medical"></i>
                <span>Données médicales</span>
            </div>

            <div class="mb-6">
                <h1 class="text-4xl md:text-5xl font-display font-bold text-primary leading-tight">
                    Votre profil<br>médical
                </h1>
                <p class="text-warm-gray mt-2 text-sm md:text-base">
                    Ces informations aident nos médecins à mieux vous connaître.
                </p>
            </div>

            <div class="bg-white/30 backdrop-blur-sm rounded-2xl p-4 border border-white/50 mb-6">
                <div class="flex items-start gap-3">
                    <i class="fas fa-info-circle text-accent text-lg mt-0.5"></i>
                    <div>
                        <p class="text-sm font-semibold text-primary">Pourquoi ces données ?</p>
                        <p class="text-xs text-warm-gray/80 leading-relaxed">
                            Elles permettent à notre équipe de personnaliser votre suivi et d’anticiper d’éventuelles allergies ou interactions médicamenteuses. Toutes vos informations sont chiffrées et restent confidentielles.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Stepper vertical --}}
            <div class="space-y-2 mb-6">
                <div class="flex items-start gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center text-sm shadow-md">
                            <i class="fas fa-check text-xs"></i>
                        </div>
                        <div class="w-0.5 h-6 bg-gray-200/50 mt-1"></div>
                    </div>
                    <div>
                        <p class="font-semibold text-green-600 text-sm">Identité</p>
                        <p class="text-xs text-warm-gray/70">Informations personnelles</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-accent to-primary text-white flex items-center justify-center font-bold text-sm shadow-md shadow-primary/20">2</div>
                        <div class="w-0.5 h-6 bg-gradient-to-b from-primary/50 to-gray-200/50 mt-1"></div>
                    </div>
                    <div>
                        <p class="font-bold text-primary text-sm">Données médicales</p>
                        <p class="text-xs text-warm-gray">Antécédents & traitements</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full border-2 border-gray-300 bg-white/60 text-warm-gray flex items-center justify-center font-bold text-sm">3</div>
                        <div class="w-0.5 h-6 bg-gray-200/50 mt-1"></div>
                    </div>
                    <div>
                        <p class="font-semibold text-warm-gray text-sm">Vérification</p>
                        <p class="text-xs text-warm-gray/70">Code email</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full border-2 border-gray-300 bg-white/60 text-warm-gray flex items-center justify-center font-bold text-sm">4</div>
                        <div class="w-0.5 h-6 bg-gray-200/50 mt-1"></div>
                    </div>
                    <div>
                        <p class="font-semibold text-warm-gray text-sm">Localisation</p>
                        <p class="text-xs text-warm-gray/70">Adresse & langue</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full border-2 border-gray-300 bg-white/60 text-warm-gray flex items-center justify-center font-bold text-sm">5</div>
                    </div>
                    <div>
                        <p class="font-semibold text-warm-gray text-sm">Confirmation</p>
                        <p class="text-xs text-warm-gray/70">CGU & validation</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 mt-auto pt-4 border-t border-white/40">
                <div class="w-8 h-8 bg-white/80 rounded-xl flex items-center justify-center">
                    <i class="fas fa-heartbeat text-primary"></i>
                </div>
                <span class="font-display font-semibold text-primary text-lg">SynergyAI</span>
            </div>
        </div>
    </div>

    {{-- PARTIE DROITE : FORMULAIRE REFONDU --}}
    <div class="w-full md:w-3/5 flex items-center justify-center p-6 md:p-8">
        <div class="w-full max-w-2xl glass-card rounded-3xl p-6 md:p-8 shadow-soft">

            {{-- Barre de progression --}}
            <div class="mb-6">
                <div class="flex justify-between items-center text-sm text-warm-gray mb-1">
                    <span class="font-semibold text-primary">Étape 2 / 5</span>
                    <span>Données médicales</span>
                </div>
                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full w-2/5 bg-gradient-to-r from-accent to-primary rounded-full transition-all duration-500"></div>
                </div>
            </div>

            <h2 class="text-2xl font-display font-bold text-primary text-center mb-1">Votre santé</h2>
            <p class="text-warm-gray text-sm text-center mb-6">Tous les champs sont obligatoires sauf mention contraire</p>

            <form method="POST" action="{{ route('register.step2.post') }}" enctype="multipart/form-data" class="space-y-6" x-data="{
                dateNaissance: '',
                validateDate(date) {
                    if (!date) return 'Date de naissance requise.';
                    const today = new Date();
                    const birth = new Date(date);
                    let age = today.getFullYear() - birth.getFullYear();
                    const m = today.getMonth() - birth.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
                    if (age < 18) return 'Vous devez avoir au moins 18 ans.';
                    if (age > 120) return 'Âge invalide.';
                    return '';
                }
            }" @submit.prevent="
                const dateError = validateDate(document.getElementById('date_naissance').value);
                if (dateError) {
                    alert(dateError);
                    return;
                }
                $el.submit();
            ">

                @csrf

                {{-- 1. INFORMATIONS PERSONNELLES (2 colonnes) --}}
                <div class="bg-white/20 rounded-2xl p-5 border border-white/40">
                    <div class="flex items-center gap-2 text-sm font-semibold text-primary mb-4">
                        <i class="fas fa-user-circle text-accent"></i>
                        <span>Informations personnelles</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Date de naissance --}}
                        <div class="md:col-span-2">
                            <label for="date_naissance" class="block text-sm font-medium text-warm-gray">Date de naissance <span class="text-red-500">*</span></label>
                            <div class="relative mt-1">
                                <i class="fas fa-calendar-alt absolute left-3 top-1/2 -translate-y-1/2 text-warm-gray/60"></i>
                                <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required max="2006-01-01" class="input-field pl-10 w-full">
                            </div>
                            @error('date_naissance') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- Sexe --}}
                        <div>
                            <label for="sexe" class="block text-sm font-medium text-warm-gray">Sexe <span class="text-red-500">*</span></label>
                            <div class="relative mt-1">
                                <i class="fas fa-venus-mars absolute left-3 top-1/2 -translate-y-1/2 text-warm-gray/60"></i>
                                <select id="sexe" name="sexe" required class="input-field pl-10 w-full appearance-none">
                                    <option value="">Sélectionnez</option>
                                    <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Masculin</option>
                                    <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Féminin</option>
                                    <option value="A" {{ old('sexe') == 'A' ? 'selected' : '' }}>Autre</option>
                                </select>
                            </div>
                            @error('sexe') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- Groupe sanguin --}}
                        <div>
                            <label for="groupe_sanguin" class="block text-sm font-medium text-warm-gray">Groupe sanguin</label>
                            <select id="groupe_sanguin" name="groupe_sanguin" class="input-field w-full mt-1 appearance-none">
                                <option value="">Non renseigné</option>
                                @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $g)
                                    <option value="{{ $g }}" {{ old('groupe_sanguin') == $g ? 'selected' : '' }}>{{ $g }}</option>
                                @endforeach
                            </select>
                            @error('groupe_sanguin') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- Poids --}}
                        <div>
                            <label for="poids" class="block text-sm font-medium text-warm-gray">Poids (kg) <span class="text-red-500">*</span></label>
                            <div class="relative mt-1">
                                <i class="fas fa-weight absolute left-3 top-1/2 -translate-y-1/2 text-warm-gray/60"></i>
                                <input type="number" id="poids" name="poids" value="{{ old('poids') }}" required min="1" max="300" step="0.1" class="input-field pl-10 w-full" placeholder="70">
                            </div>
                            @error('poids') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- Taille --}}
                        <div>
                            <label for="taille" class="block text-sm font-medium text-warm-gray">Taille (cm) <span class="text-red-500">*</span></label>
                            <div class="relative mt-1">
                                <i class="fas fa-ruler-vertical absolute left-3 top-1/2 -translate-y-1/2 text-warm-gray/60"></i>
                                <input type="number" id="taille" name="taille" value="{{ old('taille') }}" required min="50" max="250" step="1" class="input-field pl-10 w-full" placeholder="175">
                            </div>
                            @error('taille') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- 2. ANTÉCÉDENTS & ALLERGIES (2 colonnes) --}}
                <div class="bg-white/20 rounded-2xl p-5 border border-white/40">
                    <div class="flex items-center gap-2 text-sm font-semibold text-primary mb-4">
                        <i class="fas fa-notes-medical text-accent"></i>
                        <span>Antécédents & allergies</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="allergies" class="block text-sm font-medium text-warm-gray">Allergies connues</label>
                            <textarea id="allergies" name="allergies" rows="2" class="input-field w-full mt-1" placeholder="Ex: pénicilline, arachides...">{{ old('allergies') }}</textarea>
                            @error('allergies') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="traitements" class="block text-sm font-medium text-warm-gray">Traitements en cours</label>
                            <textarea id="traitements" name="traitements" rows="2" class="input-field w-full mt-1" placeholder="Médicaments, doses...">{{ old('traitements') }}</textarea>
                            @error('traitements') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="antecedents_personnels" class="block text-sm font-medium text-warm-gray">Antécédents personnels</label>
                            <textarea id="antecedents_personnels" name="antecedents_personnels" rows="2" class="input-field w-full mt-1" placeholder="Chirurgies, maladies...">{{ old('antecedents_personnels') }}</textarea>
                            @error('antecedents_personnels') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="antecedents_familiaux" class="block text-sm font-medium text-warm-gray">Antécédents familiaux</label>
                            <textarea id="antecedents_familiaux" name="antecedents_familiaux" rows="2" class="input-field w-full mt-1" placeholder="Maladies héréditaires...">{{ old('antecedents_familiaux') }}</textarea>
                            @error('antecedents_familiaux') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- 3. MÉDECIN TRAITANT + DOCUMENT (2 colonnes) --}}
                <div class="bg-white/20 rounded-2xl p-5 border border-white/40">
                    <div class="flex items-center gap-2 text-sm font-semibold text-primary mb-4">
                        <i class="fas fa-user-md text-accent"></i>
                        <span>Médecin traitant & documents</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="medecin_nom" class="block text-sm font-medium text-warm-gray">Nom du médecin traitant</label>
                            <input type="text" id="medecin_nom" name="medecin_nom" value="{{ old('medecin_nom') }}" class="input-field w-full mt-1" placeholder="Dupont">
                            @error('medecin_nom') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="medecin_telephone" class="block text-sm font-medium text-warm-gray">Téléphone du médecin</label>
                            <input type="tel" id="medecin_telephone" name="medecin_telephone" value="{{ old('medecin_telephone') }}" class="input-field w-full mt-1" placeholder="01 23 45 67 89">
                            @error('medecin_telephone') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label for="piece_medicale" class="block text-sm font-medium text-warm-gray">
                                Document médical complémentaire (facultatif)
                                <span class="text-xs font-normal text-warm-gray/70">(PDF, JPG, PNG · max 5 Mo)</span>
                            </label>
                            <div class="mt-1 flex flex-wrap items-center gap-4">
                                <input type="file" id="piece_medicale" name="piece_medicale" accept=".pdf,image/*" class="hidden" x-ref="pieceInput">
                                <button type="button" class="btn-secondary text-sm" @click="$refs.pieceInput.click()">
                                    <i class="fas fa-paperclip mr-1"></i> Joindre
                                </button>
                                <span class="text-sm text-warm-gray" x-text="$refs.pieceInput?.files[0]?.name || 'Aucun fichier'"></span>
                            </div>
                            @error('piece_medicale') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- Boutons de navigation --}}
                <div class="flex justify-between items-center pt-4 border-t border-white/30">
                    <a href="{{ route('register.step1') }}" class="text-sm text-warm-gray hover:text-primary transition">
                        <i class="fas fa-arrow-left mr-1"></i> Retour
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