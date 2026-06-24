@extends('layouts.app')

@section('title', 'SynergyAI · Inscription (4/5)')

@section('content')
<div class="w-full max-w-6xl h-auto md:min-h-[90vh] bg-white/30 backdrop-blur-sm rounded-4xl shadow-soft-lg flex flex-col md:flex-row overflow-hidden border border-white/50">

    {{-- PARTIE GAUCHE (stepper) --}}
    <div class="w-full md:w-2/5 p-8 md:p-10 flex flex-col justify-between relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-gradient-to-br from-accent/20 via-primary/10 to-transparent rounded-full blur-2xl opacity-30"></div>

        <div class="relative z-10 flex flex-col h-full">
            <div class="flex items-center gap-2 text-sm font-semibold text-accent mb-6">
                <i class="fas fa-map-pin"></i>
                <span>Localisation</span>
                <span class="ml-auto text-xs bg-white/30 px-3 py-1 rounded-full text-primary">Étape 4/5</span>
            </div>

            <div class="mb-6">
                <h1 class="text-4xl md:text-5xl font-display font-bold text-primary leading-tight">
                    Où<br>habitez‑vous ?
                </h1>
                <p class="text-warm-gray mt-2 text-sm md:text-base">
                    Ces informations nous aident à adapter nos services à votre région.
                </p>
            </div>

            <div class="bg-white/30 backdrop-blur-sm rounded-2xl p-4 border border-white/50 mb-6">
                <div class="flex items-start gap-3">
                    <i class="fas fa-globe-africa text-accent text-lg mt-0.5"></i>
                    <div>
                        <p class="text-sm font-semibold text-primary">Langue préférée</p>
                        <p class="text-xs text-warm-gray/80 leading-relaxed">
                            Nous vous enverrons des communications dans la langue de votre choix.
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
                        <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center text-sm shadow-md">
                            <i class="fas fa-check text-xs"></i>
                        </div>
                        <div class="w-0.5 h-6 bg-gray-200/50 mt-1"></div>
                    </div>
                    <div>
                        <p class="font-semibold text-green-600 text-sm">Données médicales</p>
                        <p class="text-xs text-warm-gray/70">Antécédents & traitements</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center text-sm shadow-md">
                            <i class="fas fa-check text-xs"></i>
                        </div>
                        <div class="w-0.5 h-6 bg-gray-200/50 mt-1"></div>
                    </div>
                    <div>
                        <p class="font-semibold text-green-600 text-sm">Vérification</p>
                        <p class="text-xs text-warm-gray/70">Code email</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-accent to-primary text-white flex items-center justify-center font-bold text-sm shadow-md shadow-primary/20">4</div>
                        <div class="w-0.5 h-6 bg-gradient-to-b from-primary/50 to-gray-200/50 mt-1"></div>
                    </div>
                    <div>
                        <p class="font-bold text-primary text-sm">Localisation</p>
                        <p class="text-xs text-warm-gray">Adresse & langue</p>
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
                <span class="ml-auto text-[10px] text-warm-gray/60">v2.0 · e-santé certifiée</span>
            </div>
        </div>
    </div>

    {{-- PARTIE DROITE : FORMULAIRE --}}
    <div class="w-full md:w-3/5 flex items-center justify-center p-6 md:p-8">
        <div class="w-full max-w-2xl glass-card rounded-3xl p-6 md:p-8 shadow-soft">

            {{-- Barre de progression --}}
            <div class="mb-6">
                <div class="flex justify-between items-center text-sm text-warm-gray mb-1">
                    <span class="font-semibold text-primary">Étape 4 / 5</span>
                    <span>Localisation</span>
                </div>
                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full w-4/5 bg-gradient-to-r from-accent to-primary rounded-full transition-all duration-500"></div>
                </div>
            </div>

            <h2 class="text-2xl font-display font-bold text-primary text-center mb-1">Votre lieu de vie</h2>
            <p class="text-warm-gray text-sm text-center mb-6">Les champs marqués d’un <span class="text-red-500">*</span> sont obligatoires</p>

            <form method="POST" action="{{ route('register.step4.post') }}" class="space-y-6">
                @csrf

                {{-- Adresse --}}
                <div>
                    <label for="adresse" class="block text-sm font-medium text-warm-gray">Adresse complète</label>
                    <input type="text" id="adresse" name="adresse" value="{{ old('adresse') }}" class="input-field w-full mt-1" placeholder="12 rue des Lilas, 75000 Paris">
                    @error('adresse') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="adresse_rue" class="block text-sm font-medium text-warm-gray">Rue / voie</label>
                        <input type="text" id="adresse_rue" name="adresse_rue" value="{{ old('adresse_rue') }}" class="input-field w-full mt-1" placeholder="12 rue des Lilas">
                        @error('adresse_rue') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="ville" class="block text-sm font-medium text-warm-gray">Ville</label>
                        <input type="text" id="ville" name="ville" value="{{ old('ville') }}" class="input-field w-full mt-1" placeholder="Paris">
                        @error('ville') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="code_postal" class="block text-sm font-medium text-warm-gray">Code postal</label>
                        <input type="text" id="code_postal" name="code_postal" value="{{ old('code_postal') }}" class="input-field w-full mt-1" placeholder="75000">
                        @error('code_postal') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="pays" class="block text-sm font-medium text-warm-gray">Pays</label>
                        <input type="text" id="pays" name="pays" value="{{ old('pays', 'France') }}" class="input-field w-full mt-1" placeholder="France">
                        @error('pays') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Coordonnées GPS (optionnelles) --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-warm-gray">Latitude</label>
                        <input type="number" id="latitude" name="latitude" value="{{ old('latitude') }}" step="any" class="input-field w-full mt-1" placeholder="48.8566">
                        @error('latitude') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="longitude" class="block text-sm font-medium text-warm-gray">Longitude</label>
                        <input type="number" id="longitude" name="longitude" value="{{ old('longitude') }}" step="any" class="input-field w-full mt-1" placeholder="2.3522">
                        @error('longitude') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Téléphone d'urgence --}}
                <div>
                    <label for="telephone_urgence" class="block text-sm font-medium text-warm-gray">Téléphone d’urgence (proche)</label>
                    <input type="tel" id="telephone_urgence" name="telephone_urgence" value="{{ old('telephone_urgence') }}" class="input-field w-full mt-1" placeholder="06 12 34 56 78">
                    @error('telephone_urgence') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Langue préférée --}}
                <div>
                    <label for="langue_preferee" class="block text-sm font-medium text-warm-gray">Langue préférée <span class="text-red-500">*</span></label>
                    <select id="langue_preferee" name="langue_preferee" required class="input-field w-full mt-1 appearance-none">
                        <option value="">Sélectionnez une langue</option>
                        <option value="fr" {{ old('langue_preferee', 'fr') == 'fr' ? 'selected' : '' }}>Français</option>
                        <option value="en" {{ old('langue_preferee') == 'en' ? 'selected' : '' }}>Anglais</option>
                        <option value="pt" {{ old('langue_preferee') == 'pt' ? 'selected' : '' }}>Portugais</option>
                        <option value="sw" {{ old('langue_preferee') == 'sw' ? 'selected' : '' }}>Swahili</option>
                        <option value="ha" {{ old('langue_preferee') == 'ha' ? 'selected' : '' }}>Haoussa</option>
                        <option value="yo" {{ old('langue_preferee') == 'yo' ? 'selected' : '' }}>Yoruba</option>
                        <option value="ig" {{ old('langue_preferee') == 'ig' ? 'selected' : '' }}>Igbo</option>
                        <option value="am" {{ old('langue_preferee') == 'am' ? 'selected' : '' }}>Amharique</option>
                        <option value="ar" {{ old('langue_preferee') == 'ar' ? 'selected' : '' }}>Arabe</option>
                    </select>
                    @error('langue_preferee') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Boutons --}}
                <div class="flex justify-between items-center pt-4 border-t border-white/30">
                    <a href="{{ route('register.step3') }}" class="text-sm text-warm-gray hover:text-primary transition">
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