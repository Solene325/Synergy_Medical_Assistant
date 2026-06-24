<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SynergyAI · Connexion</title>

    <!-- Tailwind + config -->
    <script src="https://cdn.tailwindcss.com">
    </script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#0A4A3B',
                        'primary-light': '#117A5D',
                        'accent': '#E27B46',
                        'accent-light': '#F3B391',
                        'gold': '#D4A843',
                        'gold-light': '#F2D78D',
                        'slate': '#1B4F6E',
                        'slate-light': '#347B98',
                        'cream': '#FCF9F2',
                        'sand': '#F4EDE0',
                        'warm-gray': '#5C5346',
                    },
                    fontFamily: {
                        'display': ['"Outfit"', 'sans-serif'],
                        'body': ['"DM Sans"', 'sans-serif'],
                    },
                    borderRadius: {
                        '3xl': '1.75rem',
                        '4xl': '2.25rem',
                    },
                    boxShadow: {
                        'soft': '0 20px 40px -15px rgba(10, 74, 59, 0.12)',
                        'soft-lg': '0 30px 55px -20px rgba(10, 74, 59, 0.18)',
                        'glow-accent': '0 0 40px -8px rgba(226, 123, 70, 0.25)',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-slow': 'float 9s ease-in-out 1s infinite',
                        'pulse-ring': 'pulseRing 2.5s ease-out infinite',
                        'shimmer-btn': 'shimmerBtn 2.5s ease-in-out infinite',
                        'pulse-soft': 'pulseSoft 4s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-12px)' },
                        },
                        pulseRing: {
                            '0%': { transform: 'scale(1)', opacity: '0.6' },
                            '100%': { transform: 'scale(2.2)', opacity: '0' },
                        },
                        shimmerBtn: {
                            '0%': { backgroundPosition: '-200% 0' },
                            '100%': { backgroundPosition: '200% 0' },
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: 1 },
                            '50%': { opacity: 0.6 },
                        },
                    },
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js">
    </script>

    <style>
        /* Reset & base */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #F4EDE0;
            font-family: 'DM Sans', sans-serif;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Fond avec orbes */
        .auth-bg {
            position: relative;
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background:
                radial-gradient(ellipse at 20% 80%, rgba(10, 74, 59, 0.06) 0%, transparent 55%),
                radial-gradient(ellipse at 80% 20%, rgba(226, 123, 70, 0.08) 0%, transparent 55%),
                #F4EDE0;
            overflow: hidden;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            will-change: transform;
        }
        .orb-1 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(226, 123, 70, 0.15) 0%, transparent 70%);
            top: -120px;
            right: -120px;
            animation: float 10s ease-in-out infinite;
        }
        .orb-2 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(10, 74, 59, 0.10) 0%, transparent 70%);
            bottom: -80px;
            left: -80px;
            animation: float 12s ease-in-out infinite reverse;
        }
        .orb-3 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(212, 168, 67, 0.12) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: float 14s ease-in-out infinite alternate;
        }

        /* Carte principale */
        .auth-card {
            background: rgba(255, 255, 255, 0.40);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 2.25rem;
            box-shadow: 0 30px 60px -20px rgba(10, 74, 59, 0.20);
            transition: box-shadow 0.4s ease;
            overflow: hidden;
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1120px;
            min-height: 70vh;
            display: flex;
            flex-direction: column;
        }
        .auth-card:hover {
            box-shadow: 0 40px 70px -25px rgba(10, 74, 59, 0.25);
        }
        @media (min-width: 768px) {
            .auth-card {
                flex-direction: row;
                min-height: 75vh;
            }
        }

        /* Panneau gauche - branding (35%) */
        .brand-panel {
            background: rgba(255, 255, 255, 0.20);
            backdrop-filter: blur(12px) saturate(160%);
            -webkit-backdrop-filter: blur(12px) saturate(160%);
            border-right: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 2.25rem 0 0 2.25rem;
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 0 0 35%;
            position: relative;
            overflow: hidden;
        }
        @media (max-width: 767px) {
            .brand-panel {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.4);
                border-radius: 2.25rem 2.25rem 0 0;
                flex: 0 0 auto;
                padding: 2rem 1.5rem;
            }
        }

        .brand-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 30%, rgba(212, 168, 67, 0.05) 0%, transparent 60%),
                radial-gradient(circle at 80% 70%, rgba(226, 123, 70, 0.06) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }
        .brand-panel>* {
            position: relative;
            z-index: 1;
        }

        /* Panneau droit - formulaire (65%) - ESPACEMENT RÉDUIT */
        .form-panel {
            padding: 1.8rem 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            background: rgba(255, 255, 255, 0.10);
        }
        @media (max-width: 767px) {
            .form-panel {
                padding: 1.5rem 1.2rem;
            }
        }

        .form-card {
            width: 100%;
            max-width: 380px;
            /* Espacement vertical réduit */
        }

        /* Avatar - correction pour qu'il soit visible */
        .avatar-wrapper {
            margin-top: -2rem;
            /* Ajusté pour être visible */
            margin-bottom: 0.5rem;
        }

        /* Champs */
        .input-field {
            background: rgba(255, 255, 255, 0.50);
            border: 1.5px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
            color: #2d2a25;
            border-radius: 1.5rem;
            padding: 0.7rem 1rem 0.7rem 2.75rem;
            font-size: 0.9rem;
            width: 100%;
            backdrop-filter: blur(4px);
        }
        .input-field::placeholder {
            color: rgba(92, 83, 70, 0.35);
            font-weight: 300;
        }
        .input-field:focus {
            background: rgba(255, 255, 255, 0.75);
            border-color: #0A4A3B;
            box-shadow: 0 0 0 4px rgba(10, 74, 59, 0.06), 0 0 20px -8px rgba(10, 74, 59, 0.10);
            outline: none;
        }
        .input-field:focus+.input-icon {
            color: #0A4A3B;
        }

        .input-icon {
            color: rgba(92, 83, 70, 0.30);
            transition: color 0.3s ease;
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            font-size: 1rem;
        }
        .input-group {
            position: relative;
        }

        /* Bouton */
        .btn-login {
            background: linear-gradient(135deg, #0A4A3B 0%, #0D5C4A 60%, #083D30 100%);
            background-size: 200% 200%;
            color: #fff;
            border: none;
            border-radius: 3rem;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            letter-spacing: 0.01em;
            box-shadow: 0 10px 22px -8px rgba(10, 74, 59, 0.35);
            transition: all 0.35s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        .btn-login::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(105deg, transparent 30%, rgba(255, 255, 255, 0.15) 50%, transparent 70%);
            background-size: 250% 100%;
            animation: shimmerBtn 3s ease-in-out infinite;
            pointer-events: none;
        }
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 30px -10px rgba(10, 74, 59, 0.45);
        }
        .btn-login:active {
            transform: scale(0.98);
        }

        /* Lien inscription */
        .register-link {
            position: relative;
            font-weight: 600;
            color: #0A4A3B;
            transition: color 0.25s ease;
            text-decoration: none;
        }
        .register-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 1.5px;
            background: #0A4A3B;
            transform: scaleX(0);
            transform-origin: right center;
            transition: transform 0.35s ease;
        }
        .register-link:hover {
            color: #E27B46;
        }
        .register-link:hover::after {
            transform: scaleX(1);
            transform-origin: left center;
            background: #E27B46;
        }

        /* Badge sécurité */
        .security-badge {
            background: rgba(255, 255, 255, 0.40);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 9999px;
            padding: 0.25rem 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.65rem;
            color: #5C5346;
        }
        .security-badge i {
            color: #0A4A3B;
        }

        /* Toast */
        .toast-success {
            animation: slideDown 0.5s ease-out, fadeOut 0.4s ease-in 4.2s forwards;
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-16px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateY(-12px) scale(0.96);
            }
        }

        /* Language switcher */
        .lang-switcher {
            position: absolute;
            top: 1.2rem;
            right: 1.2rem;
            z-index: 20;
        }
        .lang-btn {
            background: rgba(255, 255, 255, 0.50);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 9999px;
            padding: 0.3rem 0.8rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.3rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .lang-btn:hover {
            background: rgba(255, 255, 255, 0.75);
        }
        .lang-dropdown {
            position: absolute;
            top: 2.5rem;
            right: 0;
            background: rgba(255, 255, 255, 0.90);
            backdrop-filter: blur(12px);
            border-radius: 1rem;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            display: none;
            z-index: 30;
            min-width: 160px;
            padding: 0.3rem 0;
            max-height: 260px;
            overflow-y: auto;
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        .lang-dropdown.show {
            display: block;
        }
        .lang-option {
            padding: 0.4rem 1rem;
            cursor: pointer;
            font-size: 0.8rem;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #2d2a25;
        }
        .lang-option:hover {
            background: rgba(10, 74, 59, 0.05);
        }
        .lang-option.active {
            font-weight: 600;
            color: var(--primary);
            background: rgba(10, 74, 59, 0.08);
        }

        /* AOS overrides */
        [data-aos="fade-up"] {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        [data-aos="fade-up"].aos-animate {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .brand-panel {
                padding: 1.5rem 1rem;
            }
            .form-panel {
                padding: 1rem 0.8rem;
            }
            .auth-card {
                border-radius: 1.75rem;
            }
            .lang-switcher {
                top: 0.8rem;
                right: 0.8rem;
            }
            .lang-btn {
                font-size: 0.65rem;
                padding: 0.2rem 0.6rem;
            }
            .avatar-wrapper {
                margin-top: -1.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="auth-bg">

        <!-- Orbes -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <!-- Carte principale -->
        <div class="auth-card" data-aos="fade-up" data-aos-duration="800">

            <!-- Language switcher -->
            <div class="lang-switcher" data-aos="fade-down" data-aos-delay="100">
                <button id="langButton" class="lang-btn">
                    <i class="fas fa-globe text-xs"></i>
                    <span id="currentLang">FR</span>
                    <i class="fas fa-chevron-down text-[10px]"></i>
                </button>
                <div id="langDropdown" class="lang-dropdown"></div>
            </div>

            <!-- ========== PANEL GAUCHE : BRANDING ========== -->
            <div class="brand-panel">

                <!-- Logo -->
                <div class="flex items-center gap-3" data-aos="fade-up" data-aos-delay="150">
                    <div class="w-12 h-12 bg-white/70 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-soft relative pulse-dot">
                        <i class="fas fa-heartbeat text-2xl text-primary"></i>
                    </div>
                    <span class="font-display font-bold text-primary text-2xl tracking-tight">Synergy<span class="text-accent">AI</span></span>
                </div>

                <!-- Message d'accueil -->
                <div class="mt-6" data-aos="fade-up" data-aos-delay="200">
                    <h1 class="text-3xl md:text-4xl font-display font-bold text-primary leading-tight tracking-tight">
                        Bienvenue
                    </h1>
                    <p class="text-warm-gray/70 text-base mt-2 max-w-xs leading-relaxed" data-i18n="brand.subtitle">
                        Connectez-vous pour accéder à votre espace de santé augmenté.
                    </p>
                </div>

                <!-- Badges fonctionnalités -->
                <div class="flex flex-wrap gap-2 mt-6" data-aos="fade-up" data-aos-delay="250">
                    <span class="bg-white/40 backdrop-blur-sm border border-white/50 rounded-full px-3 py-1.5 text-xs font-medium text-primary flex items-center gap-1.5">
                        <i class="fas fa-microphone-lines text-accent"></i> <span data-i18n="badge.voice">Reconnaissance vocale</span>
                    </span>
                    <span class="bg-white/40 backdrop-blur-sm border border-white/50 rounded-full px-3 py-1.5 text-xs font-medium text-primary flex items-center gap-1.5">
                        <i class="fas fa-shield-haltered text-slate"></i> <span data-i18n="badge.security">Sécurité HDS</span>
                    </span>
                    <span class="bg-white/40 backdrop-blur-sm border border-white/50 rounded-full px-3 py-1.5 text-xs font-medium text-primary flex items-center gap-1.5">
                        <i class="fas fa-capsules text-gold"></i> <span data-i18n="badge.iot">Distributeurs IoT</span>
                    </span>
                </div>

                <!-- Petite phrase de confiance -->
                <p class="text-xs text-warm-gray/50 mt-6" data-i18n="brand.trust">
                    <i class="fas fa-check-circle text-accent mr-1"></i> Certifié HDS · Données chiffrées
                </p>
            </div>

            <!-- ========== PANEL DROIT : FORMULAIRE (espacement réduit) ========== -->
            <div class="form-panel">
                <div class="form-card" data-aos="fade-up" data-aos-delay="300">

                    <!-- Avatar - correction margin-top pour qu'il soit visible -->
                    <div class="flex justify-center avatar-wrapper">
                        <div class="w-14 h-14 bg-gradient-to-br from-primary to-primary-light rounded-2xl flex items-center justify-center shadow-glow-accent relative">
                            <i class="fas fa-user-md text-white text-xl"></i>
                            <span class="absolute inset-0 rounded-2xl border-2 border-accent/30 animate-pulse-ring"></span>
                        </div>
                    </div>

                    <!-- Titres avec moins de marge -->
                    <div class="text-center mt-1">
                        <h2 class="text-xl font-display font-bold text-primary" data-i18n="login.title">Connexion</h2>
                        <p class="text-warm-gray/60 text-xs mt-0.5" data-i18n="login.subtitle">Accédez à votre espace sécurisé</p>
                    </div>

                    @if(session('success'))
                    <div class="toast-success mt-3 bg-green-50/80 backdrop-blur-sm border border-green-300/50 text-green-700 px-3 py-1.5 rounded-2xl text-xs flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-500"></i>
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login.post') }}" class="mt-4 space-y-3">
                        @csrf

                        <!-- Identifiant -->
                        <div>
                            <label for="identifiant_unique" class="block text-xs font-medium text-warm-gray/70 mb-0.5">
                                <i class="fas fa-id-card text-accent/60 mr-1 text-[10px]"></i><span data-i18n="label.identifiant">Identifiant unique</span>
                            </label>
                            <div class="input-group">
                                <input type="text" name="identifiant_unique" id="identifiant_unique"
                                value="{{ old('identifiant_unique') }}" required
                                class="input-field"
                                placeholder="Votre identifiant" data-i18n-placeholder="placeholder.identifiant" />
                                <i class="fas fa-user input-icon"></i>
                            </div>
                            @error('identifiant_unique')
                            <span class="text-red-500 text-[10px] block mt-0.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-[9px]"></i>{{ $message }}
                            </span>
                            @enderror
                        </div>

                        <!-- Mot de passe -->
                        <div>
                            <label for="password" class="block text-xs font-medium text-warm-gray/70 mb-0.5">
                                <i class="fas fa-lock text-accent/60 mr-1 text-[10px]"></i><span data-i18n="label.password">Mot de passe</span>
                            </label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" required
                                class="input-field pr-10"
                                placeholder="••••••••" data-i18n-placeholder="placeholder.password" />
                                <i class="fas fa-key input-icon"></i>
                                <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-warm-gray/30 hover:text-primary transition-colors text-sm"
                                tabindex="-1" aria-label="Afficher le mot de passe">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                        <span class="text-red-500 text-[10px] block mt-0.5 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-[9px]"></i>{{ $message }}
                        </span>
                        @enderror
                    </div>

                    <!-- Bouton -->
                    <button type="submit" class="btn-login mt-1 text-sm" data-i18n="btn.login">
                        <i class="fas fa-arrow-right-to-bracket text-xs"></i>
                        Se connecter
                    </button>
                </form>

                <!-- Séparateur -->
                <div class="flex items-center gap-3 my-3">
                    <span class="flex-1 h-px bg-gradient-to-r from-transparent via-warm-gray/15 to-transparent"></span>
                    <span class="text-[10px] text-warm-gray/40 font-medium tracking-wider" data-i18n="or">OU</span>
                    <span class="flex-1 h-px bg-gradient-to-r from-transparent via-warm-gray/15 to-transparent"></span>
                </div>

                <!-- Lien inscription -->
                <p class="text-center text-xs text-warm-gray/70">
                    <span data-i18n="register.text">Pas encore de compte ?</span>
                    <a href="{{ route('register.step1') }}" class="register-link text-xs" data-i18n="register.link">Inscrivez-vous</a>
                </p>

                <!-- Badge sécurité -->
                <div class="security-badge mt-3 mx-auto w-fit">
                    <i class="fas fa-shield-check text-primary text-[10px]"></i>
                    <span data-i18n="badge.secure">Connexion chiffrée · HDS certifié</span>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ========== SCRIPTS ========== -->
<script>
    // --- AOS ---
    AOS.init({
        duration: 700,
        easing: 'ease-out-cubic',
        once: true,
        offset: 30,
    });

    // --- Toggle password ---
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // --- Language switcher ---
    const languages = [
        { code: 'fr', name: 'Français', flag: '🇫🇷' },
        { code: 'en', name: 'English', flag: '🇬🇧' },
        { code: 'pt', name: 'Português', flag: '🇵🇹' },
        { code: 'sw', name: 'Kiswahili', flag: '🇹🇿' },
        { code: 'ha', name: 'Hausa', flag: '🇳🇬' },
        { code: 'yo', name: 'Yorùbá', flag: '🇳🇬' },
        { code: 'ig', name: 'Igbo', flag: '🇳🇬' },
        { code: 'am', name: 'አማርኛ', flag: '🇪🇹' },
        { code: 'om', name: 'Oromoo', flag: '🇪🇹' },
        { code: 'ff', name: 'Fulfulde', flag: '🇸🇳' },
        { code: 'zu', name: 'isiZulu', flag: '🇿🇦' },
        { code: 'sn', name: 'chiShona', flag: '🇿🇼' },
        { code: 'ar', name: 'العربية', flag: '🇲🇦' }
    ];

    const translations = {
        fr: {
            "brand.subtitle": "Connectez-vous pour accéder à votre espace de santé augmenté.",
            "badge.voice": "Reconnaissance vocale",
            "badge.security": "Sécurité HDS",
            "badge.iot": "Distributeurs IoT",
            "brand.trust": "Certifié HDS · Données chiffrées",
            "login.title": "Connexion",
            "login.subtitle": "Accédez à votre espace sécurisé",
            "label.identifiant": "Identifiant unique",
            "placeholder.identifiant": "Votre identifiant",
            "label.password": "Mot de passe",
            "placeholder.password": "••••••••",
            "btn.login": "Se connecter",
            "or": "OU",
            "register.text": "Pas encore de compte ?",
            "register.link": "Inscrivez-vous",
            "badge.secure": "Connexion chiffrée · HDS certifié"
        },
        en: {
            "brand.subtitle": "Log in to access your augmented health space.",
            "badge.voice": "Voice recognition",
            "badge.security": "HDS Security",
            "badge.iot": "IoT Dispensers",
            "brand.trust": "HDS certified · Encrypted data",
            "login.title": "Login",
            "login.subtitle": "Access your secure area",
            "label.identifiant": "Unique ID",
            "placeholder.identifiant": "Your unique ID",
            "label.password": "Password",
            "placeholder.password": "••••••••",
            "btn.login": "Sign in",
            "or": "OR",
            "register.text": "Don't have an account?",
            "register.link": "Sign up",
            "badge.secure": "Encrypted connection · HDS certified"
        },
        pt: {
            "brand.subtitle": "Faça login para acessar seu espaço de saúde aumentado.",
            "badge.voice": "Reconhecimento de voz",
            "badge.security": "Segurança HDS",
            "badge.iot": "Distribuidores IoT",
            "brand.trust": "Certificado HDS · Dados criptografados",
            "login.title": "Entrar",
            "login.subtitle": "Acesse sua área segura",
            "label.identifiant": "ID único",
            "placeholder.identifiant": "Seu ID único",
            "label.password": "Senha",
            "placeholder.password": "••••••••",
            "btn.login": "Entrar",
            "or": "OU",
            "register.text": "Ainda não tem conta?",
            "register.link": "Cadastre-se",
            "badge.secure": "Conexão criptografada · Certificado HDS"
        },
        sw: {
            "brand.subtitle": "Ingia ili kufikia nafasi yako ya afya iliyoimarishwa.",
            "badge.voice": "Utambuzi wa sauti",
            "badge.security": "Usalama wa HDS",
            "badge.iot": "Vigawanya vya IoT",
            "brand.trust": "Imethibitishwa HDS · Data iliyosimbwa",
            "login.title": "Ingia",
            "login.subtitle": "Fikia eneo lako salama",
            "label.identifiant": "Kitambulisho cha kipekee",
            "placeholder.identifiant": "Kitambulisho chako",
            "label.password": "Nenosiri",
            "placeholder.password": "••••••••",
            "btn.login": "Ingia",
            "or": "AU",
            "register.text": "Huna akaunti bado?",
            "register.link": "Jisajili",
            "badge.secure": "Muunganisho uliosimbwa · Imethibitishwa HDS"
        },
        ha: {
            "brand.subtitle": "Shiga don samun damar sararin lafiyar ku.",
            "badge.voice": "Tantance murya",
            "badge.security": "Tsaro HDS",
            "badge.iot": "Masu Rarrabawa IoT",
            "brand.trust": "An tabbatar da HDS · Bayanan sirri",
            "login.title": "Shiga",
            "login.subtitle": "Shiga wurin ku mai aminci",
            "label.identifiant": "ID na musamman",
            "placeholder.identifiant": "ID ɗin ku",
            "label.password": "Kalmar sirri",
            "placeholder.password": "••••••••",
            "btn.login": "Shiga",
            "or": "KO",
            "register.text": "Ba ku da asusu tukuna?",
            "register.link": "Yi rijista",
            "badge.secure": "Haɗin da aka rufaffen · An tabbatar da HDS"
        },
        yo: {
            "brand.subtitle": "Wọle lati wọ aaye ilera rẹ ti o ni ilọsiwaju.",
            "badge.voice": "Ìdámọ̀ ohùn",
            "badge.security": "Ààbò HDS",
            "badge.iot": "Àwọn Olùpín IoT",
            "brand.trust": "Ifọwọsi HDS · Dátà tí a fi koodu pamọ́",
            "login.title": "Wọlé",
            "login.subtitle": "Wọ ààyè rẹ tí ó ni ààbò",
            "label.identifiant": "ID alákàn",
            "placeholder.identifiant": "ID rẹ",
            "label.password": "Ọ̀rọ̀ ìgbàwọlé",
            "placeholder.password": "••••••••",
            "btn.login": "Wọlé",
            "or": "TÀBÍ",
            "register.text": "Ṣé o kò ní àkàùn síbẹ̀?",
            "register.link": "Forúkọ sílẹ̀",
            "badge.secure": "Ìsopọ̀ tí a fi koodu pamọ́ · Ifọwọsi HDS"
        },
        ig: {
            "brand.subtitle": "Banye iji nweta oghere ahụike gị emelitere.",
            "badge.voice": "Nghọta olu",
            "badge.security": "Nchekwa HDS",
            "badge.iot": "Ndị Nkesa IoT",
            "brand.trust": "Akara HDS · Data ezoro ezo",
            "login.title": "Banye",
            "login.subtitle": "Nweta mpaghara gị nchekwara",
            "label.identifiant": "ID pụrụ iche",
            "placeholder.identifiant": "ID gị",
            "label.password": "Okwuntughe",
            "placeholder.password": "••••••••",
            "btn.login": "Banye",
            "or": "MAỌBỤ",
            "register.text": "Ị nweghị akaụntụ?",
            "register.link": "Debanye aha",
            "badge.secure": "Njikọ ezoro ezo · Akara HDS"
        },
        am: {
            "brand.subtitle": "ወደ የተሻሻለው የጤና ቦታዎ ለመግባት ይግቡ።",
            "badge.voice": "የድምጽ ለይቶ ማወቅ",
            "badge.security": "HDS ደህንነት",
            "badge.iot": "IoT አከፋፋዮች",
            "brand.trust": "HDS የተረጋገጠ · የተመሰጠረ መረጃ",
            "login.title": "ግባ",
            "login.subtitle": "ወደ አስተማማኝ ቦታዎ ይግቡ",
            "label.identifiant": "ልዩ መታወቂያ",
            "placeholder.identifiant": "መታወቂያዎ",
            "label.password": "የይለፍ ቃል",
            "placeholder.password": "••••••••",
            "btn.login": "ግባ",
            "or": "ወይም",
            "register.text": "መለያ የሎትም?",
            "register.link": "ይመዝገቡ",
            "badge.secure": "የተመሰጠረ ግንኙነት · HDS የተረጋገጠ"
        },
        om: {
            "brand.subtitle": "Idkii kana fayyadamnee bakka fayyaa keessan ga'aa.",
            "badge.voice": "Sagalee addaan baafachuu",
            "badge.security": "Nageenya HDS",
            "badge.iot": "Raabsitoota IoT",
            "brand.trust": "HDS mirkanaa'e · Deetaa iccitii",
            "login.title": "Seenuu",
            "login.subtitle": "Bakka nageenya qabu ga'aa",
            "label.identifiant": "ID addaa",
            "placeholder.identifiant": "ID keessan",
            "label.password": "Jecha iccitii",
            "placeholder.password": "••••••••",
            "btn.login": "Seenuu",
            "or": "YKN",
            "register.text": "Akaawuntii hin qabdan?",
            "register.link": "Galmaa'aa",
            "badge.secure": "Walqabsiisni iccitii · HDS mirkanaa'e"
        },
        ff: {
            "brand.subtitle": "Naat tawtoree ngam heɓde nokku cellal maa ɓeydaaɗo.",
            "badge.voice": "Anndinde daande",
            "badge.security": "Kisal HDS",
            "badge.iot": "Senndotooɗe IoT",
            "brand.trust": "HDS seedtaaɗo · Keɓe suturo",
            "login.title": "Naatde",
            "login.subtitle": "Heɓde nokku maa kisnaa",
            "label.identifiant": "ID keeriiɗo",
            "placeholder.identifiant": "ID maa",
            "label.password": "Finnde",
            "placeholder.password": "••••••••",
            "btn.login": "Naatde",
            "or": "WALLAA",
            "register.text": "A alaa akkaawuntii?",
            "register.link": "Winnditoo",
            "badge.secure": "Jokkondiral suturo · HDS seedtaaɗo"
        },
        zu: {
            "brand.subtitle": "Ngena ukuze ufinyelele isikhala sakho sezempilo esithuthukisiwe.",
            "badge.voice": "Ukuqashelwa kwezwi",
            "badge.security": "Ukuphepha kwe-HDS",
            "badge.iot": "Abasabalalisi be-IoT",
            "brand.trust": "Iqinisekisiwe i-HDS · Idatha efihliwe",
            "login.title": "Ngena",
            "login.subtitle": "Finyelela indawo yakho ephephile",
            "label.identifiant": "ID eyingqayizivele",
            "placeholder.identifiant": "ID yakho",
            "label.password": "Iphasiwedi",
            "placeholder.password": "••••••••",
            "btn.login": "Ngena",
            "or": "NOMA",
            "register.text": "Awunawo i-akhawunti?",
            "register.link": "Bhalisa",
            "badge.secure": "Ukuxhumana okufihliwe · Kuqinisekiswe i-HDS"
        },
        sn: {
            "brand.subtitle": "Pinda kuti uwane nzvimbo yako yehutano yakavandudzwa.",
            "badge.voice": "Kuzivikanwa kwezwi",
            "badge.security": "Kuchengetedzwa kweHDS",
            "badge.iot": "Vagoveri veIoT",
            "brand.trust": "HDS yakasimbiswa · Data yakachengetedzwa",
            "login.title": "Pinda",
            "login.subtitle": "Wana nzvimbo yako yakachengeteka",
            "label.identifiant": "ID yakasiyana",
            "placeholder.identifiant": "ID yako",
            "label.password": "Password",
            "placeholder.password": "••••••••",
            "btn.login": "Pinda",
            "or": "KANA",
            "register.text": "Hauna akaunti?",
            "register.link": "Nyorera",
            "badge.secure": "Kubatana kwakachengetedzwa · HDS yakasimbiswa"
        },
        ar: {
            "brand.subtitle": "سجل الدخول للوصول إلى مساحتك الصحية المعززة.",
            "badge.voice": "التعرف على الصوت",
            "badge.security": "أمان HDS",
            "badge.iot": "موزعو إنترنت الأشياء",
            "brand.trust": "معتمد HDS · بيانات مشفرة",
            "login.title": "تسجيل الدخول",
            "login.subtitle": "الوصول إلى مساحتك الآمنة",
            "label.identifiant": "معرف فريد",
            "placeholder.identifiant": "معرفك",
            "label.password": "كلمة المرور",
            "placeholder.password": "••••••••",
            "btn.login": "تسجيل الدخول",
            "or": "أو",
            "register.text": "ليس لديك حساب؟",
            "register.link": "سجل الآن",
            "badge.secure": "اتصال مشفر · معتمد HDS"
        }
    };

    function getCurrentLang() {
        return localStorage.getItem('synergyLangLogin') || 'fr';
    }

    function setCurrentLang(lang) {
        localStorage.setItem('synergyLangLogin', lang);
        applyTranslations(lang);
        updateLangUI(lang);
        document.documentElement.lang = lang;
    }

    function applyTranslations(lang) {
        const dict = translations[lang] || translations['fr'] || {};
        document.querySelectorAll('[data-i18n]').forEach(el => {
            const key = el.getAttribute('data-i18n');
            if (dict[key] !== undefined) {
                el.textContent = dict[key];
            }
        });
        document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
            const key = el.getAttribute('data-i18n-placeholder');
            if (dict[key] !== undefined) {
                el.placeholder = dict[key];
            }
        });
        document.getElementById('currentLang').textContent = lang.toUpperCase();
    }

    function updateLangUI(lang) {
        document.querySelectorAll('.lang-option').forEach(opt => {
            opt.classList.toggle('active', opt.getAttribute('data-lang') === lang);
        });
    }

    // Construire le dropdown
    const langDropdown = document.getElementById('langDropdown');
    languages.forEach(l => {
        const option = document.createElement('div');
        option.className = 'lang-option';
        option.setAttribute('data-lang', l.code);
        option.innerHTML = `${l.flag} ${l.name}`;
        option.addEventListener('click', () => {
            setCurrentLang(l.code);
            langDropdown.classList.remove('show');
        });
        langDropdown.appendChild(option);
    });

    document.getElementById('langButton').addEventListener('click', (e) => {
        e.stopPropagation();
        langDropdown.classList.toggle('show');
    });
    window.addEventListener('click', () => langDropdown.classList.remove('show'));

    // Initialiser la langue
    const savedLang = getCurrentLang();
    setCurrentLang(savedLang);

    // --- Animations sur les champs ---
    document.querySelectorAll('.input-field').forEach(inp => {
        inp.addEventListener('focus', () => {
            inp.parentElement.querySelector('.input-icon')?.classList.add('text-primary');
        });
        inp.addEventListener('blur', () => {
            inp.parentElement.querySelector('.input-icon')?.classList.remove('text-primary');
        });
    });

    // Rafraîchir AOS
    document.addEventListener('DOMContentLoaded', () => AOS.refresh());
</script>

</body>
</html>