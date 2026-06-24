@extends('layouts.app')

@section('title', 'SynergyAI · Inscription (3/5)')

@section('content')
<div class="w-full max-w-6xl h-auto md:min-h-[90vh] bg-white/30 backdrop-blur-sm rounded-4xl shadow-soft-lg flex flex-col md:flex-row overflow-hidden border border-white/50">

    {{-- PARTIE GAUCHE (stepper) --}}
    <div class="w-full md:w-2/5 p-8 md:p-10 flex flex-col justify-between relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-gradient-to-br from-accent/20 via-primary/10 to-transparent rounded-full blur-2xl opacity-30"></div>

        <div class="relative z-10 flex flex-col h-full">
            <div class="flex items-center gap-2 text-sm font-semibold text-accent mb-6">
                <i class="fas fa-envelope"></i>
                <span>Vérification</span>
                <span class="ml-auto text-xs bg-white/30 px-3 py-1 rounded-full text-primary">Étape 3/5</span>
            </div>

            <div class="mb-6">
                <h1 class="text-4xl md:text-5xl font-display font-bold text-primary leading-tight">
                    Vérifiez<br>votre email
                </h1>
                <p class="text-warm-gray mt-2 text-sm md:text-base">
                    Un code à 6 chiffres vous a été envoyé à l’adresse indiquée.
                </p>
            </div>

            <div class="bg-white/30 backdrop-blur-sm rounded-2xl p-4 border border-white/50 mb-6">
                <div class="flex items-start gap-3">
                    <i class="fas fa-info-circle text-accent text-lg mt-0.5"></i>
                    <div>
                        <p class="text-sm font-semibold text-primary">Code valable 10 minutes</p>
                        <p class="text-xs text-warm-gray/80 leading-relaxed">
                            Si vous ne recevez pas le code, vérifiez vos spams ou demandez-en un nouveau ci-dessous.
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
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-accent to-primary text-white flex items-center justify-center font-bold text-sm shadow-md shadow-primary/20">3</div>
                        <div class="w-0.5 h-6 bg-gradient-to-b from-primary/50 to-gray-200/50 mt-1"></div>
                    </div>
                    <div>
                        <p class="font-bold text-primary text-sm">Vérification</p>
                        <p class="text-xs text-warm-gray">Code email</p>
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
                <span class="ml-auto text-[10px] text-warm-gray/60">v2.0 · e-santé certifiée</span>
            </div>
        </div>
    </div>

    {{-- PARTIE DROITE : FORMULAIRE --}}
    <div class="w-full md:w-3/5 flex items-center justify-center p-6 md:p-8">
        <div class="w-full max-w-md glass-card rounded-3xl p-8 shadow-soft">

            {{-- Barre de progression --}}
            <div class="mb-6">
                <div class="flex justify-between items-center text-sm text-warm-gray mb-1">
                    <span class="font-semibold text-primary">Étape 3 / 5</span>
                    <span>Vérification</span>
                </div>
                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full w-3/5 bg-gradient-to-r from-accent to-primary rounded-full transition-all duration-500"></div>
                </div>
            </div>

            <h2 class="text-2xl font-display font-bold text-primary text-center mb-1">Code de vérification</h2>
            <p class="text-warm-gray text-sm text-center mb-6">Saisissez le code reçu par email</p>

            {{-- Message flash de succès ou d'erreur --}}
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100/80 text-green-700 rounded-xl text-sm text-center border border-green-300">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100/80 text-red-700 rounded-xl text-sm text-center border border-red-300">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register.step3.post') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="code" class="block text-sm font-medium text-warm-gray text-center">
                        Code à 6 chiffres <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-2 flex justify-center">
                        <input type="text" id="code" name="code" maxlength="6" pattern="\d{6}" required
                               class="w-48 text-center text-2xl tracking-[0.5em] px-4 py-3 rounded-full border border-white/60 bg-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30 outline-none transition"
                               placeholder="• • • • • •"
                               x-data="{
                                   value: '',
                                   format() {
                                       this.value = this.value.replace(/\D/g, '').slice(0,6);
                                   }
                               }"
                               x-model="value"
                               @input="format()"
                               autofocus>
                    </div>
                    @error('code') <span class="text-red-500 text-xs block text-center mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Lien "Renvoyer le code" avec compte à rebours --}}
                <div class="text-center" x-data="{
                    countdown: 0,
                    init() {
                        // Si un timer est déjà en cours (stocké en session ou localStorage, on le restaure)
                        const saved = localStorage.getItem('resend_timer');
                        if (saved) {
                            const diff = Math.floor((Date.now() - parseInt(saved)) / 1000);
                            if (diff < 60) {
                                this.countdown = 60 - diff;
                                this.startTimer();
                            } else {
                                localStorage.removeItem('resend_timer');
                            }
                        }
                    },
                    startTimer() {
                        if (this.countdown > 0) {
                            const interval = setInterval(() => {
                                this.countdown--;
                                if (this.countdown <= 0) {
                                    clearInterval(interval);
                                    localStorage.removeItem('resend_timer');
                                }
                            }, 1000);
                        }
                    },
                    resendCode() {
                        if (this.countdown > 0) return;
                        // Désactiver le bouton
                        this.countdown = 60;
                        localStorage.setItem('resend_timer', Date.now().toString());
                        this.startTimer();

                        // Appel AJAX vers la route de renvoi
                        fetch('{{ route('register.resend') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.success);
                            } else {
                                alert(data.error || 'Une erreur est survenue.');
                                // En cas d'erreur, réinitialiser le timer
                                this.countdown = 0;
                                localStorage.removeItem('resend_timer');
                            }
                        })
                        .catch(error => {
                            alert('Erreur réseau. Veuillez réessayer.');
                            this.countdown = 0;
                            localStorage.removeItem('resend_timer');
                        });
                    }
                }">
                    <button type="button" @click="resendCode()" :disabled="countdown > 0"
                            class="text-sm text-accent hover:underline transition disabled:opacity-50 disabled:cursor-not-allowed">
                        <span x-show="countdown === 0">Renvoyer le code</span>
                        <span x-show="countdown > 0" x-text="`Renvoyer dans ${countdown}s`"></span>
                    </button>
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-white/30">
                    <a href="{{ route('register.step2') }}" class="text-sm text-warm-gray hover:text-primary transition">
                        <i class="fas fa-arrow-left mr-1"></i> Retour
                    </a>
                    <button type="submit" class="btn-primary flex items-center gap-2 px-6">
                        Vérifier
                        <i class="fas fa-check text-sm"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection