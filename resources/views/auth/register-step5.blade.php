@extends('layouts.app')

@section('title', 'SynergyAI · Inscription (5/5)')

@section('content')
<div class="w-full max-w-6xl h-auto md:min-h-[90vh] bg-white/30 backdrop-blur-sm rounded-4xl shadow-soft-lg flex flex-col md:flex-row overflow-hidden border border-white/50">

    {{-- PARTIE GAUCHE (stepper) --}}
    <div class="w-full md:w-2/5 p-8 md:p-10 flex flex-col justify-between relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-gradient-to-br from-accent/20 via-primary/10 to-transparent rounded-full blur-2xl opacity-30"></div>

        <div class="relative z-10 flex flex-col h-full">
            <div class="flex items-center gap-2 text-sm font-semibold text-accent mb-6">
                <i class="fas fa-file-contract"></i>
                <span>Confirmation</span>
                <span class="ml-auto text-xs bg-white/30 px-3 py-1 rounded-full text-primary">Étape 5/5</span>
            </div>

            <div class="mb-6">
                <h1 class="text-4xl md:text-5xl font-display font-bold text-primary leading-tight">
                    Dernière<br>étape
                </h1>
                <p class="text-warm-gray mt-2 text-sm md:text-base">
                    Acceptez nos conditions pour finaliser votre inscription.
                </p>
            </div>

            <div class="bg-white/30 backdrop-blur-sm rounded-2xl p-4 border border-white/50 mb-6">
                <div class="flex items-start gap-3">
                    <i class="fas fa-shield-alt text-accent text-lg mt-0.5"></i>
                    <div>
                        <p class="text-sm font-semibold text-primary">Données sécurisées</p>
                        <p class="text-xs text-warm-gray/80 leading-relaxed">
                            Toutes vos informations sont cryptées et ne seront jamais partagées sans votre consentement.
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
                        <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center text-sm shadow-md">
                            <i class="fas fa-check text-xs"></i>
                        </div>
                        <div class="w-0.5 h-6 bg-gray-200/50 mt-1"></div>
                    </div>
                    <div>
                        <p class="font-semibold text-green-600 text-sm">Localisation</p>
                        <p class="text-xs text-warm-gray/70">Adresse & langue</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-accent to-primary text-white flex items-center justify-center font-bold text-sm shadow-md shadow-primary/20">5</div>
                    </div>
                    <div>
                        <p class="font-bold text-primary text-sm">Confirmation</p>
                        <p class="text-xs text-warm-gray">CGU & validation</p>
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
                    <span class="font-semibold text-primary">Étape 5 / 5</span>
                    <span>Confirmation</span>
                </div>
                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full w-full bg-gradient-to-r from-accent to-primary rounded-full transition-all duration-500"></div>
                </div>
            </div>

            <h2 class="text-2xl font-display font-bold text-primary text-center mb-1">Politiques de confidentialité</h2>
            <p class="text-warm-gray text-sm text-center mb-6">Veuillez lire attentivement avant d’accepter</p>

            <form method="POST" action="{{ route('register.step5.post') }}" class="space-y-6">
                @csrf

                {{-- Bloc des CGU --}}
                <div class="bg-white/40 rounded-2xl p-4 border border-white/50 max-h-60 overflow-y-auto text-sm text-warm-gray/80 leading-relaxed">
                    <h3 class="font-semibold text-primary">Conditions générales d'utilisation</h3>
                    <p class="mt-2">Bienvenue sur Synergy Medical Assistant. En vous inscrivant, vous acceptez de fournir des informations exactes et à jour. Vos données personnelles sont collectées dans le cadre de la prise en charge médicale et sont protégées conformément au RGPD. Vous disposez d’un droit d’accès, de rectification et de suppression. Les données médicales sont partagées uniquement avec votre médecin traitant et les professionnels de santé impliqués dans votre suivi.</p>
                    <p class="mt-2">SynergyAI s’engage à ne pas revendre vos données à des tiers. Vous pouvez à tout moment demander la suppression de votre compte. L’utilisation de la plateforme est soumise à une charte de bonne conduite. En cochant la case ci-dessous, vous confirmez avoir pris connaissance et accepté ces conditions.</p>
                    <p class="mt-2 text-xs italic text-warm-gray/60">Dernière mise à jour : juin 2026</p>
                </div>

                {{-- Case à cocher --}}
                <div class="flex items-start gap-3">
                    <input type="checkbox" name="accept" id="accept" value="1" required
                           class="mt-1 h-5 w-5 rounded border-gray-300 text-accent focus:ring-accent/30 transition">
                    <label for="accept" class="text-sm text-warm-gray">
                        J’accepte les <strong>conditions d’utilisation</strong> et la <strong>politique de confidentialité</strong>.
                        <span class="text-red-500">*</span>
                    </label>
                </div>
                @error('accept') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror

                {{-- Boutons --}}
                <div class="flex justify-between items-center pt-4 border-t border-white/30">
                    <a href="{{ route('register.step4') }}" class="text-sm text-warm-gray hover:text-primary transition">
                        <i class="fas fa-arrow-left mr-1"></i> Retour
                    </a>
                    <button type="submit" class="btn-primary flex items-center gap-2 px-6">
                        Finaliser l'inscription
                        <i class="fas fa-check-circle text-sm"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection