<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SynergyAI · Soins augmentés pour l'Afrique</title>

    <!-- Tailwind CSS -->
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
                        '2xl': '1.25rem',
                        '3xl': '1.75rem',
                        '4xl': '2.25rem',
                    },
                    boxShadow: {
                        'soft': '0 20px 40px -15px rgba(10, 74, 59, 0.12)',
                        'soft-lg': '0 30px 55px -20px rgba(10, 74, 59, 0.18)',
                        'inner-soft': 'inset 0 2px 8px rgba(10, 74, 59, 0.06)',
                        'glow': '0 0 25px rgba(210, 168, 67, 0.25)',
                    },
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js">
    </script>

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Leaflet CSS + JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
    </script>

    <!-- Canvas Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js">
    </script>

    <style>
        :root {
            --primary: #0A4A3B;
            --primary-light: #117A5D;
            --accent: #E27B46;
            --accent-light: #F3B391;
            --gold: #D4A843;
            --gold-light: #F2D78D;
            --slate: #1B4F6E;
            --slate-light: #347B98;
            --cream: #FCF9F2;
            --sand: #F4EDE0;
            --warm-gray: #5C5346;
        }

        * {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--cream);
            color: #3A3A3A;
            overflow-x: hidden;
        }
        h1,
        h2,
        h3,
        h4,
        .font-display {
            font-family: 'Outfit', sans-serif;
            letter-spacing: -0.02em;
        }

        /* Glass morphism */
        .glass-panel {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 1.75rem;
            box-shadow: 0 25px 50px -18px rgba(10, 74, 59, 0.1);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .glass-panel:hover {
            box-shadow: 0 30px 60px -20px rgba(10, 74, 59, 0.2);
            border-color: rgba(255, 255, 255, 0.9);
            transform: translateY(-6px);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 1.5rem;
            transition: all 0.4s ease;
        }
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.75);
            box-shadow: 0 20px 40px -15px rgba(10, 74, 59, 0.15);
        }

        /* Boutons */
        .btn-primary {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 3rem;
            padding: 0.85rem 2.2rem;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            letter-spacing: 0.01em;
            box-shadow: 0 10px 22px -8px rgba(10, 74, 59, 0.35);
            transition: all 0.35s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-primary:hover {
            background: #083D30;
            transform: translateY(-3px);
            box-shadow: 0 18px 30px -10px rgba(10, 74, 59, 0.45);
        }
        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            border-radius: 3rem;
            padding: 0.8rem 2rem;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            transition: all 0.35s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-outline:hover {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 12px 24px -8px rgba(10, 74, 59, 0.3);
        }

        /* Header */
        .header-scrolled {
            background: rgba(252, 249, 242, 0.8);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(10, 74, 59, 0.08);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }
        .header-top {
            background: rgba(252, 249, 242, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Ligne temporelle étapes */
        .step-number {
            width: 3.2rem;
            height: 3.2rem;
            border-radius: 50%;
            background: var(--primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.25rem;
            font-family: 'Outfit', sans-serif;
            flex-shrink: 0;
            z-index: 1;
            box-shadow: 0 8px 18px rgba(10, 74, 59, 0.25);
        }

        /* Carte Leaflet */
        .map-container {
            border-radius: 1.75rem;
            overflow: hidden;
            box-shadow: 0 20px 45px -15px rgba(10, 74, 59, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.6);
            height: 420px;
            width: 100%;
            z-index: 1;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #F4EDE0;
        }
        ::-webkit-scrollbar-thumb {
            background: #E27B46;
            border-radius: 10px;
        }

        /* Animation fondu */
        .fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
            opacity: 0;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Indicateur de chargement de langue */
        .language-switcher {
            position: relative;
        }
        .lang-dropdown {
            position: absolute;
            top: 3rem;
            right: 0;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 100;
            min-width: 160px;
            padding: 0.5rem 0;
            max-height: 300px;
            overflow-y: auto;
        }
        .lang-dropdown.show {
            display: block;
        }
        .lang-option {
            padding: 0.6rem 1.2rem;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .lang-option:hover {
            background: #f5f5f5;
        }
        .lang-option.active {
            font-weight: 600;
            color: var(--primary);
            background: #eef7f4;
        }

        /* Parallax simple */
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body class="antialiased">

    <!-- ========== HEADER ========== -->
    <header class="fixed top-0 left-0 w-full z-50 header-top" id="mainHeader">
        <div class="max-w-7xl mx-auto px-5 py-3 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white/80 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-sm border border-white/60">
                    <i class="fas fa-heartbeat text-2xl text-primary"></i>
                </div>
                <div class="leading-tight">
                    <span class="text-xl font-display font-semibold text-primary">SynergyAI</span>
                    <span class="block text-[10px] text-warm-gray tracking-wide uppercase" data-i18n="header.subtitle">Intelligence médicale</span>
                </div>
            </div>

            <!-- Navigation desktop -->
            <nav class="hidden lg:flex items-center gap-8 text-[15px] font-medium">
                <a href="#parcours" data-i18n="nav.parcours" class="text-warm-gray hover:text-primary transition-colors">Parcours</a>
                <a href="#carte" data-i18n="nav.carte" class="text-warm-gray hover:text-primary transition-colors">Carte</a>
                <a href="#distributeurs" data-i18n="nav.distributeurs" class="text-warm-gray hover:text-primary transition-colors">Distributeurs</a>
                <a href="#temoignages" data-i18n="nav.temoignages" class="text-warm-gray hover:text-primary transition-colors">Témoignages</a>
                <a href="#faq" data-i18n="nav.faq" class="text-warm-gray hover:text-primary transition-colors">FAQ</a>
                <div class="language-switcher relative">
                    <button id="langButton" class="btn-outline !py-2 !px-4 text-sm flex items-center gap-2">
                        🌐 <span id="currentLang">FR</span> <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div id="langDropdown" class="lang-dropdown"></div>
                </div>
                <a href="{{'login'}}" class="btn-primary text-sm !py-2.5 !px-5" data-i18n="btn.espace_pro">
                    <i class="fas fa-user-md"></i> Espace pro
                </a>
            </nav>

            <!-- Burger mobile -->
            <button class="lg:hidden text-2xl text-primary" id="menuToggle" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Menu mobile overlay -->
    <div class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40 hidden" id="mobileOverlay"></div>
    <div class="fixed top-0 right-0 w-80 h-full bg-cream/90 backdrop-blur-xl z-50 shadow-2xl transform translate-x-full transition-transform duration-400 rounded-l-3xl" id="mobileMenu">
        <div class="p-6 flex flex-col gap-6 pt-20">
            <button id="closeMenu" class="absolute top-5 right-5 text-2xl text-primary"><i class="fas fa-times"></i></button>
            <a href="#parcours" data-i18n="nav.parcours" class="text-lg font-medium text-warm-gray">📋 Parcours patient</a>
            <a href="#carte" data-i18n="nav.carte" class="text-lg font-medium text-warm-gray">🗺️ Carte géolocalisation</a>
            <a href="#distributeurs" data-i18n="nav.distributeurs" class="text-lg font-medium text-warm-gray">💊 Distributeurs</a>
            <a href="#temoignages" data-i18n="nav.temoignages" class="text-lg font-medium text-warm-gray">💬 Témoignages</a>
            <a href="#faq" data-i18n="nav.faq" class="text-lg font-medium text-warm-gray">❓ FAQ</a>
            <div class="mt-4 language-switcher-mobile">
                <select id="mobileLangSelect" class="w-full p-2 rounded-xl border border-gray-300"></select>
            </div>
        </div>
    </div>

    <!-- ========== HERO SECTION ========== -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20" style="background: linear-gradient(160deg, #F4EDE0 0%, #E5D9C5 40%, #D4C4B0 100%);">
        <div class="absolute inset-0 z-0 opacity-25 parallax-bg" style="background-image: url('https://images.unsplash.com/photo-1581079289196-67865ea83118?q=80&w=2069&auto=format&fit=crop'); mix-blend-mode: multiply;">
        </div>
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-accent/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4 z-0"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-primary/8 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 z-0"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-5 py-16 md:py-28 grid lg:grid-cols-2 gap-14 items-center">
            <div class="text-center lg:text-left" data-aos="fade-up" data-aos-duration="900">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/60 backdrop-blur-sm rounded-full text-sm font-semibold text-primary mb-6 border border-white/50">
                    <i class="fas fa-map-marker-alt text-accent"></i> <span data-i18n="hero.tag">Par l'Afrique, pour l'Afrique</span>
                </span>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-display font-bold leading-tight text-primary">
                    <span data-i18n="hero.title_part1">Des soins</span> <span class="text-accent relative"><span data-i18n="hero.title_part2">augmentés</span><span class="absolute -bottom-1 left-0 w-full h-1.5 bg-accent-light/60 rounded-full"></span></span>,<br><span data-i18n="hero.title_part3">une santé</span> <span class="text-slate"><span data-i18n="hero.title_part4">accessible</span></span>
                </h1>
                <p class="text-lg md:text-xl text-warm-gray mt-7 mb-9 max-w-xl mx-auto lg:mx-0 leading-relaxed" data-i18n="hero.subtitle">
                    SynergyAI combine l'intelligence artificielle, la voix et des distributeurs connectés pour offrir des soins de qualité, même dans les zones reculées.
                </p>
                <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                    <a href="#parcours" class="btn-primary text-lg" data-i18n="btn.decouvrir">
                        <i class="fas fa-play-circle"></i> Découvrir le parcours
                    </a>
                    <a href="#carte" class="btn-outline text-lg bg-white/40" data-i18n="btn.voir_carte">
                        <i class="fas fa-map-marked-alt"></i> Voir la carte
                    </a>
                </div>
                <div class="flex flex-wrap gap-5 mt-10 justify-center lg:justify-start text-sm text-primary/80">
                    <span class="flex items-center gap-2"><i class="fas fa-microphone-lines text-accent"></i> <span data-i18n="hero.vocal">Reconnaissance vocale</span></span>
                    <span class="flex items-center gap-2"><i class="fas fa-shield-haltered text-slate"></i> <span data-i18n="hero.securite">Sécurité HDS</span></span>
                    <span class="flex items-center gap-2"><i class="fas fa-capsules text-gold"></i> <span data-i18n="hero.iot">Distributeurs IoT</span></span>
                </div>
            </div>

            <div class="relative" data-aos="fade-up" data-aos-duration="900" data-aos-delay="200">
                <div class="glass-panel p-6 md:p-8 relative z-10">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="w-3 h-3 rounded-full bg-accent"></div>
                        <div class="w-3 h-3 rounded-full bg-gold"></div>
                        <div class="w-3 h-3 rounded-full bg-primary"></div>
                        <span class="ml-2 text-xs text-warm-gray font-medium" data-i18n="dashboard.title">SynergyAI · Tableau de bord</span>
                    </div>
                    <div class="bg-white/40 backdrop-blur-sm rounded-2xl p-5 mb-5 border border-white/50">
                        <p class="text-xs text-warm-gray uppercase tracking-wide mb-1" data-i18n="dashboard.roles">Patients-Médecins-Administrateurs</p>
                        <p class="text-2xl font-display font-semibold text-primary" data-i18n="dashboard.slogan">Trouvez votre rôle en toute sérénité</p>
                        <p class="text-sm text-warm-gray"><span data-i18n="dashboard.symptoms">Symptômes courants :</span> <span class="font-medium">fièvre, céphalées</span></p>
                        <div class="mt-3 flex gap-3">
                            <span class="bg-accent-light/30 text-accent text-xs px-3 py-1 rounded-full font-medium" data-i18n="dashboard.level">Niveau actualisé · Surveillance</span>
                            <span class="bg-slate-light/20 text-slate text-xs px-3 py-1 rounded-full font-medium" data-i18n="dashboard.tele">Télémédecine proposée</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-white/30 rounded-xl p-4 text-center border border-white/40">
                            <i class="fas fa-location-dot text-2xl text-gold mb-1"></i>
                            <p class="text-xl font-display font-bold text-primary" data-i18n="dashboard.partners">1000+</p>
                            <p class="text-xs text-warm-gray" data-i18n="dashboard.partners_desc">Partenaires à proximité</p>
                        </div>
                        <div class="bg-white/30 rounded-xl p-4 text-center border border-white/40">
                            <i class="fas fa-clock text-2xl text-slate mb-1"></i>
                            <p class="text-xl font-display font-bold text-primary" data-i18n="dashboard.nearest">Trouver</p>
                            <p class="text-xs text-warm-gray" data-i18n="dashboard.nearest_desc">Centre de santé le plus proche</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 w-full h-full bg-accent/10 rounded-3xl -z-0 blur-xl"></div>
            </div>
        </div>
    </section>

    <!-- ========== PARCOURS UTILISATEUR ========== -->
    <section id="parcours" class="py-24 md:py-32 bg-cream relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.04] z-0" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMwQTBBMEEiIGZpbGwtb3BhY2l0eT0iMC4yIj48Y2lyY2xlIGN4PSIxLjUiIGN5PSIxLjUiIHI9IjEuNSIvPjwvZz48L2c+PC9zdmc+');"></div>
        <div class="relative z-10 max-w-5xl mx-auto px-5">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-sm font-semibold text-accent uppercase tracking-widest" data-i18n="parcours.surtitre">Fonctionnement global</span>
                <h2 class="text-4xl md:text-5xl font-display font-bold text-primary mt-3" data-i18n="parcours.titre">Votre parcours de soin,<br>étape par étape</h2>
                <p class="text-lg text-warm-gray mt-4 max-w-2xl mx-auto" data-i18n="parcours.sous_titre">Une prise en main simple, guidée par la voix et sécurisée par l'IA.</p>
            </div>
            <div class="grid md:grid-cols-2 gap-6 lg:gap-8 relative">
                <div class="hidden md:block absolute top-0 left-1/2 w-0.5 h-full bg-gradient-to-b from-primary via-accent to-gold opacity-25 -translate-x-1/2 z-0"></div>

                <div class="glass-card p-6 md:p-7 relative z-10 flex gap-5 items-start" data-aos="fade-right">
                    <div class="step-number">1</div>
                    <div>
                        <h3 class="text-xl font-display font-semibold text-primary" data-i18n="etape1.titre">Accueil & choix de langue</h3>
                        <p class="text-warm-gray mt-2 text-sm leading-relaxed" data-i18n="etape1.texte">Interface simple avec pictogrammes universels. Choix entre <strong>français, anglais, swahili, wolof, darija</strong> et plus. Adaptation immédiate.</p>
                    </div>
                </div>
                <div class="glass-card p-6 md:p-7 relative z-10 flex gap-5 items-start md:mt-12" data-aos="fade-left">
                    <div class="step-number">2</div>
                    <div>
                        <h3 class="text-xl font-display font-semibold text-primary" data-i18n="etape2.titre">Collecte des symptômes</h3>
                        <p class="text-warm-gray mt-2 text-sm leading-relaxed" data-i18n="etape2.texte">Formulaire intuitif <strong>+ option vocale</strong>. Le patient peut décrire ses symptômes oralement. L'IA transcrit et structure les données.</p>
                        <span class="inline-flex items-center gap-1.5 text-xs font-medium text-accent mt-2 bg-accent-light/20 px-3 py-1 rounded-full">
                            <i class="fas fa-microphone"></i> <span data-i18n="etape2.badge">Reconnaissance vocale</span>
                        </span>
                    </div>
                </div>
                <div class="glass-card p-6 md:p-7 relative z-10 flex gap-5 items-start" data-aos="fade-right">
                    <div class="step-number">3</div>
                    <div>
                        <h3 class="text-xl font-display font-semibold text-primary" data-i18n="etape3.titre">Analyse IA & sécurité</h3>
                        <p class="text-warm-gray mt-2 text-sm leading-relaxed" data-i18n="etape3.texte">Algorithme croisant les symptômes avec une base médicale, détection des drapeaux rouges et contre-indications.</p>
                        <span class="inline-flex items-center gap-1.5 text-xs font-medium text-slate mt-2 bg-slate-light/15 px-3 py-1 rounded-full">
                            <i class="fas fa-shield-haltered"></i> <span data-i18n="etape3.badge">Protocole HDS</span>
                        </span>
                    </div>
                </div>
                <div class="glass-card p-6 md:p-7 relative z-10 flex gap-5 items-start md:mt-12" data-aos="fade-left">
                    <div class="step-number">4</div>
                    <div>
                        <h3 class="text-xl font-display font-semibold text-primary" data-i18n="etape4.titre">Décision : conseil ou alerte</h3>
                        <p class="text-warm-gray mt-2 text-sm leading-relaxed" data-i18n="etape4.texte"><strong>Cas simple :</strong> conseils + dispensation. <strong>Cas à risque :</strong> alerte immédiate + orientation.</p>
                        <div class="flex gap-2 mt-3">
                            <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-medium">✅ <span data-i18n="etape4.simple">Cas simple</span></span>
                            <span class="bg-red-100 text-red-600 text-xs px-3 py-1 rounded-full font-medium">🚨 <span data-i18n="etape4.risque">Cas à risque</span></span>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-6 md:p-7 relative z-10 flex gap-5 items-start" data-aos="fade-right">
                    <div class="step-number">5</div>
                    <div>
                        <h3 class="text-xl font-display font-semibold text-primary" data-i18n="etape5.titre">Dispensation contrôlée</h3>
                        <p class="text-warm-gray mt-2 text-sm leading-relaxed" data-i18n="etape5.texte">Médicaments délivrés via des <strong>distributeurs connectés</strong>. Dose et quantité tracées en temps réel.</p>
                        <span class="inline-flex items-center gap-1.5 text-xs font-medium text-gold mt-2 bg-gold-light/20 px-3 py-1 rounded-full">
                            <i class="fas fa-capsules"></i> <span data-i18n="etape5.badge">Distributeur IoT</span>
                        </span>
                    </div>
                </div>
                <div class="glass-card p-6 md:p-7 relative z-10 flex gap-5 items-start md:mt-12" data-aos="fade-left">
                    <div class="step-number">6</div>
                    <div>
                        <h3 class="text-xl font-display font-semibold text-primary" data-i18n="etape6.titre">Suivi personnalisé</h3>
                        <p class="text-warm-gray mt-2 text-sm leading-relaxed" data-i18n="etape6.texte">Recommandations post-soin, <strong>rappels de prise</strong>, escalade automatique si absence d'amélioration.</p>
                        <span class="inline-flex items-center gap-1.5 text-xs font-medium text-primary mt-2 bg-primary-light/15 px-3 py-1 rounded-full">
                            <i class="fas fa-bell"></i> <span data-i18n="etape6.badge">Rappels & escalade</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== CARTE GÉOLOCALISATION ========== -->
    <section id="carte" class="py-24 md:py-32 bg-sand relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="text-sm font-semibold text-slate uppercase tracking-widest" data-i18n="carte.surtitre">Géolocalisation</span>
                <h2 class="text-4xl md:text-5xl font-display font-bold text-primary mt-3" data-i18n="carte.titre">Trouvez un centre de santé<br>ou un distributeur proche</h2>
                <p class="text-lg text-warm-gray mt-4 max-w-2xl mx-auto" data-i18n="carte.sous_titre">Notre carte interactive référence les établissements partenaires et les distributeurs connectés.</p>
            </div>
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 map-container" data-aos="fade-up" id="map"></div>
                <div class="space-y-4" data-aos="fade-up">
                    <div class="glass-card p-6">
                        <h3 class="font-display font-semibold text-primary text-lg mb-4" data-i18n="carte.legende">Légende</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center gap-3"><span class="w-4 h-4 rounded-full bg-primary inline-block"></span> <span data-i18n="carte.legende1">Centres de santé partenaires</span></div>
                            <div class="flex items-center gap-3"><span class="w-4 h-4 rounded-full bg-accent inline-block"></span> <span data-i18n="carte.legende2">Distributeurs de médicaments</span></div>
                            <div class="flex items-center gap-3"><span class="w-4 h-4 rounded-full bg-slate inline-block"></span> <span data-i18n="carte.legende3">Téléconsultations disponibles</span></div>
                        </div>
                    </div>
                    <div class="glass-card p-6">
                        <h3 class="font-display font-semibold text-primary text-lg mb-4" data-i18n="carte.stats">Statistiques</h3>
                        <div class="grid grid-cols-2 gap-3 text-center">
                            <div class="bg-white/40 rounded-xl p-3">
                                <p class="text-2xl font-display font-bold text-primary counter" data-target="147">0</p>
                                <p class="text-xs text-warm-gray" data-i18n="carte.stat1">Centres de santé</p>
                            </div>
                            <div class="bg-white/40 rounded-xl p-3">
                                <p class="text-2xl font-display font-bold text-accent counter" data-target="89">0</p>
                                <p class="text-xs text-warm-gray" data-i18n="carte.stat2">Distributeurs IoT</p>
                            </div>
                            <div class="bg-white/40 rounded-xl p-3 col-span-2">
                                <p class="text-sm font-medium text-slate">🌍 <span data-i18n="carte.stat3">Couverture : <strong>12 pays</strong> d'Afrique</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== DISTRIBUTEURS ========== -->
    <section id="distributeurs" class="py-24 md:py-32 bg-cream relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.04] z-0" style="background-image: url('https://images.unsplash.com/photo-1585435557343-3b092031a831?q=80&w=1740&auto=format&fit=crop'); background-size: cover; background-position: center;"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-5">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-sm font-semibold text-gold uppercase tracking-widest" data-i18n="distributeurs.surtitre">Distributeurs connectés</span>
                <h2 class="text-4xl md:text-5xl font-display font-bold text-primary mt-3" data-i18n="distributeurs.titre">Des médicaments accessibles,<br>même loin des pharmacies</h2>
                <p class="text-lg text-warm-gray mt-4 max-w-2xl mx-auto" data-i18n="distributeurs.sous_titre">Nos distributeurs IoT assurent une dispensation sécurisée, tracée et contrôlée à distance.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-panel p-7 text-center" data-aos="fade-up">
                    <div class="w-20 h-20 mx-auto mb-5 bg-gold-light/30 rounded-2xl flex items-center justify-center text-3xl text-gold"><i class="fas fa-fingerprint"></i></div>
                    <h3 class="text-xl font-display font-semibold text-primary" data-i18n="distrib1.titre">Authentification sécurisée</h3>
                    <p class="text-warm-gray mt-3 text-sm" data-i18n="distrib1.texte">Code unique, empreinte digitale ou carte santé pour déverrouiller le distributeur.</p>
                </div>
                <div class="glass-panel p-7 text-center" data-aos="fade-up" data-aos-delay="150">
                    <div class="w-20 h-20 mx-auto mb-5 bg-accent-light/30 rounded-2xl flex items-center justify-center text-3xl text-accent"><i class="fas fa-capsules"></i></div>
                    <h3 class="text-xl font-display font-semibold text-primary" data-i18n="distrib2.titre">Dose contrôlée</h3>
                    <p class="text-warm-gray mt-3 text-sm" data-i18n="distrib2.texte">Le distributeur délivre la quantité exacte prescrite. Traçabilité complète.</p>
                </div>
                <div class="glass-panel p-7 text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-20 h-20 mx-auto mb-5 bg-slate-light/20 rounded-2xl flex items-center justify-center text-3xl text-slate"><i class="fas fa-wifi"></i></div>
                    <h3 class="text-xl font-display font-semibold text-primary" data-i18n="distrib3.titre">Connecté en temps réel</h3>
                    <p class="text-warm-gray mt-3 text-sm" data-i18n="distrib3.texte">Inventaire, alertes de stock et rapports transmis automatiquement au centre de santé.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== TÉMOIGNAGES ========== -->
    <section id="temoignages" class="py-24 md:py-32 bg-sand relative">
        <div class="max-w-6xl mx-auto px-5">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="text-sm font-semibold text-accent uppercase tracking-widest" data-i18n="temoignages.surtitre">Témoignages</span>
                <h2 class="text-4xl md:text-5xl font-display font-bold text-primary mt-3" data-i18n="temoignages.titre">Ils nous font confiance</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-7">
                <div class="glass-card p-7" data-aos="fade-up">
                    <i class="fas fa-quote-left text-3xl text-accent-light mb-4 opacity-50"></i>
                    <p class="text-warm-gray italic text-sm leading-relaxed" data-i18n="temoignage1.texte">"SynergyAI nous a permis de réduire le temps d'attente de 40% dans notre dispensaire rural. La reconnaissance vocale est un atout formidable."</p>
                    <div class="flex items-center mt-5 gap-3">
                        <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?q=80&w=987&auto=format&fit=crop" class="w-11 h-11 rounded-full object-cover" alt="Dr. Amina" loading="lazy">
                        <div>
                            <p class="font-semibold text-primary text-sm">Dr. Amina Koné</p>
                            <p class="text-xs text-warm-gray">Centre de Santé · Bamako</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-7" data-aos="fade-up" data-aos-delay="150">
                    <i class="fas fa-quote-left text-3xl text-accent-light mb-4 opacity-50"></i>
                    <p class="text-warm-gray italic text-sm leading-relaxed" data-i18n="temoignage2.texte">"Le distributeur automatique a sauvé la mise pendant la saison des pluies. Les patients ont pu recevoir leurs médicaments sans parcourir 30 km."</p>
                    <div class="flex items-center mt-5 gap-3">
                        <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?q=80&w=1740&auto=format&fit=crop" class="w-11 h-11 rounded-full object-cover" alt="Infirmier" loading="lazy">
                        <div>
                            <p class="font-semibold text-primary text-sm">Jean-Paul Ekomié</p>
                            <p class="text-xs text-warm-gray">Infirmier · Libreville</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-7" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-quote-left text-3xl text-accent-light mb-4 opacity-50"></i>
                    <p class="text-warm-gray italic text-sm leading-relaxed" data-i18n="temoignage3.texte">"L'interface est si simple que même ma grand-mère l'utilise. Le choix du wolof a tout changé pour elle."</p>
                    <div class="flex items-center mt-5 gap-3">
                        <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?q=80&w=987&auto=format&fit=crop" class="w-11 h-11 rounded-full object-cover" alt="Patiente" loading="lazy">
                        <div>
                            <p class="font-semibold text-primary text-sm">Fatou Ndiaye</p>
                            <p class="text-xs text-warm-gray">Patiente · Dakar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== FAQ ========== -->
    <section id="faq" class="py-24 md:py-32 bg-cream relative">
        <div class="max-w-4xl mx-auto px-5">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="text-sm font-semibold text-slate uppercase tracking-widest" data-i18n="faq.surtitre">FAQ</span>
                <h2 class="text-4xl md:text-5xl font-display font-bold text-primary mt-3" data-i18n="faq.titre">Questions fréquentes</h2>
            </div>
            <div class="space-y-4">
                <details class="glass-card p-5 group" open data-aos="fade-up">
                    <summary class="font-display font-semibold text-primary cursor-pointer list-none flex justify-between items-center">
                        <span data-i18n="faq.q1">Comment fonctionne la reconnaissance vocale ?</span>
                        <i class="fas fa-chevron-down transition-transform group-open:rotate-180 text-accent"></i>
                    </summary>
                    <p class="text-warm-gray mt-3 text-sm leading-relaxed" data-i18n="faq.r1">Le patient parle dans le microphone de son téléphone. Notre IA transcrit et analyse les symptômes en temps réel, dans plusieurs langues africaines.</p>
                </details>
                <details class="glass-card p-5 group" data-aos="fade-up" data-aos-delay="80">
                    <summary class="font-display font-semibold text-primary cursor-pointer list-none flex justify-between items-center">
                        <span data-i18n="faq.q2">Les distributeurs sont-ils sécurisés ?</span>
                        <i class="fas fa-chevron-down transition-transform group-open:rotate-180 text-accent"></i>
                    </summary>
                    <p class="text-warm-gray mt-3 text-sm leading-relaxed" data-i18n="faq.r2">Oui, chaque distributeur est équipé d'un système d'authentification forte et d'un chiffrement AES-256. Les stocks sont surveillés à distance.</p>
                </details>
                <details class="glass-card p-5 group" data-aos="fade-up" data-aos-delay="160">
                    <summary class="font-display font-semibold text-primary cursor-pointer list-none flex justify-between items-center">
                        <span data-i18n="faq.q3">Que se passe-t-il si mon cas est jugé à risque ?</span>
                        <i class="fas fa-chevron-down transition-transform group-open:rotate-180 text-accent"></i>
                    </summary>
                    <p class="text-warm-gray mt-3 text-sm leading-relaxed" data-i18n="faq.r3">Une alerte est immédiatement envoyée au centre de santé le plus proche. Vous recevez également une proposition de téléconsultation avec un médecin disponible.</p>
                </details>
            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="bg-primary text-white/80 py-16">
        <div class="max-w-7xl mx-auto px-5 grid md:grid-cols-4 gap-10">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-heartbeat text-3xl text-accent-light"></i>
                    <span class="text-2xl font-display font-semibold text-white">SynergyAI</span>
                </div>
                <p class="text-sm text-white/60" data-i18n="footer.baseline">L'IA au service du soin, par l'Afrique pour l'Afrique.</p>
            </div>
            <div>
                <h4 class="font-display font-semibold text-white mb-3" data-i18n="footer.liens">Liens utiles</h4>
                <ul class="space-y-2 text-sm text-white/60">
                    <li><a href="#" class="hover:text-accent-light transition" data-i18n="footer.mentions">Mentions légales</a></li>
                    <li><a href="#" class="hover:text-accent-light transition" data-i18n="footer.confidentialite">Confidentialité</a></li>
                    <li><a href="#" class="hover:text-accent-light transition" data-i18n="footer.partenaires">Partenaires</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-display font-semibold text-white mb-3" data-i18n="footer.contact">Contact</h4>
                <ul class="space-y-2 text-sm text-white/60">
                    <li><i class="fas fa-map-marker-alt mr-2 text-accent-light"></i> Bouskoura, Maroc</li>
                    <li><i class="fas fa-phone mr-2 text-accent-light"></i> +212 5 44 56 78 90</li>
                    <li><i class="fas fa-envelope mr-2 text-accent-light"></i> support@synergy.ma</li>
                </ul>
            </div>
            <div>
                <h4 class="font-display font-semibold text-white mb-3" data-i18n="footer.suivez">Suivez-nous</h4>
                <div class="flex gap-4 text-xl text-white/60">
                    <a href="#" class="hover:text-accent-light transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-accent-light transition"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="hover:text-accent-light transition"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 mt-10 pt-8 text-center text-xs text-white/40 max-w-7xl mx-auto px-5">
            © 2026 SynergyAI — Tous droits réservés — v3.0 · Certifié HDS & RGPD
        </div>
    </footer>

    <!-- Bouton retour en haut -->
    <button id="backToTop" class="fixed bottom-7 right-7 w-12 h-12 bg-primary text-white rounded-full shadow-lg flex items-center justify-center text-xl z-40 opacity-0 invisible transition-all duration-300 hover:bg-primary-light" aria-label="Retour en haut">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- ========== SCRIPTS ========== -->
    <script>
        // --- AOS ---
        AOS.init({ duration: 800, easing: 'ease-out-cubic', once: true, offset: 60 });

        // --- Header scroll ---
        const header = document.getElementById('mainHeader');
        window.addEventListener('scroll', () => {
            header.classList.toggle('header-scrolled', window.scrollY > 50);
            header.classList.toggle('header-top', window.scrollY <= 50);
        });

        // --- Menu mobile ---
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileOverlay = document.getElementById('mobileOverlay');
        const closeMenu = document.getElementById('closeMenu');

        function openMenu() {
            mobileMenu.style.transform = 'translateX(0)';
            mobileOverlay.classList.remove('hidden');
        }

        function closeMenuFunc() {
            mobileMenu.style.transform = 'translateX(100%)';
            mobileOverlay.classList.add('hidden');
        }
        menuToggle.addEventListener('click', openMenu);
        closeMenu.addEventListener('click', closeMenuFunc);
        mobileOverlay.addEventListener('click', closeMenuFunc);
        document.querySelectorAll('#mobileMenu a').forEach(link => link.addEventListener('click', closeMenuFunc));

        // --- Back to top ---
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            const visible = window.scrollY > 400;
            backToTop.classList.toggle('opacity-100', visible);
            backToTop.classList.toggle('visible', visible);
            backToTop.classList.toggle('invisible', !visible);
            backToTop.classList.toggle('opacity-0', !visible);
        });
        backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

        // --- Compteurs animés (Intersection Observer) ---
        const counters = document.querySelectorAll('.counter');
        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-target'));
                    const duration = 1500;
                    const step = target / (duration / 16);
                    let current = 0;
                    const updateCounter = () => {
                        current += step;
                        if (current < target) {
                            counter.textContent = Math.floor(current);
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.textContent = target;
                        }
                    };
                    updateCounter();
                    observer.unobserve(counter);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(c => counterObserver.observe(c));

        // --- Confetti ---
        document.querySelectorAll('.btn-primary, .btn-outline').forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (btn.getAttribute('href')?.startsWith('#')) {
                    confetti({ particleCount: 60, spread: 45, origin: { y: 0.5 },
                        colors: ['#0A4A3B', '#E27B46', '#D4A843', '#ffffff'] });
                }
            });
        });

        // --- Leaflet Map ---
        const map = L.map('map').setView([6.5, 1.5], 5);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a> &copy; CartoDB',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);
        const healthCenters = [
            { lat: 5.359, lng: -4.008, name: 'Centre de Santé · Abidjan' },
            { lat: 6.370, lng: 2.391, name: 'Hôpital · Cotonou' },
            { lat: 14.716, lng: -17.467, name: 'Clinique · Dakar' },
            { lat: 12.639, lng: -8.002, name: 'CS Réf · Bamako' },
            { lat: 9.057, lng: 7.495, name: 'CHU · Abuja' },
            { lat: 0.347, lng: 32.582, name: 'Hôpital · Kampala' },
        ];
        healthCenters.forEach(c => {
            L.circleMarker([c.lat, c.lng], { radius: 10, fillColor: '#0A4A3B', color: '#ffffff', weight: 2,
                opacity: 1, fillOpacity: 0.85 })
                .addTo(map).bindPopup(
                    `<strong>🏥 ${c.name}</strong><br><span data-i18n="map.partner">Partenaire SynergyAI</span>`);
        });
        const dispensers = [
            { lat: 5.320, lng: -4.040, name: 'Distributeur · Treichville' },
            { lat: 6.380, lng: 2.430, name: 'Distributeur · Akpakpa' },
            { lat: 14.700, lng: -17.450, name: 'Distributeur · Médina' },
            { lat: 12.650, lng: -7.980, name: 'Distributeur · Commune III' },
        ];
        dispensers.forEach(d => {
            L.circleMarker([d.lat, d.lng], { radius: 8, fillColor: '#E27B46', color: '#ffffff', weight: 2,
                opacity: 1, fillOpacity: 0.85 })
                .addTo(map).bindPopup(
                    `<strong>💊 ${d.name}</strong><br><span data-i18n="map.dispenser">Distributeur connecté</span>`);
        });
        L.circleMarker([6.37, 2.39], { radius: 12, fillColor: '#1B4F6E', color: '#ffffff', weight: 2, opacity: 1,
            fillOpacity: 0.8 })
            .addTo(map).bindPopup(
                '<strong>📞 <span data-i18n="map.teleconsult">Téléconsultation disponible</span></strong><br><span data-i18n="map.doctors">Médecins en ligne 24h/24</span>'
                );
        setTimeout(() => map.invalidateSize(), 300);
        window.addEventListener('resize', () => map.invalidateSize());

        // ========== TRADUCTION MULTILINGUE ==========
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
                "header.subtitle": "Intelligence médicale",
                "nav.parcours": "Parcours",
                "nav.carte": "Carte",
                "nav.distributeurs": "Distributeurs",
                "nav.temoignages": "Témoignages",
                "nav.faq": "FAQ",
                "btn.espace_pro": "Espace pro",
                "hero.tag": "Par l'Afrique, pour l'Afrique",
                "hero.title_part1": "Des soins",
                "hero.title_part2": "augmentés",
                "hero.title_part3": "une santé",
                "hero.title_part4": "accessible",
                "hero.subtitle": "SynergyAI combine l'intelligence artificielle, la voix et des distributeurs connectés pour offrir des soins de qualité, même dans les zones reculées.",
                "btn.decouvrir": "Découvrir le parcours",
                "btn.voir_carte": "Voir la carte",
                "hero.vocal": "Reconnaissance vocale",
                "hero.securite": "Sécurité HDS",
                "hero.iot": "Distributeurs IoT",
                "dashboard.title": "SynergyAI · Tableau de bord",
                "dashboard.roles": "Patients-Médecins-Administrateurs",
                "dashboard.slogan": "Trouvez votre rôle en toute sérénité",
                "dashboard.symptoms": "Symptômes courants :",
                "dashboard.level": "Niveau actualisé · Surveillance",
                "dashboard.tele": "Télémédecine proposée",
                "dashboard.partners": "1000+",
                "dashboard.partners_desc": "Partenaires à proximité",
                "dashboard.nearest": "Trouver",
                "dashboard.nearest_desc": "Centre de santé le plus proche",
                "parcours.surtitre": "Fonctionnement global",
                "parcours.titre": "Votre parcours de soin,<br>étape par étape",
                "parcours.sous_titre": "Une prise en main simple, guidée par la voix et sécurisée par l'IA.",
                "etape1.titre": "Accueil & choix de langue",
                "etape1.texte": "Interface simple avec pictogrammes universels. Choix entre <strong>français, anglais, swahili, wolof, darija</strong> et plus. Adaptation immédiate.",
                "etape2.titre": "Collecte des symptômes",
                "etape2.texte": "Formulaire intuitif <strong>+ option vocale</strong>. Le patient peut décrire ses symptômes oralement. L'IA transcrit et structure les données.",
                "etape2.badge": "Reconnaissance vocale",
                "etape3.titre": "Analyse IA & sécurité",
                "etape3.texte": "Algorithme croisant les symptômes avec une base médicale, détection des drapeaux rouges et contre-indications.",
                "etape3.badge": "Protocole HDS",
                "etape4.titre": "Décision : conseil ou alerte",
                "etape4.texte": "<strong>Cas simple :</strong> conseils + dispensation. <strong>Cas à risque :</strong> alerte immédiate + orientation.",
                "etape4.simple": "Cas simple",
                "etape4.risque": "Cas à risque",
                "etape5.titre": "Dispensation contrôlée",
                "etape5.texte": "Médicaments délivrés via des <strong>distributeurs connectés</strong>. Dose et quantité tracées en temps réel.",
                "etape5.badge": "Distributeur IoT",
                "etape6.titre": "Suivi personnalisé",
                "etape6.texte": "Recommandations post-soin, <strong>rappels de prise</strong>, escalade automatique si absence d'amélioration.",
                "etape6.badge": "Rappels & escalade",
                "carte.surtitre": "Géolocalisation",
                "carte.titre": "Trouvez un centre de santé<br>ou un distributeur proche",
                "carte.sous_titre": "Notre carte interactive référence les établissements partenaires et les distributeurs connectés.",
                "carte.legende": "Légende",
                "carte.legende1": "Centres de santé partenaires",
                "carte.legende2": "Distributeurs de médicaments",
                "carte.legende3": "Téléconsultations disponibles",
                "carte.stats": "Statistiques",
                "carte.stat1": "Centres de santé",
                "carte.stat2": "Distributeurs IoT",
                "carte.stat3": "Couverture : <strong>12 pays</strong> d'Afrique",
                "distributeurs.surtitre": "Distributeurs connectés",
                "distributeurs.titre": "Des médicaments accessibles,<br>même loin des pharmacies",
                "distributeurs.sous_titre": "Nos distributeurs IoT assurent une dispensation sécurisée, tracée et contrôlée à distance.",
                "distrib1.titre": "Authentification sécurisée",
                "distrib1.texte": "Code unique, empreinte digitale ou carte santé pour déverrouiller le distributeur.",
                "distrib2.titre": "Dose contrôlée",
                "distrib2.texte": "Le distributeur délivre la quantité exacte prescrite. Traçabilité complète.",
                "distrib3.titre": "Connecté en temps réel",
                "distrib3.texte": "Inventaire, alertes de stock et rapports transmis automatiquement au centre de santé.",
                "temoignages.surtitre": "Témoignages",
                "temoignages.titre": "Ils nous font confiance",
                "temoignage1.texte": "\"SynergyAI nous a permis de réduire le temps d'attente de 40% dans notre dispensaire rural. La reconnaissance vocale est un atout formidable.\"",
                "temoignage2.texte": "\"Le distributeur automatique a sauvé la mise pendant la saison des pluies. Les patients ont pu recevoir leurs médicaments sans parcourir 30 km.\"",
                "temoignage3.texte": "\"L'interface est si simple que même ma grand-mère l'utilise. Le choix du wolof a tout changé pour elle.\"",
                "faq.surtitre": "FAQ",
                "faq.titre": "Questions fréquentes",
                "faq.q1": "Comment fonctionne la reconnaissance vocale ?",
                "faq.r1": "Le patient parle dans le microphone de son téléphone. Notre IA transcrit et analyse les symptômes en temps réel, dans plusieurs langues africaines.",
                "faq.q2": "Les distributeurs sont-ils sécurisés ?",
                "faq.r2": "Oui, chaque distributeur est équipé d'un système d'authentification forte et d'un chiffrement AES-256. Les stocks sont surveillés à distance.",
                "faq.q3": "Que se passe-t-il si mon cas est jugé à risque ?",
                "faq.r3": "Une alerte est immédiatement envoyée au centre de santé le plus proche. Vous recevez également une proposition de téléconsultation avec un médecin disponible.",
                "footer.baseline": "L'IA au service du soin, par l'Afrique pour l'Afrique.",
                "footer.liens": "Liens utiles",
                "footer.mentions": "Mentions légales",
                "footer.confidentialite": "Confidentialité",
                "footer.partenaires": "Partenaires",
                "footer.contact": "Contact",
                "footer.suivez": "Suivez-nous",
                "map.partner": "Partenaire SynergyAI",
                "map.dispenser": "Distributeur connecté",
                "map.teleconsult": "Téléconsultation disponible",
                "map.doctors": "Médecins en ligne 24h/24"
            },
            en: {
                "header.subtitle": "Medical Intelligence",
                "nav.parcours": "Journey",
                "nav.carte": "Map",
                "nav.distributeurs": "Dispensers",
                "nav.temoignages": "Testimonials",
                "nav.faq": "FAQ",
                "btn.espace_pro": "Professional Area",
                "hero.tag": "By Africa, for Africa",
                "hero.title_part1": "Care",
                "hero.title_part2": "augmented",
                "hero.title_part3": "health",
                "hero.title_part4": "accessible",
                "hero.subtitle": "SynergyAI combines artificial intelligence, voice and connected dispensers to provide quality care, even in remote areas.",
                "btn.decouvrir": "Discover the journey",
                "btn.voir_carte": "View map",
                "hero.vocal": "Voice recognition",
                "hero.securite": "HDS Security",
                "hero.iot": "IoT Dispensers",
                "dashboard.title": "SynergyAI · Dashboard",
                "dashboard.roles": "Patients-Doctors-Admins",
                "dashboard.slogan": "Find your role with confidence",
                "dashboard.symptoms": "Common symptoms:",
                "dashboard.level": "Updated level · Monitoring",
                "dashboard.tele": "Telemedicine available",
                "dashboard.partners": "1000+",
                "dashboard.partners_desc": "Nearby partners",
                "dashboard.nearest": "Find",
                "dashboard.nearest_desc": "Nearest health center",
                "parcours.surtitre": "How it works",
                "parcours.titre": "Your care journey,<br>step by step",
                "parcours.sous_titre": "Simple onboarding, voice-guided and AI-secured.",
                "etape1.titre": "Welcome & language selection",
                "etape1.texte": "Simple interface with universal pictograms. Choice between <strong>French, English, Swahili, Wolof, Darija</strong> and more. Immediate adaptation.",
                "etape2.titre": "Symptom collection",
                "etape2.texte": "Intuitive form <strong>+ voice option</strong>. The patient can describe symptoms orally. AI transcribes and structures the data.",
                "etape2.badge": "Voice recognition",
                "etape3.titre": "AI analysis & security",
                "etape3.texte": "Algorithm cross-referencing symptoms with a medical database, red flag detection and contraindications.",
                "etape3.badge": "HDS Protocol",
                "etape4.titre": "Decision: advice or alert",
                "etape4.texte": "<strong>Simple case:</strong> advice + dispensing. <strong>At-risk case:</strong> immediate alert + referral.",
                "etape4.simple": "Simple case",
                "etape4.risque": "At-risk case",
                "etape5.titre": "Controlled dispensing",
                "etape5.texte": "Medication delivered via <strong>connected dispensers</strong>. Dose and quantity tracked in real time.",
                "etape5.badge": "IoT Dispenser",
                "etape6.titre": "Personalized follow-up",
                "etape6.texte": "Post-care recommendations, <strong>intake reminders</strong>, automatic escalation if no improvement.",
                "etape6.badge": "Reminders & escalation",
                "carte.surtitre": "Geolocation",
                "carte.titre": "Find a health center<br>or a nearby dispenser",
                "carte.sous_titre": "Our interactive map references partner facilities and connected dispensers.",
                "carte.legende": "Legend",
                "carte.legende1": "Partner health centers",
                "carte.legende2": "Medicine dispensers",
                "carte.legende3": "Teleconsultations available",
                "carte.stats": "Statistics",
                "carte.stat1": "Health centers",
                "carte.stat2": "IoT Dispensers",
                "carte.stat3": "Coverage: <strong>12 countries</strong> in Africa",
                "distributeurs.surtitre": "Connected Dispensers",
                "distributeurs.titre": "Medicines accessible,<br>even far from pharmacies",
                "distributeurs.sous_titre": "Our IoT dispensers ensure secure, traceable and remotely controlled dispensing.",
                "distrib1.titre": "Secure authentication",
                "distrib1.texte": "Unique code, fingerprint or health card to unlock the dispenser.",
                "distrib2.titre": "Controlled dose",
                "distrib2.texte": "The dispenser delivers the exact prescribed quantity. Complete traceability.",
                "distrib3.titre": "Real-time connected",
                "distrib3.texte": "Inventory, stock alerts and reports automatically transmitted to the health center.",
                "temoignages.surtitre": "Testimonials",
                "temoignages.titre": "They trust us",
                "temoignage1.texte": "\"SynergyAI has allowed us to reduce waiting time by 40% in our rural clinic. Voice recognition is a tremendous asset.\"",
                "temoignage2.texte": "\"The automatic dispenser saved the day during the rainy season. Patients were able to receive their medication without traveling 30 km.\"",
                "temoignage3.texte": "\"The interface is so simple that even my grandmother uses it. Choosing Wolof changed everything for her.\"",
                "faq.surtitre": "FAQ",
                "faq.titre": "Frequent questions",
                "faq.q1": "How does voice recognition work?",
                "faq.r1": "The patient speaks into their phone's microphone. Our AI transcribes and analyzes symptoms in real time, in several African languages.",
                "faq.q2": "Are the dispensers secure?",
                "faq.r2": "Yes, each dispenser is equipped with a strong authentication system and AES-256 encryption. Stocks are monitored remotely.",
                "faq.q3": "What happens if my case is considered at risk?",
                "faq.r3": "An alert is immediately sent to the nearest health center. You will also receive a teleconsultation proposal with an available doctor.",
                "footer.baseline": "AI at the service of care, by Africa for Africa.",
                "footer.liens": "Useful links",
                "footer.mentions": "Legal notices",
                "footer.confidentialite": "Privacy policy",
                "footer.partenaires": "Partners",
                "footer.contact": "Contact",
                "footer.suivez": "Follow us",
                "map.partner": "SynergyAI Partner",
                "map.dispenser": "Connected dispenser",
                "map.teleconsult": "Teleconsultation available",
                "map.doctors": "Doctors online 24/7"
            },
            pt: {
                "header.subtitle": "Inteligência Médica",
                "nav.parcours": "Jornada",
                "nav.carte": "Mapa",
                "nav.distributeurs": "Distribuidores",
                "nav.temoignages": "Depoimentos",
                "nav.faq": "Perguntas",
                "btn.espace_pro": "Área Profissional",
                "hero.tag": "Por África, para África",
                "hero.title_part1": "Cuidados",
                "hero.title_part2": "aumentados",
                "hero.title_part3": "saúde",
                "hero.title_part4": "acessível",
                "hero.subtitle": "SynergyAI combina inteligência artificial, voz e distribuidores conectados para oferecer cuidados de qualidade, mesmo em áreas remotas.",
                "btn.decouvrir": "Descobrir a jornada",
                "btn.voir_carte": "Ver mapa",
                "hero.vocal": "Reconhecimento de voz",
                "hero.securite": "Segurança HDS",
                "hero.iot": "Distribuidores IoT",
                "dashboard.title": "SynergyAI · Painel",
                "dashboard.roles": "Pacientes-Médicos-Administradores",
                "dashboard.slogan": "Encontre seu papel com confiança",
                "dashboard.symptoms": "Sintomas comuns:",
                "dashboard.level": "Nível atualizado · Monitoramento",
                "dashboard.tele": "Telemedicina disponível",
                "dashboard.partners": "1000+",
                "dashboard.partners_desc": "Parceiros próximos",
                "dashboard.nearest": "Encontrar",
                "dashboard.nearest_desc": "Centro de saúde mais próximo",
                "parcours.surtitre": "Funcionamento global",
                "parcours.titre": "Sua jornada de cuidado,<br>passo a passo",
                "parcours.sous_titre": "Uma tomada em mãos simples, guiada por voz e segura por IA.",
                "etape1.titre": "Boas-vindas & escolha de idioma",
                "etape1.texte": "Interface simples com pictogramas universais. Escolha entre <strong>francês, inglês, swahili, wolof, darija</strong> e mais. Adaptação imediata.",
                "etape2.titre": "Coleta de sintomas",
                "etape2.texte": "Formulário intuitivo <strong>+ opção de voz</strong>. O paciente pode descrever os sintomas oralmente. A IA transcreve e estrutura os dados.",
                "etape2.badge": "Reconhecimento de voz",
                "etape3.titre": "Análise IA & segurança",
                "etape3.texte": "Algoritmo cruzando sintomas com base médica, detecção de bandeiras vermelhas e contraindicações.",
                "etape3.badge": "Protocolo HDS",
                "etape4.titre": "Decisão: conselho ou alerta",
                "etape4.texte": "<strong>Caso simples:</strong> conselhos + dispensação. <strong>Caso de risco:</strong> alerta imediato + orientação.",
                "etape4.simple": "Caso simples",
                "etape4.risque": "Caso de risco",
                "etape5.titre": "Dispensação controlada",
                "etape5.texte": "Medicamentos entregues via <strong>distribuidores conectados</strong>. Dose e quantidade rastreadas em tempo real.",
                "etape5.badge": "Distribuidor IoT",
                "etape6.titre": "Acompanhamento personalizado",
                "etape6.texte": "Recomendações pós-tratamento, <strong>lembretes de tomada</strong>, escalada automática se não houver melhora.",
                "etape6.badge": "Lembretes & escalada",
                "carte.surtitre": "Geolocalização",
                "carte.titre": "Encontre um centro de saúde<br>ou um distribuidor próximo",
                "carte.sous_titre": "Nosso mapa interativo referencia estabelecimentos parceiros e distribuidores conectados.",
                "carte.legende": "Legenda",
                "carte.legende1": "Centros de saúde parceiros",
                "carte.legende2": "Distribuidores de medicamentos",
                "carte.legende3": "Teleconsultas disponíveis",
                "carte.stats": "Estatísticas",
                "carte.stat1": "Centros de saúde",
                "carte.stat2": "Distribuidores IoT",
                "carte.stat3": "Cobertura: <strong>12 países</strong> da África",
                "distributeurs.surtitre": "Distribuidores conectados",
                "distributeurs.titre": "Medicamentos acessíveis,<br>mesmo longe das farmácias",
                "distributeurs.sous_titre": "Nossos distribuidores IoT garantem uma dispensação segura, rastreada e controlada remotamente.",
                "distrib1.titre": "Autenticação segura",
                "distrib1.texte": "Código único, impressão digital ou cartão de saúde para desbloquear o distribuidor.",
                "distrib2.titre": "Dose controlada",
                "distrib2.texte": "O distribuidor entrega a quantidade exata prescrita. Rastreabilidade completa.",
                "distrib3.titre": "Conectado em tempo real",
                "distrib3.texte": "Inventário, alertas de estoque e relatórios transmitidos automaticamente ao centro de saúde.",
                "temoignages.surtitre": "Depoimentos",
                "temoignages.titre": "Eles confiam em nós",
                "temoignage1.texte": "\"SynergyAI nos permitiu reduzir o tempo de espera em 40% em nosso dispensário rural. O reconhecimento de voz é um trunfo formidável.\"",
                "temoignage2.texte": "\"O distribuidor automático salvou o dia durante a estação chuvosa. Os pacientes puderam receber seus medicamentos sem percorrer 30 km.\"",
                "temoignage3.texte": "\"A interface é tão simples que até minha avó usa. A escolha do wolof mudou tudo para ela.\"",
                "faq.surtitre": "Perguntas",
                "faq.titre": "Perguntas frequentes",
                "faq.q1": "Como funciona o reconhecimento de voz?",
                "faq.r1": "O paciente fala no microfone do telefone. Nossa IA transcreve e analisa os sintomas em tempo real, em várias línguas africanas.",
                "faq.q2": "Os distribuidores são seguros?",
                "faq.r2": "Sim, cada distribuidor é equipado com um sistema de autenticação forte e criptografia AES-256. Os estoques são monitorados remotamente.",
                "faq.q3": "O que acontece se meu caso for considerado de risco?",
                "faq.r3": "Um alerta é imediatamente enviado ao centro de saúde mais próximo. Você também receberá uma proposta de teleconsulta com um médico disponível.",
                "footer.baseline": "IA a serviço do cuidado, por África para África.",
                "footer.liens": "Links úteis",
                "footer.mentions": "Avisos legais",
                "footer.confidentialite": "Privacidade",
                "footer.partenaires": "Parceiros",
                "footer.contact": "Contato",
                "footer.suivez": "Siga-nos",
                "map.partner": "Parceiro SynergyAI",
                "map.dispenser": "Distribuidor conectado",
                "map.teleconsult": "Teleconsulta disponível",
                "map.doctors": "Médicos online 24h/24"
            },
            sw: {
                "header.subtitle": "Akili ya Matibabu",
                "nav.parcours": "Njia",
                "nav.carte": "Ramani",
                "nav.distributeurs": "Vigawanya",
                "nav.temoignages": "Ushuhuda",
                "nav.faq": "Maswali",
                "btn.espace_pro": "Eneo la Wataalamu",
                "hero.tag": "Kwa Afrika, kwa ajili ya Afrika",
                "hero.title_part1": "Huduma",
                "hero.title_part2": "zilizoimarishwa",
                "hero.title_part3": "afya",
                "hero.title_part4": "inayofikika",
                "hero.subtitle": "SynergyAI inachanganya akili bandia, sauti na vigawanya vilivyounganishwa ili kutoa huduma bora, hata katika maeneo ya mbali.",
                "btn.decouvrir": "Gundua njia",
                "btn.voir_carte": "Tazama ramani",
                "hero.vocal": "Utambuzi wa sauti",
                "hero.securite": "Usalama wa HDS",
                "hero.iot": "Vigawanya vya IoT",
                "dashboard.title": "SynergyAI · Dashibodi",
                "dashboard.roles": "Wagonjwa-Madaktari-Wasimamizi",
                "dashboard.slogan": "Pata jukumu lako kwa ujasiri",
                "dashboard.symptoms": "Dalili za kawaida:",
                "dashboard.level": "Kiwango kilichosasishwa · Ufuatiliaji",
                "dashboard.tele": "Telemedicine inapatikana",
                "dashboard.partners": "1000+",
                "dashboard.partners_desc": "Washirika wa karibu",
                "dashboard.nearest": "Tafuta",
                "dashboard.nearest_desc": "Kituo cha afya cha karibu",
                "parcours.surtitre": "Jinsi inavyofanya kazi",
                "parcours.titre": "Safari yako ya matibabu,<br>hatua kwa hatua",
                "parcours.sous_titre": "Ushirikishwaji rahisi, unaoongozwa na sauti na kulindwa na AI.",
                "etape1.titre": "Kukaribisha & uchaguzi wa lugha",
                "etape1.texte": "Kiolesura rahisi chenye picha za alama za ulimwengu. Chaguo kati ya <strong>Kifaransa, Kiingereza, Kiswahili, Kiwolof, Darija</strong> na zaidi. Marekebisho ya haraka.",
                "etape2.titre": "Ukusanyaji wa dalili",
                "etape2.texte": "Fomu angavu <strong>+ chaguo la sauti</strong>. Mgonjwa anaweza kuelezea dalili kwa mdomo. AI inanakili na kupanga data.",
                "etape2.badge": "Utambuzi wa sauti",
                "etape3.titre": "Uchambuzi wa AI & usalama",
                "etape3.texte": "Algorithmu inayounganisha dalili na hifadhidata ya matibabu, kugundua bendera nyekundu na vikwazo.",
                "etape3.badge": "Itifaki ya HDS",
                "etape4.titre": "Uamuzi: ushauri au tahadhari",
                "etape4.texte": "<strong>Kesi rahisi:</strong> ushauri + utoaji. <strong>Kesi ya hatari:</strong> tahadhari ya haraka + rufaa.",
                "etape4.simple": "Kesi rahisi",
                "etape4.risque": "Kesi ya hatari",
                "etape5.titre": "Utoaji unaodhibitiwa",
                "etape5.texte": "Dawa zinazotolewa kupitia <strong>vigawanya vilivyounganishwa</strong>. Dozi na wingi vinafuatiliwa kwa wakati halisi.",
                "etape5.badge": "Kigawanya cha IoT",
                "etape6.titre": "Ufuatiliaji wa kibinafsi",
                "etape6.texte": "Mapendekezo ya baada ya matibabu, <strong>vikumbusho vya kuchukua dawa</strong>, kupanda kiotomatiki ikiwa hakuna maboresho.",
                "etape6.badge": "Vikumbusho & kupanda",
                "carte.surtitre": "Jiografia",
                "carte.titre": "Tafuta kituo cha afya<br>au kigawanya cha karibu",
                "carte.sous_titre": "Ramani yetu ingiliani inarejelea vituo vya washirika na vigawanya vilivyounganishwa.",
                "carte.legende": "Ufunguo",
                "carte.legende1": "Vituo vya afya vya washirika",
                "carte.legende2": "Vigawanya vya dawa",
                "carte.legende3": "Teleconsultations zinapatikana",
                "carte.stats": "Takwimu",
                "carte.stat1": "Vituo vya afya",
                "carte.stat2": "Vigawanya vya IoT",
                "carte.stat3": "Chanjo: <strong>nchi 12</strong> barani Afrika",
                "distributeurs.surtitre": "Vigawanya Vilivyounganishwa",
                "distributeurs.titre": "Dawa zinazopatikana,<br>hata mbali na maduka ya dawa",
                "distributeurs.sous_titre": "Vigawanya vyetu vya IoT vinahakikisha utoaji salama, unaofuatiliwa na unaodhibitiwa kwa mbali.",
                "distrib1.titre": "Uthibitishaji salama",
                "distrib1.texte": "Nambari ya kipekee, alama ya kidole au kadi ya afya kufungua kigawanya.",
                "distrib2.titre": "Dozi inadhibitiwa",
                "distrib2.texte": "Kigawanya kinatoa kiasi halisi kilichoagizwa. Ufuatiliaji kamili.",
                "distrib3.titre": "Imeunganishwa kwa wakati halisi",
                "distrib3.texte": "Hesabu, tahadhari za hisa na ripoti zinazotumwa kiotomatiki kwa kituo cha afya.",
                "temoignages.surtitre": "Ushuhuda",
                "temoignages.titre": "Wanatuamini",
                "temoignage1.texte": "\"SynergyAI imeturuhusu kupunguza muda wa kusubiri kwa 40% katika zahanati yetu ya vijijini. Utambuzi wa sauti ni nyenzo kubwa.\"",
                "temoignage2.texte": "\"Kigawanya kiotomatiki kiliokoa hali wakati wa msimu wa mvua. Wagonjwa waliweza kupokea dawa zao bila kusafiri km 30.\"",
                "temoignage3.texte": "\"Kiolesura ni rahisi sana hata bibi yangu anatumia. Kuchagua Kiwolof kulibadilisha kila kitu kwake.\"",
                "faq.surtitre": "Maswali",
                "faq.titre": "Maswali ya mara kwa mara",
                "faq.q1": "Utambuzi wa sauti unafanyaje kazi?",
                "faq.r1": "Mgonjwa anazungumza kwenye maikrofoni ya simu yake. AI yetu inanakili na kuchambua dalili kwa wakati halisi, katika lugha kadhaa za Kiafrika.",
                "faq.q2": "Je, vigawanya ni salama?",
                "faq.r2": "Ndiyo, kila kigawanya kina mfumo wa uthibitishaji imara na usimbaji fiche wa AES-256. Hisa zinafuatiliwa kwa mbali.",
                "faq.q3": "Nini kinatokea ikiwa kesi yangu inachukuliwa kuwa ya hatari?",
                "faq.r3": "Tahadhari inatumwa mara moja kwa kituo cha afya cha karibu. Utapokea pia pendekezo la mashauriano kwa njia ya simu na daktari anayepatikana.",
                "footer.baseline": "AI katika huduma ya utunzaji, kwa Afrika kwa ajili ya Afrika.",
                "footer.liens": "Viungo muhimu",
                "footer.mentions": "Taarifa za kisheria",
                "footer.confidentialite": "Sera ya faragha",
                "footer.partenaires": "Washirika",
                "footer.contact": "Mawasiliano",
                "footer.suivez": "Tufuate",
                "map.partner": "Mshirika wa SynergyAI",
                "map.dispenser": "Kigawanya kilichounganishwa",
                "map.teleconsult": "Mashauriano ya simu yanapatikana",
                "map.doctors": "Madaktari mtandaoni 24/7"
            },
            ha: {
                "header.subtitle": "Hankali na Lafiya",
                "nav.parcours": "Tafiya",
                "nav.carte": "Taswira",
                "nav.distributeurs": "Masu Rarrabawa",
                "nav.temoignages": "Shaida",
                "nav.faq": "Tambayoyi",
                "btn.espace_pro": "Wurin Kwararru",
                "hero.tag": "Daga Afirka, domin Afirka",
                "hero.title_part1": "Kulawa",
                "hero.title_part2": "da aka inganta",
                "hero.title_part3": "lafiya",
                "hero.title_part4": "mai isa",
                "hero.subtitle": "SynergyAI ta hada basirar wucin gari, murya da masu rarrabawa masu hadaka domin bada kulawa mai inganci, hatta a wurare masu nisa.",
                "btn.decouvrir": "Gano tafiya",
                "btn.voir_carte": "Duba taswira",
                "hero.vocal": "Tantance murya",
                "hero.securite": "Tsaro HDS",
                "hero.iot": "Masu Rarrabawa IoT",
                "dashboard.title": "SynergyAI · Allon Kulawa",
                "dashboard.roles": "Marasa Lafiya-Likitoci-Masu Gudanarwa",
                "dashboard.slogan": "Nemo matsayinka cikin nutsuwa",
                "dashboard.symptoms": "Alamu na yau da kullum:",
                "dashboard.level": "Matakin da aka sabunta · Sa ido",
                "dashboard.tele": "Akwai magani ta waya",
                "dashboard.partners": "1000+",
                "dashboard.partners_desc": "Abokan hulda na kusa",
                "dashboard.nearest": "Nemo",
                "dashboard.nearest_desc": "Cibiyar lafiya mafi kusa",
                "parcours.surtitre": "Yadda yake aiki",
                "parcours.titre": "Tafiyar kulawarka,<br>mataki-mataki",
                "parcours.sous_titre": "Saukin farawa, mai jagora ta murya kuma mai tsaro ta AI.",
                "etape1.titre": "Maraba & zabin harshe",
                "etape1.texte": "Muhalli mai sauki tare da alamun duniya. Zabi tsakanin <strong>Faransanci, Turanci, Swahili, Wolof, Darija</strong> da sauransu. Sauya kai tsaye.",
                "etape2.titre": "Tattara alamu",
                "etape2.texte": "Fom mai saukin fahimta <strong>+ zabin murya</strong>. Mara lafiya na iya bayyana alamunsa ta baki. AI tana kwafi da tsara bayanai.",
                "etape2.badge": "Tantance murya",
                "etape3.titre": "Nazari AI & tsaro",
                "etape3.texte": "Algorithm da ke hada alamu da tushen bayanan likitanci, gano tutoci ja da hani.",
                "etape3.badge": "Ka'idar HDS",
                "etape4.titre": "Shawara: nasiha ko sanarwa",
                "etape4.texte": "<strong>Hali mai sauki:</strong> nasiha + bayarwa. <strong>Hali mai hadari:</strong> sanarwa gaggawa + turawa.",
                "etape4.simple": "Hali mai sauki",
                "etape4.risque": "Hali mai hadari",
                "etape5.titre": "Bayarwa mai sarrafawa",
                "etape5.texte": "Magunguna ana bayarwa ta hanyar <strong>masu rarrabawa masu hadaka</strong>. Kashi da adadi ana bin su a ainihin lokaci.",
                "etape5.badge": "Mai Rarrabawa IoT",
                "etape6.titre": "Bibiya ta musamman",
                "etape6.texte": "Shawarwari bayan kulawa, <strong>tunatarwar shan magani</strong>, tsani kai tsaye idan babu ci gaba.",
                "etape6.badge": "Tunatarwa & tsani",
                "carte.surtitre": "Gano Wuri",
                "carte.titre": "Nemo cibiyar lafiya<br>ko mai rarrabawa na kusa",
                "carte.sous_titre": "Taswirarmu mai mu'amala tana nuna cibiyoyin abokan hulda da masu rarrabawa masu hadaka.",
                "carte.legende": "Ma'ana",
                "carte.legende1": "Cibiyoyin lafiya na abokan hulda",
                "carte.legende2": "Masu rarrabawar magunguna",
                "carte.legende3": "Akwai shawarwari ta waya",
                "carte.stats": "Kididdiga",
                "carte.stat1": "Cibiyoyin lafiya",
                "carte.stat2": "Masu Rarrabawa IoT",
                "carte.stat3": "Rufewa: <strong>kasashe 12</strong> na Afirka",
                "distributeurs.surtitre": "Masu Rarrabawa Masu Hadaka",
                "distributeurs.titre": "Magunguna masu isa,<br>hatta nesa da kantunan magani",
                "distributeurs.sous_titre": "Masu rarrabawarmu na IoT suna tabbatar da bayarwa mai tsaro, mai bibiya kuma mai sarrafawa daga nesa.",
                "distrib1.titre": "Tabbatarwa mai tsaro",
                "distrib1.texte": "Lambar musamman, tambarin yatsa ko katin lafiya don bude mai rarrabawa.",
                "distrib2.titre": "Sarrafaffen kashi",
                "distrib2.texte": "Mai rarrabawa yana bayar da ainihin adadin da aka rubuta. Cikakken bibiya.",
                "distrib3.titre": "Hadaka a ainihin lokaci",
                "distrib3.texte": "Kaya, sanarwar hako da rahotanni ana aikawa kai tsaye zuwa cibiyar lafiya.",
                "temoignages.surtitre": "Shaida",
                "temoignages.titre": "Sun amince da mu",
                "temoignage1.texte": "\"SynergyAI ta bamu damar rage lokacin jira da kashi 40% a asibitocin mu na karkara. Tantance murya wata babbar fa'ida ce.\"",
                "temoignage2.texte": "\"Mai rarrabawa ta atomatik ya ceci lamarin a lokacin damina. Marasa lafiya sun sami magungunansu ba tare da tafiya kilomita 30 ba.\"",
                "temoignage3.texte": "\"Muhallin yana da sauki sosai har kakata ma tana amfani da shi. Zabin Wolof ya canza komai gare ta.\"",
                "faq.surtitre": "Tambayoyi",
                "faq.titre": "Tambayoyi akai-akai",
                "faq.q1": "Yaya tantance murya take aiki?",
                "faq.r1": "Mara lafiya yana magana cikin makirufon wayarsa. AI tamu tana kwafi da nazarin alamu a ainihin lokaci, cikin harsunan Afirka da yawa.",
                "faq.q2": "Shin masu rarrabawa suna da tsaro?",
                "faq.r2": "Ee, kowane mai rarrabawa yana da tsarin tabbatarwa mai karfi da kuma rufaffen AES-256. Kaya ana sa ido daga nesa.",
                "faq.q3": "Me zai faru idan an dauki hali na a matsayin mai hadari?",
                "faq.r3": "Ana aika sanarwa nan take zuwa cibiyar lafiya mafi kusa. Hakanan za ku sami shawarar shawara ta waya tare da likita da ke samuwa.",
                "footer.baseline": "AI a hidimar kulawa, daga Afirka domin Afirka.",
                "footer.liens": "Hanyoyi masu amfani",
                "footer.mentions": "Bayanan doka",
                "footer.confidentialite": "Manufar Sirri",
                "footer.partenaires": "Abokan hulda",
                "footer.contact": "Tuntube mu",
                "footer.suivez": "Ku biyo mu",
                "map.partner": "Abokin huldar SynergyAI",
                "map.dispenser": "Mai rarrabawa mai hadaka",
                "map.teleconsult": "Shawara ta waya akwai",
                "map.doctors": "Likitoci na kan layi 24/7"
            },
            yo: {
                "header.subtitle": "Ìmọ̀ Ìṣègùn",
                "nav.parcours": "Ìrìnàjò",
                "nav.carte": "Máàpù",
                "nav.distributeurs": "Àwọn Olùpín",
                "nav.temoignages": "Ẹ̀rí",
                "nav.faq": "Àwọn Ìbéèrè",
                "btn.espace_pro": "Ààyè Ọ̀jọ̀gbọ́n",
                "hero.tag": "Nípasẹ̀ Áfíríkà, fún Áfíríkà",
                "hero.title_part1": "Ìtọ́jú",
                "hero.title_part2": "tí a mú dára",
                "hero.title_part3": "ìlera",
                "hero.title_part4": "tí ó ṣeé rí",
                "hero.subtitle": "SynergyAI ṣe àkópọ̀ ìmọ̀ iṣẹ́ ẹ̀dá, ohùn àti àwọn olùpín tí a so pọ̀ láti pèsè ìtọ́jú tó dáa, àní ní àwọn àgbègbè tí ó jìnnà.",
                "btn.decouvrir": "Ṣàwárí ìrìnàjò náà",
                "btn.voir_carte": "Wo máàpù",
                "hero.vocal": "Ìdámọ̀ ohùn",
                "hero.securite": "Ààbò HDS",
                "hero.iot": "Àwọn Olùpín IoT",
                "dashboard.title": "SynergyAI · Pátákó Ìṣiṣẹ́",
                "dashboard.roles": "Aláìsàn-Dókítà-Alákòóso",
                "dashboard.slogan": "Wá ipò rẹ pẹ̀lú ìfọ̀kànbalẹ̀",
                "dashboard.symptoms": "Àwọn àmì àrùn tí ó wọ́pọ̀:",
                "dashboard.level": "Ìpele tí a mú dójú · Àbójútó",
                "dashboard.tele": "Ìtọ́jú orí tẹlifóònù wà",
                "dashboard.partners": "1000+",
                "dashboard.partners_desc": "Àwọn alábàṣiṣẹ́pọ̀ tí ó wà nítòsí",
                "dashboard.nearest": "Wá",
                "dashboard.nearest_desc": "Ilé-ìwòsàn tí ó sún mọ́ jùlọ",
                "parcours.surtitre": "Bí ó ṣe ń ṣiṣẹ́",
                "parcours.titre": "Ìrìnàjò ìtọ́jú rẹ,<br>ìgbésẹ̀ ní ìgbésẹ̀",
                "parcours.sous_titre": "Ìbẹ̀rẹ̀ tí ó rọrùn, tí ohùn ń tọ́ni àti tí AI dáàbò bò.",
                "etape1.titre": "Káàbọ̀ & yíyan èdè",
                "etape1.texte": "Ìkójọpọ̀ tí ó rọrùn pẹ̀lú àwọn àwòrán àgbáyé. Yíyan láàrin <strong>Faransé, Gẹ̀ẹ́sì, Swahili, Wolof, Darija</strong> àti bẹ́ẹ̀ lọ. Ìmúbadọ́gba lẹ́sẹ̀kẹsẹ̀.",
                "etape2.titre": "Gbigba àwọn àmì àrùn",
                "etape2.texte": "Fọ́ọ̀mù tí ó rọrùn láti lò <strong>+ àṣàyàn ohùn</strong>. Aláìsàn lè ṣe àpèjúwe àwọn àmì àrùn rẹ̀ lẹ́nu. AI ń ṣe àkọsílẹ̀ àti ìṣètò dátà.",
                "etape2.badge": "Ìdámọ̀ ohùn",
                "etape3.titre": "Ìtúpalẹ̀ AI & ààbò",
                "etape3.texte": "Algoridímù tí ń ṣe àkópọ̀ àwọn àmì àrùn pẹ̀lú ibi-ìpamọ́ ìṣègùn, ìṣàwárí àsíá pupa àti àwọn ohun tí kò yẹ.",
                "etape3.badge": "Ìlànà HDS",
                "etape4.titre": "Ìpinnu: ìmọ̀ràn tàbí ìkìlọ̀",
                "etape4.texte": "<strong>Ọ̀ràn tí ó rọrùn:</strong> ìmọ̀ràn + pípín. <strong>Ọ̀ràn ewu:</strong> ìkìlọ̀ lẹ́sẹ̀kẹsẹ̀ + ìtọ́ka.",
                "etape4.simple": "Ọ̀ràn tí ó rọrùn",
                "etape4.risque": "Ọ̀ràn ewu",
                "etape5.titre": "Pípín tí a ṣàkóso",
                "etape5.texte": "Àwọn oògùn tí a pín nípasẹ̀ <strong>àwọn olùpín tí a so pọ̀</strong>. Ìwọ̀n àti iye tí a ń tọpa ní àkókò gangan.",
                "etape5.badge": "Olùpín IoT",
                "etape6.titre": "Ìtẹ̀lé tí a ṣe àdáni",
                "etape6.texte": "Àwọn ìmọ̀ràn lẹ́yìn ìtọ́jú, <strong>àwọn ìránnilétí lílò</strong>, ìgòkè aládàáṣiṣẹ́ bí kò bá sí ìlọsíwájú.",
                "etape6.badge": "Àwọn ìránnilétí & ìgòkè",
                "carte.surtitre": "Ìwá ibi",
                "carte.titre": "Wá ilé-ìwòsàn<br>tàbí olùpín tí ó sún mọ́",
                "carte.sous_titre": "Máàpù wa tí ó ń ṣiṣẹ́ ń tọ́ka sí àwọn ilé-iṣẹ́ alábàṣiṣẹ́pọ̀ àti àwọn olùpín tí a so pọ̀.",
                "carte.legende": "Ìtumọ̀",
                "carte.legende1": "Àwọn ilé-ìwòsàn alábàṣiṣẹ́pọ̀",
                "carte.legende2": "Àwọn olùpín oògùn",
                "carte.legende3": "Ìtọ́jú orí tẹlifóònù wà",
                "carte.stats": "Ìṣirò",
                "carte.stat1": "Àwọn ilé-ìwòsàn",
                "carte.stat2": "Àwọn Olùpín IoT",
                "carte.stat3": "Ìbò: <strong>àwọn orílẹ̀-èdè 12</strong> ní Áfíríkà",
                "distributeurs.surtitre": "Àwọn Olùpín Tí A So Pọ̀",
                "distributeurs.titre": "Àwọn oògùn tí ó ṣeé rí,<br>àní tí ó bá jìnnà sí ilé-oògùn",
                "distributeurs.sous_titre": "Àwọn olùpín wa IoT ń ṣe ìdánilójú pípín tí ó ní ààbò, tí a tọpa àti tí a ṣàkóso láti ọ̀nà jíjìn.",
                "distrib1.titre": "Ìfọwọ́sí tí ó ní ààbò",
                "distrib1.texte": "Kóòdù àdáni, ìtẹ̀ka tàbí káàdì ìlera láti ṣí olùpín.",
                "distrib2.titre": "Ìwọ̀n tí a ṣàkóso",
                "distrib2.texte": "Olùpín ń pín iye gbòòrò tí a rò fún. Ìtọpinpin tí ó pé.",
                "distrib3.titre": "Tí a so pọ̀ ní àkókò gangan",
                "distrib3.texte": "Àkọjọ-ọjà, àwọn ìkìlọ̀ àkójọ àti àwọn ìròyìn tí a ń fi ránṣẹ́ láìdáwọ́dúró sí ilé-ìwòsàn.",
                "temoignages.surtitre": "Ẹ̀rí",
                "temoignages.titre": "Wọ́n gbẹ́kẹ̀lé wa",
                "temoignage1.texte": "\"SynergyAI ti jẹ́ kí a dín àkókò ìdúró kù ní 40% ní ilé-ìwòsàn ìgbèríko wa. Ìdámọ̀ ohùn jẹ́ ohun-ìní ńlá.\"",
                "temoignage2.texte": "\"Olùpín aládàáṣiṣẹ́ gba ọjọ́ là ní àsìkò òjò. Àwọn aláìsàn lè gba oògùn wọn láìrìn kìlómítà 30.\"",
                "temoignage3.texte": "\"Ìkójọpọ̀ náà rọrùn tóbẹ́ẹ̀ tí ìyá àgbà mi pàápàá ń lò ó. Yíyan Wolof yí ohun gbogbo padà fún un.\"",
                "faq.surtitre": "Àwọn Ìbéèrè",
                "faq.titre": "Àwọn ìbéèrè tí a ń sábà béèrè",
                "faq.q1": "Báwo ni ìdámọ̀ ohùn ṣe ń ṣiṣẹ́?",
                "faq.r1": "Aláìsàn ń sọ̀rọ̀ sínú makirofóònù fóònù rẹ̀. AI wa ń ṣe àkọsílẹ̀ àti ìtúpalẹ̀ àwọn àmì àrùn ní àkókò gangan, ní ọ̀pọ̀ àwọn èdè Áfíríkà.",
                "faq.q2": "Ṣé àwọn olùpín ní ààbò?",
                "faq.r2": "Bẹ́ẹ̀ni, olùpín kọ̀ọ̀kan ní ètò ìfọwọ́sí tó lágbára àti ìsọfúnni AES-256. Àwọn àkójọ-ọjà ń ṣe àbójútó láti ọ̀nà jíjìn.",
                "faq.q3": "Kí ló máa ṣẹlẹ̀ tí wọ́n bá ka ọ̀ràn mi sí ewu?",
                "faq.r3": "A ó fi ìkìlọ̀ ránṣẹ́ lẹ́sẹ̀kẹsẹ̀ sí ilé-ìwòsàn tí ó sún mọ́ jùlọ. Wàá tún gba ìmọ̀ràn ìtọ́jú orí tẹlifóònù pẹ̀lú dókítà tí ó wà.",
                "footer.baseline": "AI ní iṣẹ́ ìtọ́jú, nípasẹ̀ Áfíríkà fún Áfíríkà.",
                "footer.liens": "Àwọn ìjápọ̀ tí ó wúlò",
                "footer.mentions": "Àkọsílẹ̀ òfin",
                "footer.confidentialite": "Ìlànà Àṣírí",
                "footer.partenaires": "Àwọn alábàṣiṣẹ́pọ̀",
                "footer.contact": "Ìbánisọ̀rọ̀",
                "footer.suivez": "Tẹ̀lé wa",
                "map.partner": "Alábàṣiṣẹ́pọ̀ SynergyAI",
                "map.dispenser": "Olùpín tí a so pọ̀",
                "map.teleconsult": "Ìtọ́jú orí tẹlifóònù wà",
                "map.doctors": "Dókítà orí ayélujára 24/7"
            },
            ig: {
                "header.subtitle": "Ọgụgụ Isi Ahụike",
                "nav.parcours": "Njem",
                "nav.carte": "Maapụ",
                "nav.distributeurs": "Ndị Nkesa",
                "nav.temoignages": "Ịgba Àmà",
                "nav.faq": "Ajụjụ",
                "btn.espace_pro": "Mpaghara Ọkachamara",
                "hero.tag": "Site n'Afrika, maka Afrika",
                "hero.title_part1": "Nlekọta",
                "hero.title_part2": "emelitere",
                "hero.title_part3": "ahụike",
                "hero.title_part4": "enwetara",
                "hero.subtitle": "SynergyAI na-ejikọta ọgụgụ isi arụrụala, olu na ndị nkesa ejikọtara iji nye nlekọta dị mma, ọbụlagodi n'ime ime obodo.",
                "btn.decouvrir": "Chọpụta njem ahụ",
                "btn.voir_carte": "Lee maapụ",
                "hero.vocal": "Nghọta olu",
                "hero.securite": "Nchekwa HDS",
                "hero.iot": "Ndị Nkesa IoT",
                "dashboard.title": "SynergyAI · Dashboard",
                "dashboard.roles": "Ndị Ọrịa-Dọkịta-Ndị Nchịkwa",
                "dashboard.slogan": "Chọta ọrụ gị na ntụkwasị obi",
                "dashboard.symptoms": "Ihe mgbaàmà nkịtị:",
                "dashboard.level": "Ọkwa emelitere · Nlebaanya",
                "dashboard.tele": "Telemedicine dị",
                "dashboard.partners": "1000+",
                "dashboard.partners_desc": "Ndị mmekọ dị nso",
                "dashboard.nearest": "Chọta",
                "dashboard.nearest_desc": "Ụlọọgwụ kacha nso",
                "parcours.surtitre": "Otu o si arụ ọrụ",
                "parcours.titre": "Njem nlekọta gị,<br>nzọụkwụ site na nzọụkwụ",
                "parcours.sous_titre": "Mmalite dị mfe, nke olu na-eduzi ma chekwaa site na AI.",
                "etape1.titre": "Nnabata & nhọrọ asụsụ",
                "etape1.texte": "Ntụmadị dị mfe nwere eserese ụwa niile. Nhọrọ n'etiti <strong>French, English, Swahili, Wolof, Darija</strong> na ndị ọzọ. Mmegharị ozugbo.",
                "etape2.titre": "Nchịkọta ihe mgbaàmà",
                "etape2.texte": "Ụdị dị mfe nghọta <strong>+ nhọrọ olu</strong>. Onye ọrịa nwere ike ịkọwa ihe mgbaàmà ya n'ọnụ. AI na-edepụta ma hazie data.",
                "etape2.badge": "Nghọta olu",
                "etape3.titre": "Nyocha AI & nchekwa",
                "etape3.texte": "Algorithm na-ejikọta ihe mgbaàmà na nchekwa data ahụike, nchọpụta ọkọlọtọ uhie na ihe mgbochi.",
                "etape3.badge": "Usoro HDS",
                "etape4.titre": "Mkpebi: ndụmọdụ ma ọ bụ mkpu",
                "etape4.texte": "<strong>Ikpe dị mfe:</strong> ndụmọdụ + nkesa. <strong>Ikpe dị ize ndụ:</strong> mkpu ozugbo + ntụgharị.",
                "etape4.simple": "Ikpe dị mfe",
                "etape4.risque": "Ikpe dị ize ndụ",
                "etape5.titre": "Nkesa a na-achịkwa",
                "etape5.texte": "Ọgwụ a na-enye site na <strong>ndị nkesa ejikọtara</strong>. A na-esochi dose na ọnụọgụ n'oge.",
                "etape5.badge": "Onye Nkesa IoT",
                "etape6.titre": "Nsonso ahaziri onwe",
                "etape6.texte": "Ndụmọdụ mgbe nlekọta gasịrị, <strong>ihe ncheta ịṅụ ọgwụ</strong>, nrịgo akpaka ma ọ bụrụ na enweghị mmeziwanye.",
                "etape6.badge": "Ihe ncheta & nrịgo",
                "carte.surtitre": "Ịchọta Ebe",
                "carte.titre": "Chọta ụlọọgwụ<br>ma ọ bụ onye nkesa dị nso",
                "carte.sous_titre": "Maapụ anyị mmekọrịta na-ezo aka na ụlọ ọrụ ndị mmekọ na ndị nkesa ejikọtara.",
                "carte.legende": "Akụkọ nkọwa",
                "carte.legende1": "Ụlọọgwụ ndị mmekọ",
                "carte.legende2": "Ndị nkesa ọgwụ",
                "carte.legende3": "Teleconsultations dị",
                "carte.stats": "Ọnụọgụ",
                "carte.stat1": "Ụlọọgwụ",
                "carte.stat2": "Ndị Nkesa IoT",
                "carte.stat3": "Mkpuchi: <strong>mba 12</strong> n'Afrika",
                "distributeurs.surtitre": "Ndị Nkesa Ejikọtara",
                "distributeurs.titre": "Ọgwụ ndị a na-enweta,<br>ọbụlagodi n'ebe dị anya site na ụlọ ahịa ọgwụ",
                "distributeurs.sous_titre": "Ndị nkesa IoT anyị na-ahụ maka nkesa echekwara, esochiri ma chịkwaa site n'ebe dị anya.",
                "distrib1.titre": "Nyocha echekwara",
                "distrib1.texte": "Koodu pụrụ iche, akara mkpịsị aka ma ọ bụ kaadị ahụike iji meghee onye nkesa.",
                "distrib2.titre": "Dose a na-achịkwa",
                "distrib2.texte": "Onye nkesa na-enye kpọmkwem ọnụọgụ e nyere n'iwu. Nsochi zuru oke.",
                "distrib3.titre": "Ejikọtara n'oge",
                "distrib3.texte": "Ndepụta ngwa ahịa, mkpu ngwaahịa na akụkọ a na-ezigara ụlọọgwụ na-akpaghị aka.",
                "temoignages.surtitre": "Ịgba Àmà",
                "temoignages.titre": "Ha tụkwasịrị anyị obi",
                "temoignage1.texte": "\"SynergyAI enyewo anyị aka belata oge nchere site na 40% n'ụlọọgwụ ime obodo anyị. Nghọta olu bụ nnukwu uru.\"",
                "temoignage2.texte": "\"Onye nkesa akpaka zọpụtara ụbọchị n'oge oge mmiri ozuzo. Ndị ọrịa nwere ike ịnata ọgwụ ha n'agaghị aga kilomita 30.\"",
                "temoignage3.texte": "\"Ntụmadị ahụ dị mfe nke na ọbụna nne nne m na-eji ya. Ịhọrọ Wolof gbanwere ihe niile maka ya.\"",
                "faq.surtitre": "Ajụjụ",
                "faq.titre": "Ajụjụ a na-ajụkarị",
                "faq.q1": "Kedu ka nghọta olu si arụ ọrụ?",
                "faq.r1": "Onye ọrịa na-ekwu okwu n'ime igwe okwu ekwentị ya. AI anyị na-edepụta ma nyochaa ihe mgbaàmà n'oge, n'ọtụtụ asụsụ Afrika.",
                "faq.q2": "Ndị nkesa ọ nwere nchekwa?",
                "faq.r2": "Ee, onye nkesa ọ bụla nwere usoro nyocha siri ike na nzuzo AES-256. A na-enyocha ngwaahịa site n'ebe dị anya.",
                "faq.q3": "Gịnị na-eme ma ọ bụrụ na e were ikpe m dị ka ihe ize ndụ?",
                "faq.r3": "A na-eziga mkpu ozugbo na ụlọọgwụ kacha nso. Ị ga-enwetakwa ndụmọdụ teleconsultation na dọkịta dịnụ.",
                "footer.baseline": "AI n'ọrụ nlekọta, site n'Afrika maka Afrika.",
                "footer.liens": "Njikọ bara uru",
                "footer.mentions": "Ọkwa iwu",
                "footer.confidentialite": "Amụma Nzuzo",
                "footer.partenaires": "Ndị mmekọ",
                "footer.contact": "Kpọtụrụ anyị",
                "footer.suivez": "Soro anyị",
                "map.partner": "Onye mmekọ SynergyAI",
                "map.dispenser": "Onye nkesa ejikọtara",
                "map.teleconsult": "Teleconsultation dị",
                "map.doctors": "Dọkịta n'ịntanetị 24/7"
            },
            am: {
                "header.subtitle": "የህክምና ብልህነት",
                "nav.parcours": "ጉዞ",
                "nav.carte": "ካርታ",
                "nav.distributeurs": "አከፋፋዮች",
                "nav.temoignages": "ምስክርነቶች",
                "nav.faq": "ጥያቄዎች",
                "btn.espace_pro": "የባለሙያ ቦታ",
                "hero.tag": "ከአፍሪካ፣ ለአፍሪካ",
                "hero.title_part1": "እንክብካቤ",
                "hero.title_part2": "የተሻሻለ",
                "hero.title_part3": "ጤና",
                "hero.title_part4": "ተደራሽ",
                "hero.subtitle": "SynergyAI አርቲፊሻል ኢንተሊጀንስን፣ ድምጽን እና የተገናኙ አከፋፋዮችን በማጣመር ርቀው ባሉ አካባቢዎች እንኳ ጥራት ያለው እንክብካቤ ይሰጣል።",
                "btn.decouvrir": "ጉዞውን ያግኙ",
                "btn.voir_carte": "ካርታ ይመልከቱ",
                "hero.vocal": "የድምጽ ለይቶ ማወቅ",
                "hero.securite": "የHDS ደህንነት",
                "hero.iot": "IoT አከፋፋዮች",
                "dashboard.title": "SynergyAI · ዳሽቦርድ",
                "dashboard.roles": "ታካሚዎች-ዶክተሮች-አስተዳዳሪዎች",
                "dashboard.slogan": "ሚናዎን በልበ ሙሉነት ያግኙ",
                "dashboard.symptoms": "የተለመዱ ምልክቶች፦",
                "dashboard.level": "የዘመነ ደረጃ · ክትትል",
                "dashboard.tele": "ቴሌሜዲሲን ይገኛል",
                "dashboard.partners": "1000+",
                "dashboard.partners_desc": "በአቅራቢያ ያሉ አጋሮች",
                "dashboard.nearest": "ይፈልጉ",
                "dashboard.nearest_desc": "በጣም ቅርብ የሆነ የጤና ጣቢያ",
                "parcours.surtitre": "አጠቃላይ አሠራር",
                "parcours.titre": "የእንክብካቤ ጉዞዎ፣<br>ደረጃ በደረጃ",
                "parcours.sous_titre": "በድምጽ የሚመራ እና በAI የተጠበቀ ቀላል አጠቃቀም።",
                "etape1.titre": "አቀባበል እና የቋንቋ ምርጫ",
                "etape1.texte": "ሁለንተናዊ ሥዕላዊ መግለጫዎች ያለው ቀላል በይነገጽ። በ<strong>ፈረንሳይኛ፣ እንግሊዝኛ፣ ስዋሂሊ፣ ዎሎፍ፣ ዳሪጃ</strong> እና ሌሎች መካከል ምርጫ። ወዲያውኑ መላመድ።",
                "etape2.titre": "የምልክቶች ስብስብ",
                "etape2.texte": "ሊታወቅ የሚችል ቅጽ <strong>+ የድምጽ አማራጭ</strong>። ታካሚው ምልክቶቹን በቃል መግለጽ ይችላል። AI ውሂቡን ይገለብጣል እና ያዋቅራል።",
                "etape2.badge": "የድምጽ ለይቶ ማወቅ",
                "etape3.titre": "AI ትንተና እና ደህንነት",
                "etape3.texte": "ምልክቶችን ከህክምና ዳታቤዝ ጋር የሚያቋርጥ አልጎሪዝም፣ ቀይ ባንዲራዎችን እና ተቃራኒ ምልክቶችን መለየት።",
                "etape3.badge": "HDS ፕሮቶኮል",
                "etape4.titre": "ውሳኔ፦ ምክር ወይም ማስጠንቀቂያ",
                "etape4.texte": "<strong>ቀላል ጉዳይ፦</strong> ምክር + ማከፋፈል። <strong>አደገኛ ጉዳይ፦</strong> አስቸኳይ ማስጠንቀቂያ + ማቅናት።",
                "etape4.simple": "ቀላል ጉዳይ",
                "etape4.risque": "አደገኛ ጉዳይ",
                "etape5.titre": "ቁጥጥር የሚደረግበት ማከፋፈል",
                "etape5.texte": "መድሃኒቶች በ<strong>ተገናኙ አከፋፋዮች</strong> በኩል ይሰጣሉ። መጠን እና ብዛት በእውነተኛ ጊዜ ይከታተላል።",
                "etape5.badge": "IoT አከፋፋይ",
                "etape6.titre": "ግላዊ ክትትል",
                "etape6.texte": "ከእንክብካቤ በኋላ ምክሮች፣ <strong>የመውሰድ አስታዋሾች</strong>፣ መሻሻል ከሌለ አውቶማቲክ ማሻቀብ።",
                "etape6.badge": "አስታዋሾች እና ማሻቀብ",
                "carte.surtitre": "አካባቢ መፈለግ",
                "carte.titre": "የጤና ጣቢያ ወይም<br>በአቅራቢያ ያለ አከፋፋይ ያግኙ",
                "carte.sous_titre": "በይነተገናኝ ካርታችን አጋር ተቋማትን እና የተገናኙ አከፋፋዮችን ያመለክታል።",
                "carte.legende": "መፍቻ",
                "carte.legende1": "አጋር የጤና ጣቢያዎች",
                "carte.legende2": "የመድሃኒት አከፋፋዮች",
                "carte.legende3": "ቴሌኮንሰልቴሽኖች ይገኛሉ",
                "carte.stats": "ስታቲስቲክስ",
                "carte.stat1": "የጤና ጣቢያዎች",
                "carte.stat2": "IoT አከፋፋዮች",
                "carte.stat3": "ሽፋን፦ <strong>12 አገራት</strong> በአፍሪካ",
                "distributeurs.surtitre": "የተገናኙ አከፋፋዮች",
                "distributeurs.titre": "ከፋርማሲዎች ርቀው እንኳ፣<br>ተደራሽ መድሃኒቶች",
                "distributeurs.sous_titre": "የእኛ IoT አከፋፋዮች ደህንነቱ የተጠበቀ፣ የተከታተለ እና በርቀት ቁጥጥር የሚደረግበት ማከፋፈልን ያረጋግጣሉ።",
                "distrib1.titre": "ደህንነቱ የተጠበቀ ማረጋገጫ",
                "distrib1.texte": "አከፋፋዩን ለመክፈት ልዩ ኮድ፣ የጣት አሻራ ወይም የጤና ካርድ።",
                "distrib2.titre": "ቁጥጥር የሚደረግበት መጠን",
                "distrib2.texte": "አከፋፋዩ በትእዛዝ የተሰጠውን ትክክለኛ መጠን ያቀርባል። ሙሉ ክትትል።",
                "distrib3.titre": "በእውነተኛ ጊዜ የተገናኘ",
                "distrib3.texte": "የእቃ ዝርዝር፣ የክምችት ማስጠንቀቂያዎች እና ሪፖርቶች ወደ ጤና ጣቢያው በራስ-ሰር ይላካሉ።",
                "temoignages.surtitre": "ምስክርነቶች",
                "temoignages.titre": "እነሱ ያምኑናል",
                "temoignage1.texte": "\"SynergyAI በገጠር ሕክምና ቤታችን ውስጥ የጥበቃ ጊዜን በ40% እንድንቀንስ አስችሎናል። የድምጽ ለይቶ ማወቅ ትልቅ ጥቅም ነው።\"",
                "temoignage2.texte": "\"አውቶማቲክ አከፋፋዩ በዝናብ ወቅት ቀኑን አትርፏል። ታካሚዎች 30 ኪ.ሜ. ሳይጓዙ መድሃኒታቸውን ማግኘት ችለዋል።\"",
                "temoignage3.texte": "\"በይነገጹ በጣም ቀላል ስለሆነ አያቴ እንኳን ትጠቀማለች። ዎሎፍን መምረጥ ለእሷ ሁሉንም ነገር ለውጦታል።\"",
                "faq.surtitre": "ጥያቄዎች",
                "faq.titre": "ተደጋጋሚ ጥያቄዎች",
                "faq.q1": "የድምጽ ለይቶ ማወቅ እንዴት ይሰራል?",
                "faq.r1": "ታካሚው በስልኩ ማይክሮፎን ውስጥ ይናገራል። የእኛ AI በተለያዩ የአፍሪካ ቋንቋዎች ምልክቶችን በእውነተኛ ጊዜ ይገለብጣል እና ይተነትናል።",
                "faq.q2": "አከፋፋዮቹ ደህንነታቸው የተጠበቀ ነው?",
                "faq.r2": "አዎ፣ እያንዳንዱ አከፋፋይ ጠንካራ የማረጋገጫ ስርዓት እና AES-256 ምስጠራ የተገጠመለት ነው። ክምችቶች በርቀት ቁጥጥር ይደረግባቸዋል።",
                "faq.q3": "የእኔ ጉዳይ እንደ አደገኛ ተደርጎ ቢቆጠር ምን ይሆናል?",
                "faq.r3": "ማስጠንቀቂያ ወዲያውኑ በአቅራቢያው ወደሚገኝ የጤና ጣቢያ ይላካል። እንዲሁም ከሚገኝ ዶክተር ጋር የቴሌኮንሰልቴሽን ሀሳብ ይደርስዎታል።",
                "footer.baseline": "AI በእንክብካቤ አገልግሎት፣ ከአፍሪካ ለአፍሪካ።",
                "footer.liens": "ጠቃሚ አገናኞች",
                "footer.mentions": "የህግ ማስታወሻዎች",
                "footer.confidentialite": "የግላዊነት ፖሊሲ",
                "footer.partenaires": "አጋሮች",
                "footer.contact": "አድራሻ",
                "footer.suivez": "ይከታተሉን",
                "map.partner": "የSynergyAI አጋር",
                "map.dispenser": "የተገናኘ አከፋፋይ",
                "map.teleconsult": "ቴሌኮንሰልቴሽን ይገኛል",
                "map.doctors": "ዶክተሮች በመስመር ላይ 24/7"
            },
            om: {
                "header.subtitle": "Beekumsa Fayyaa",
                "nav.parcours": "Imala",
                "nav.carte": "Kaartaa",
                "nav.distributeurs": "Raabsitoota",
                "nav.temoignages": "Ragaa Bahuu",
                "nav.faq": "Gaaffilee",
                "btn.espace_pro": "Iddoo Ogeessaa",
                "hero.tag": "Afrikaa irraa, Afrikaa dhaaf",
                "hero.title_part1": "Kunuunsa",
                "hero.title_part2": "fooyya'e",
                "hero.title_part3": "fayyaa",
                "hero.title_part4": "argamuu danda'u",
                "hero.subtitle": "SynergyAI yaada namtolchee, sagalee fi raabsitoota walqabatan walitti makuun bakka fagoo ta'eyyuu kunuunsa qulqullina qabu kenna.",
                "btn.decouvrir": "Imala kana argadhu",
                "btn.voir_carte": "Kaartaa ilaali",
                "hero.vocal": "Sagalee addaan baafachuu",
                "hero.securite": "Nageenya HDS",
                "hero.iot": "Raabsitoota IoT",
                "dashboard.title": "SynergyAI · Dashboard",
                "dashboard.roles": "Dhukkubsattoota-Dokturoota-Bulchitoota",
                "dashboard.slogan": "Ga'ee kee ofitti amanummaadhaan argadhu",
                "dashboard.symptoms": "Mallattoolee beekamoo:",
                "dashboard.level": "Sadarkaa haaromfame · To'annaa",
                "dashboard.tele": "Telemedicine ni argama",
                "dashboard.partners": "1000+",
                "dashboard.partners_desc": "Mishktota dhiyoo jiran",
                "dashboard.nearest": "Barbaadi",
                "dashboard.nearest_desc": "Buufata fayyaa dhiyoo",
                "parcours.surtitre": "Akaakuu hojii",
                "parcours.titre": "Imala kunuunsa kee,<br>tarkanfii tarkanfiidhaan",
                "parcours.sous_titre": "Seenuu salphaa, sagaleedhaan qajeelfamee fi AI tiin eegame.",
                "etape1.titre": "Simannaa & filannoo afaanii",
                "etape1.texte": "Mallattoolee addunyaa waliinii qabuudhaan interface salphaa. <strong>Afaan Faransaay, Ingiliffa, Swaahilii, Wolof, Darija</strong> fi kkf filachuu. Madaqsuu battalaa.",
                "etape2.titre": "Mallattoolee sassaabuu",
                "etape2.texte": "Unka salphaa <strong>+ filannoo sagalee</strong>. Dhukkubsataan mallattoolee isaa afaaniin ibsuu danda'a. AI deetaa barreessitee qindeessa.",
                "etape2.badge": "Sagalee addaan baafachuu",
                "etape3.titre": "Xiinxala AI & nageenya",
                "etape3.texte": "Mallattoolee kuusaa deetaa fayyaa waliin wal bira qabuun algorithmii, alaaba diimaa fi wantoota fayyadamuu hin qabne addaan baafachuu.",
                "etape3.badge": "Aangoo HDS",
                "etape4.titre": "Murtoo: gorsa ykn akeekkachiisa",
                "etape4.texte": "<strong>Dhimma salphaa:</strong> gorsa + raabsuu. <strong>Dhimma balaa qabu:</strong> akeekkachiisa battalaa + qajeelchuu.",
                "etape4.simple": "Dhimma salphaa",
                "etape4.risque": "Dhimma balaa qabu",
                "etape5.titre": "Raabsuu to'atamaa",
                "etape5.texte": "Qorichoota <strong>raabsitoota walqabatan</strong> karaa kenname. Doosiin fi baay'ina yeroo dhugaatti hordofama.",
                "etape5.badge": "Raabsaa IoT",
                "etape6.titre": "Hordoffii dhuunfaa",
                "etape6.texte": "Gorsa kunuunsa boodaa, <strong>yaadachiisa fudhachuu</strong>, fooyya'iinsi yoo hin jiraanne ol kaasuun ofumaan.",
                "etape6.badge": "Yaadachiisoota & ol kaasuu",
                "carte.surtitre": "Bakka barbaaduu",
                "carte.titre": "Buufata fayyaa ykn<br>raabsaa dhiyoo barbaadi",
                "carte.sous_titre": "Kaartaan keenya walnyaatinsa qabu dhaabbilee mishktotaa fi raabsitoota walqabatan agarsiisa.",
                "carte.legende": "Hiika",
                "carte.legende1": "Buufata fayyaa mishktotaa",
                "carte.legende2": "Raabsitoota qorichaa",
                "carte.legende3": "Teleconsultations ni argamu",
                "carte.stats": "Istaatistikii",
                "carte.stat1": "Buufata fayyaa",
                "carte.stat2": "Raabsitoota IoT",
                "carte.stat3": "Uwwisaa: <strong>biyyoota 12</strong> Afrikaa keessaa",
                "distributeurs.surtitre": "Raabsitoota Walqabatan",
                "distributeurs.titre": "Qorichoota argamuu danda'an,<br>fagaattis mana qorichaa irraa",
                "distributeurs.sous_titre": "Raabsitootni keenya IoT raabsuu nageenya qabu, hordofamu fi fagootii to'atamu mirkaneessu.",
                "distrib1.titre": "Mirkaneessa nageenya qabu",
                "distrib1.texte": "Koodii addaa, qubeessa qubaa ykn kaardii fayyaa raabsaa banuuf.",
                "distrib2.titre": "Doosii to'atame",
                "distrib2.texte": "Raabsaan baay'ina sirrii ajajame kenna. Hordoffii guutuu.",
                "distrib3.titre": "Yeroo dhugaatti walqabate",
                "distrib3.texte": "Kuusaa, akeekkachiisa kuusaa fi gabaasoota ofumaan buufata fayyaatti ergamu.",
                "temoignages.surtitre": "Ragaa Bahuu",
                "temoignages.titre": "Isaan nu amanu",
                "temoignage1.texte": "\"SynergyAI akkaataa eegumsaa %40 tiin akka hir'ifnu nu dandeessisee jira. Sagalee addaan baafachuun bu'aa guddaa dha.\"",
                "temoignage2.texte": "\"Raabsaan ofumaan hojjettu yeroo roobaa keessa guyyaa baraare. Dhukkubsattoonni km 30 deemuu malee qoricha isaanii argachuu danda'aniiru.\"",
                "temoignage3.texte": "\"Interfaceichi baayyee salphaa waan ta'eef akkoon kiyya iyyuu ni fayyadamti. Wolof filachuun waan hunda isheedhaaf jijjiire.\"",
                "faq.surtitre": "Gaaffilee",
                "faq.titre": "Gaaffilee irra deddeebi'amuu",
                "faq.q1": "Sagaleen addaan baafachuu akkamitti hojjeta?",
                "faq.r1": "Dhukkubsataan maayikroofoonii bilbilaa isaa keessatti dubbata. AI keenya mallattoolee afaanota Afrikaa hedduu keessatti yeroo dhugaatti barreessitee xiinxalti.",
                "faq.q2": "Raabsitootni nageenya qabuu?",
                "faq.r2": "Eeyyee, raabsaan hundi sirna mirkaneessa cimaa fi koodita AES-256 tiin qophaa'eera. Kuusaan fagootii to'atama.",
                "faq.q3": "Dhimmi koo balaa qaba jedhamee yoo fudhatame maal ta'a?",
                "faq.r3": "Akeekkachiisi battalumatti buufata fayyaa dhiyootti ergama. Akkasumas doktara jiru waliin teleconsultation argata.",
                "footer.baseline": "AI tajaajila kunuunsaa keessatti, Afrikaa irraa Afrikaa dhaaf.",
                "footer.liens": "Geessituulee fayyadamoo",
                "footer.mentions": "Beeffamoota seeraa",
                "footer.confidentialite": "Imaammata Dhuunfaa",
                "footer.partenaires": "Mishktota",
                "footer.contact": "Quunnamtii",
                "footer.suivez": "Nu hordofaa",
                "map.partner": "Mishkta SynergyAI",
                "map.dispenser": "Raabsaa walqabate",
                "map.teleconsult": "Teleconsultation ni argama",
                "map.doctors": "Dokturoota online 24/7"
            },
            ff: {
                "header.subtitle": "Ɓernde Hakkille Safaara",
                "nav.parcours": "Laawol",
                "nav.carte": "Kartal",
                "nav.distributeurs": "Senndotooɗo",
                "nav.temoignages": "Seedamiraaɓe",
                "nav.faq": "Ɗaɗe",
                "btn.espace_pro": "Nokku Golloowo",
                "hero.tag": "E Afirik, ngam Afirik",
                "hero.title_part1": "Toppitagol",
                "hero.title_part2": "ɓeydaangol",
                "hero.title_part3": "cellal",
                "hero.title_part4": "keɓotooɗo",
                "hero.subtitle": "SynergyAI ina hawra hakkille ƴoƴɗo, daande e senndotooɗe jokkondirɗe ngam rokkude toppitagol moƴƴol, haa e nokkuuje woɗɗuɗe.",
                "btn.decouvrir": "Yiytu laawol ngol",
                "btn.voir_carte": "Yiy kartal",
                "hero.vocal": "Anndinde daande",
                "hero.securite": "Kisal HDS",
                "hero.iot": "Senndotooɗo IoT",
                "dashboard.title": "SynergyAI · Tablo",
                "dashboard.roles": "Nyawɓe-Doktooruuji-Njuɓɓudi",
                "dashboard.slogan": "Yiytu darnde maa e hoolaare",
                "dashboard.symptoms": "Maande ɓanndu ɓurnde heewde:",
                "dashboard.level": "Tolno hesɗitinaaɗo · Reentaade",
                "dashboard.tele": "Telemedicine ina wooda",
                "dashboard.partners": "1000+",
                "dashboard.partners_desc": "Sehilaaɓe ɓadiiɗo",
                "dashboard.nearest": "Yiytu",
                "dashboard.nearest_desc": "Caggal cellal ɓurɗo ɓadude",
                "parcours.surtitre": "Golle mawɗe",
                "parcours.titre": "Laawol toppitagol maa,<br>fello e fello",
                "parcours.sous_titre": "Huutoraade weeɓɗo, daande ardii e AI kisnaa.",
                "etape1.titre": "Jaɓɓaade & suɓol ɗemngal",
                "etape1.texte": "Mbaadi weeɓɗo e natal kuuɓtodinɗo. Suɓol hakkunde <strong>Farayse, Engele, Swahili, Wolof, Darija</strong> e ko ɓeydaa. Jaɓɓagol law.",
                "etape2.titre": "Moofugol maande ɓanndu",
                "etape2.texte": "Fomu weeɓɗo <strong>+ cuɓol daande</strong>. Nyawɗo oo ina waawi siftinde maande mum e hunuko. AI ina winnda e yuɓɓinde keɓe.",
                "etape2.badge": "Anndinde daande",
                "etape3.titre": "Ƴeewndo AI & kisal",
                "etape3.texte": "Algorismu jokkondirɗo maande ɓanndu e defte safaara, yiytude banngeeji boɗeeji e ko haɗaa.",
                "etape3.badge": "Laawol HDS",
                "etape4.titre": "Kuulal: wasiyaaji walla jeertol",
                "etape4.texte": "<strong>Haala weeɓɗo:</strong> wasiyaaji + senndinde. <strong>Haala baasal:</strong> jeertol law + ardaade.",
                "etape4.simple": "Haala weeɓɗo",
                "etape4.risque": "Haala baasal",
                "etape5.titre": "Senndinde toppitaande",
                "etape5.texte": "Lekkiiji ndokkaama e laawol <strong>senndotooɗe jokkondirɗe</strong>. Doos e keewal reentaa e sahaa gooto.",
                "etape5.badge": "Senndotooɗo IoT",
                "etape6.titre": "Reentaade keeriiɗo",
                "etape6.texte": "Wasiyaaji caggal toppitagol, <strong>jeertooji ƴettugol</strong>, ɓeydugol otomatik so moƴƴere alaa.",
                "etape6.badge": "Jeertooji & ɓeydugol",
                "carte.surtitre": "Yiytude nokku",
                "carte.titre": "Yiytu nokku cellal<br>wallah senndotooɗo ɓadiiɗo",
                "carte.sous_titre": "Kartal men jokkondirngal ina hollita nokkuuje sehilaaɓe e senndotooɗe jokkondirɗe.",
                "carte.legende": "Maanaa",
                "carte.legende1": "Nokkuuje cellal sehilaaɓe",
                "carte.legende2": "Senndotooɗe lekkiiji",
                "carte.legende3": "Teleconsultations ina ngoodi",
                "carte.stats": "Limlebbi",
                "carte.stat1": "Nokkuuje cellal",
                "carte.stat2": "Senndotooɗe IoT",
                "carte.stat3": "Udditgol: <strong>leyɗe 12</strong> e Afirik",
                "distributeurs.surtitre": "Senndotooɗe Jokkondirɗe",
                "distributeurs.titre": "Lekkiiji keɓotooɗi,<br>haa woɗɗi e farmasii",
                "distributeurs.sous_titre": "Senndotooɗe men IoT ina kisna, reentoo e toppitaa e woɗɗitagol.",
                "distrib1.titre": "Anndineede kisnaa",
                "distrib1.texte": "Kod keeriiɗo, ƴoƴre junngo wallah karte cellal ngam udditde senndotooɗo.",
                "distrib2.titre": "Doos toppitaaɗo",
                "distrib2.texte": "Senndotooɗo oo ina rokka keewal laaɓtungal winndaangal. Reentaade timmuɗo.",
                "distrib3.titre": "Jokkondirɗo e sahaa gooto",
                "distrib3.texte": "Defte, jeertooji defte e ciimɗi neldama otomatik to nokku cellal.",
                "temoignages.surtitre": "Seedamiraaɓe",
                "temoignages.titre": "Ɓe njokki e amen",
                "temoignage1.texte": "\"SynergyAI wallii amen ustaade sahaa ɗaɓɓude e 40% e nder suudu safaara men wuro. Anndinde daande ko nafoore mawnde.\"",
                "temoignage2.texte": "\"Senndotooɗo otomatik hisni ñalnde heen e sahaa ndiyam. Nyawɓe keɓii lekkiiji mum'en tawa njahaama km 30.\"",
                "temoignage3.texte": "\"Mbaadi ndii ina weeɓi haa mawna am debbo ina huutoroo. Suɓol Wolof waylii kala huunde e makko.\"",
                "faq.surtitre": "Ɗaɗe",
                "faq.titre": "Ɗaɗe ɗe keewi naamneede",
                "faq.q1": "No anndinde daande gollortoo?",
                "faq.r1": "Nyawɗo oo ina haala e nder mikrofoŋ telefoŋ mum. AI amen ina winnda e ƴeewnda maande ɓanndu e sahaa gooto, e ɗemɗe keewɗe Afirik.",
                "faq.q2": "Senndotooɗe ɗee kisnaa naa?",
                "faq.r2": "Oho, senndotooɗo kala ina waɗi njuɓɓudi anndineede semmbiɗndi e suturo AES-256. Defte reentaa e woɗɗitagol.",
                "faq.q3": "Hol ko waɗata so haala am hiisetee ko e baasal?",
                "faq.r3": "Jeertol neldama law to nokku cellal ɓurɗo ɓadude. A heɓata kadi wasiyaaji teleconsultation e doktoor gonɗo.",
                "footer.baseline": "AI e golle toppitagol, e Afirik ngam Afirik.",
                "footer.liens": "Jokkuɗe nafooje",
                "footer.mentions": "Teskeeji sariya",
                "footer.confidentialite": "Suturo",
                "footer.partenaires": "Sehilaaɓe",
                "footer.contact": "Jokkondiral",
                "footer.suivez": "Tokkide amen",
                "map.partner": "Sehil SynergyAI",
                "map.dispenser": "Senndotooɗo jokkondirɗo",
                "map.teleconsult": "Teleconsultation ina wooda",
                "map.doctors": "Doktooruuji e enternet 24/7"
            },
            zu: {
                "header.subtitle": "Ubuhlakani Bezokwelapha",
                "nav.parcours": "Uhambo",
                "nav.carte": "Imephu",
                "nav.distributeurs": "Abasabalalisi",
                "nav.temoignages": "Ubufakazi",
                "nav.faq": "Imibuzo",
                "btn.espace_pro": "Indawo Yobuchwepheshe",
                "hero.tag": "Nge-Afrika, ngenxa ye-Afrika",
                "hero.title_part1": "Ukunakekelwa",
                "hero.title_part2": "okuthuthukisiwe",
                "hero.title_part3": "impilo",
                "hero.title_part4": "efinyelelekayo",
                "hero.subtitle": "I-SynergyAI ihlanganisa ubuhlakani bokufakelwa, izwi nabasabalalisi abaxhunyiwe ukunikeza ukunakekelwa okuyikhwalithi, ngisho nasezindaweni ezikude.",
                "btn.decouvrir": "Thola uhambo",
                "btn.voir_carte": "Buka imephu",
                "hero.vocal": "Ukuqashelwa kwezwi",
                "hero.securite": "Ukuphepha kwe-HDS",
                "hero.iot": "Abasabalalisi be-IoT",
                "dashboard.title": "I-SynergyAI · Ideshibhodi",
                "dashboard.roles": "Iziguli-Odokotela-Abaphathi",
                "dashboard.slogan": "Thola indima yakho ngokuzethemba",
                "dashboard.symptoms": "Izimpawu ezivamile:",
                "dashboard.level": "Ileveli ebuyekeziwe · Ukuqapha",
                "dashboard.tele": "I-telemedicine iyatholakala",
                "dashboard.partners": "1000+",
                "dashboard.partners_desc": "Abalingani abaseduze",
                "dashboard.nearest": "Thola",
                "dashboard.nearest_desc": "Isikhungo sezempilo esiseduze",
                "parcours.surtitre": "Indlela esebenza ngayo",
                "parcours.titre": "Uhambo lwakho lokunakekelwa,<br>ngesinyathelo ngesinyathelo",
                "parcours.sous_titre": "Ukuqala okulula, okuqondiswa yizwi futhi kuvikelwe yi-AI.",
                "etape1.titre": "Ukwamukelwa & ukukhetha ulimi",
                "etape1.texte": "Isikhombimsebenzisi esilula esinezithombe zomhlaba wonke. Ukukhetha phakathi <strong>kwesiFulentshi, isiNgisi, isiSwahili, isiWolof, isiDarija</strong> nokunye. Ukuzivumelanisa ngokushesha.",
                "etape2.titre": "Ukuqoqwa kwezimpawu",
                "etape2.texte": "Ifomu elinembile <strong>+ inketho yezwi</strong>. Isiguli singachaza izimpawu ngomlomo. I-AI ibhala phansi futhi ihlele idatha.",
                "etape2.badge": "Ukuqashelwa kwezwi",
                "etape3.titre": "Ukuhlaziywa kwe-AI nokuphepha",
                "etape3.texte": "I-algorithm ehlanganisa izimpawu nesizindalwazi sezokwelapha, ukutholwa kwamafulegi abomvu nokuphikisana.",
                "etape3.badge": "Iphrothokholi ye-HDS",
                "etape4.titre": "Isinqumo: iseluleko noma isexwayiso",
                "etape4.texte": "<strong>Icala elilula:</strong> iseluleko + ukusabalalisa. <strong>Icala eliyingozi:</strong> isexwayiso esisheshayo + ukudluliselwa.",
                "etape4.simple": "Icala elilula",
                "etape4.risque": "Icala eliyingozi",
                "etape5.titre": "Ukusabalalisa okulawulwayo",
                "etape5.texte": "Imithi elethulwa ngokusebenzisa <strong>abasabalalisi abaxhunyiwe</strong>. Umthamo nenani kulandelelwa ngesikhathi sangempela.",
                "etape5.badge": "Umsabalalisi we-IoT",
                "etape6.titre": "Ukulandelela okuqondene nawe",
                "etape6.texte": "Izincomo zangemva kokunakekelwa, <strong>izikhumbuzo zokuphuza</strong>, ukukhuphuka okuzenzakalelayo uma kungenziwa ngcono.",
                "etape6.badge": "Izikhumbuzo nokukhuphuka",
                "carte.surtitre": "Ukutholwa kwendawo",
                "carte.titre": "Thola isikhungo sezempilo<br>noma umsabalalisi oseduze",
                "carte.sous_titre": "Imephu yethu esebenzayo ibhekisela ezikhungweni ezingabalingani nabasabalalisi abaxhunyiwe.",
                "carte.legende": "Inkulumo",
                "carte.legende1": "Izikhungo zezempilo ezingabalingani",
                "carte.legende2": "Abasabalalisi bemithi",
                "carte.legende3": "I-teleconsultations iyatholakala",
                "carte.stats": "Izibalo",
                "carte.stat1": "Izikhungo zezempilo",
                "carte.stat2": "Abasabalalisi be-IoT",
                "carte.stat3": "Ukumbozwa: <strong>amazwe ayi-12</strong> e-Afrika",
                "distributeurs.surtitre": "Abasabalalisi Abaxhunyiwe",
                "distributeurs.titre": "Imithi efinyelelekayo,<br>ngisho nakude nasemakhemisi",
                "distributeurs.sous_titre": "Abasabalalisi bethu be-IoT baqinisekisa ukusabalalisa okuvikelekile, okulandelelekayo nokulawulwa kude.",
                "distrib1.titre": "Ukuqinisekiswa okuvikelekile",
                "distrib1.texte": "Ikhodi eyingqayizivele, izigxivizo zeminwe noma ikhadi lezempilo ukuvula umsabalalisi.",
                "distrib2.titre": "Umthamo olawulwayo",
                "distrib2.texte": "Umsabalalisi uletha inani eliqondile elimisiwe. Ukulandeleleka okuphelele.",
                "distrib3.titre": "Kuxhunyiwe ngesikhathi sangempela",
                "distrib3.texte": "Uhlu lwempahla, izexwayiso zesitoko nemibiko kudluliselwa ngokuzenzakalelayo esikhungweni sezempilo.",
                "temoignages.surtitre": "Ubufakazi",
                "temoignages.titre": "Basethembe thina",
                "temoignage1.texte": "\"I-SynergyAI isivumele ukuthi sinciphise isikhathi sokulinda ngama-40% emtholampilo wethu wasemaphandleni. Ukuqashelwa kwezwi kuyinzuzo enkulu.\"",
                "temoignage2.texte": "\"Umsabalalisi ozenzakalelayo usize kakhulu ngenkathi yezimvula. Iziguli zikwazile ukuthola imithi yazo ngaphandle kokuhamba amakhilomitha angama-30.\"",
                "temoignage3.texte": "\"Isikhombimsebenzisi silula kangangokuthi nogogo wami uyasisebenzisa. Ukukhetha isiWolof kushintshe konke kuye.\"",
                "faq.surtitre": "Imibuzo",
                "faq.titre": "Imibuzo evame ukubuzwa",
                "faq.q1": "Ukuqashelwa kwezwi kusebenza kanjani?",
                "faq.r1": "Isiguli sikhuluma kumakrofoni yefoni yaso. I-AI yethu ibhala phansi futhi ihlaziye izimpawu ngesikhathi sangempela, ngezilimi eziningana zase-Afrika.",
                "faq.q2": "Ngabe abasabalalisi bavikelekile?",
                "faq.r2": "Yebo, umsabalalisi ngamunye ufakwe uhlelo oluqinile lokuqinisekisa kanye nokubhala ngekhodi okungu-AES-256. Izitoko ziqashwa kude.",
                "faq.q3": "Kwenzakalani uma icala lami lithathwa njengeliyingozi?",
                "faq.r3": "Isexwayiso sithunyelwa ngokushesha esikhungweni sezempilo esiseduze. Uzophinde uthole isiphakamiso se-teleconsultation nodokotela otholakalayo.",
                "footer.baseline": "I-AI emsebenzini wokunakekelwa, nge-Afrika ngenxa ye-Afrika.",
                "footer.liens": "Izixhumanisi eziwusizo",
                "footer.mentions": "Izaziso zomthetho",
                "footer.confidentialite": "Inqubomgomo Yobumfihlo",
                "footer.partenaires": "Abalingani",
                "footer.contact": "Ukuxhumana",
                "footer.suivez": "Silandele",
                "map.partner": "Umlingani we-SynergyAI",
                "map.dispenser": "Umsabalalisi oxhunyiwe",
                "map.teleconsult": "I-teleconsultation iyatholakala",
                "map.doctors": "Odokotela abaku-inthanethi 24/7"
            },
            sn: {
                "header.subtitle": "Hungwaru Hwekurapa",
                "nav.parcours": "Rwendo",
                "nav.carte": "Mepu",
                "nav.distributeurs": "Vagoveri",
                "nav.temoignages": "Uchapupu",
                "nav.faq": "Mibvunzo",
                "btn.espace_pro": "Nzvimbo yeNyanzvi",
                "hero.tag": "NeAfrica, nokuda kweAfrica",
                "hero.title_part1": "Kuchengetwa",
                "hero.title_part2": "kwakavandudzwa",
                "hero.title_part3": "utano",
                "hero.title_part4": "hunosvikika",
                "hero.subtitle": "SynergyAI inobatanidza hungwaru hwekugadzira, izwi uye vagoveri vakabatanidzwa kupa kuchengetwa kwemhando yepamusoro, kunyangwe munzvimbo dziri kure.",
                "btn.decouvrir": "Tsvaga rwendo",
                "btn.voir_carte": "Ona mepu",
                "hero.vocal": "Kuzivikanwa kwezwi",
                "hero.securite": "Kuchengetedzwa kweHDS",
                "hero.iot": "Vagoveri veIoT",
                "dashboard.title": "SynergyAI · Dashboard",
                "dashboard.roles": "Varwere-Vanachiremba-Vatungamiriri",
                "dashboard.slogan": "Tsvaga basa rako nechivimbo",
                "dashboard.symptoms": "Zviratidzo zvakajairika:",
                "dashboard.level": "Danho rakavandudzwa · Kutarisisa",
                "dashboard.tele": "Telemedicine inowanikwa",
                "dashboard.partners": "1000+",
                "dashboard.partners_desc": "Vadyidzani vari pedyo",
                "dashboard.nearest": "Tsvaga",
                "dashboard.nearest_desc": "Nzvimbo yehutano iri pedyo",
                "parcours.surtitre": "Mashandiro ayo",
                "parcours.titre": "Rwendo rwako rwekuchengetwa,<br>nhanho nhanho",
                "parcours.sous_titre": "Kutanga kuri nyore, kunotungamirirwa nezwi uye kwakachengetedzwa neAI.",
                "etape1.titre": "Kugamuchirwa & kusarudza mutauro",
                "etape1.texte": "Chimiro chiri nyore chine mapikicha epasi rese. Kusarudza pakati <strong>pechiFrench, chiRungu, chiSwahili, chiWolof, chiDarija</strong> nezvimwe. Kugadziriswa nekukasika.",
                "etape2.titre": "Kuunganidzwa kwezviratidzo",
                "etape2.texte": "Fomu inonzwisisika <strong>+ sarudzo yezwi</strong>. Murwere anogona kutsanangura zviratidzo nemuromo. AI inonyora pasi nekuronga data.",
                "etape2.badge": "Kuzivikanwa kwezwi",
                "etape3.titre": "Kuongororwa kweAI & kuchengetedzwa",
                "etape3.texte": "Algorithm inobatanidza zviratidzo nedhatabhesi yezvekurapa, kuonekwa kwemafiregi matsvuku uye zvinopesana.",
                "etape3.badge": "Protocol yeHDS",
                "etape4.titre": "Sarudzo: zano kana yambiro",
                "etape4.texte": "<strong>Nyaya iri nyore:</strong> mazano + kugovera. <strong>Nyaya ine njodzi:</strong> yambiro nekukasika + kuendeswa.",
                "etape4.simple": "Nyaya iri nyore",
                "etape4.risque": "Nyaya ine njodzi",
                "etape5.titre": "Kugovera kunodzorwa",
                "etape5.texte": "Mishonga inopihwa kuburikidza <strong>nevagoveri vakabatanidzwa</strong>. Dhosi nehuwandu zvinoteedzerwa panguva chaiyo.",
                "etape5.badge": "Mugoveri weIoT",
                "etape6.titre": "Kutevera kwemunhu oga",
                "etape6.texte": "Mazano epashure pekuchengetwa, <strong>zviyeuchidzo zvekutora</strong>, kukwidziridzwa otomatiki kana pasina kuvandudzika.",
                "etape6.badge": "Zviyeuchidzo & kukwidziridzwa",
                "carte.surtitre": "Kutsvaga Nzvimbo",
                "carte.titre": "Tsvaga nzvimbo yehutano<br>kana mugoveri ari pedyo",
                "carte.sous_titre": "Mepu yedu inoshanda inoratidza nzvimbo dzevadyidzani nevagoveri vakabatanidzwa.",
                "carte.legende": "Tsanangudzo",
                "carte.legende1": "Nzvimbo dzehutano dzevadyidzani",
                "carte.legende2": "Vagoveri vemishonga",
                "carte.legende3": "Teleconsultations dzinowanikwa",
                "carte.stats": "Nhamba",
                "carte.stat1": "Nzvimbo dzehutano",
                "carte.stat2": "Vagoveri veIoT",
                "carte.stat3": "Kufukidzwa: <strong>nyika gumi nembiri</strong> muAfrica",
                "distributeurs.surtitre": "Vagoveri Vakabatanidzwa",
                "distributeurs.titre": "Mishonga inosvikika,<br>kunyangwe kure nemafamasi",
                "distributeurs.sous_titre": "Vagoveri vedu veIoT vanovimbisa kugovera kwakachengetedzwa, kunoteedzerwa uye kunodzorwa kure.",
                "distrib1.titre": "Kusimbiswa kwakachengetedzwa",
                "distrib1.texte": "Kodhi yakasiyana, zvigunwe kana kadhi rehutano kuvhura mugoveri.",
                "distrib2.titre": "Dhosi inodzorwa",
                "distrib2.texte": "Mugoveri anopa huwandu chaihwo hwakatemerwa. Kuteedzerwa kwakazara.",
                "distrib3.titre": "Yakabatanidzwa panguva chaiyo",
                "distrib3.texte": "Inventory, yambiro dzemasitoko uye mishumo inotumirwa otomatiki kunzvimbo yehutano.",
                "temoignages.surtitre": "Uchapupu",
                "temoignages.titre": "Vanovimba nesu",
                "temoignage1.texte": "\"SynergyAI yakatibvumira kuderedza nguva yekumirira ne40% mukiriniki yedu yekumaruwa. Kuzivikanwa kwezwi ibatsiro huru.\"",
                "temoignage2.texte": "\"Mugoveri otomatiki akaponesa panguva yemvura. Varwere vakakwanisa kuwana mishonga yavo vasina kufamba makiromita makumi matatu.\"",
                "temoignage3.texte": "\"Chimiro chacho chiri nyore zvekuti nambuya vangu vanoshandisa. Kusarudza chiWolof kwakachinja zvese kwavari.\"",
                "faq.surtitre": "Mibvunzo",
                "faq.titre": "Mibvunzo inowanzo bvunzwa",
                "faq.q1": "Kuzivikanwa kwezwi kunoshanda sei?",
                "faq.r1": "Murwere anotaura mumakrofoni yefoni yake. AI yedu inonyora pasi nekuongorora zviratidzo panguva chaiyo, mumitauro yakawanda yemuAfrica.",
                "faq.q2": "Vagoveri vakachengetedzeka here?",
                "faq.r2": "Hongu, mugoveri wega wega une hurongwa hwakasimba hwekusimbisa uye encryption yeAES-256. Masitoko anotariswa kure.",
                "faq.q3": "Chii chinoitika kana nyaya yangu ikanzi ine njodzi?",
                "faq.r3": "Yambiro inotumirwa nekukasika kunzvimbo yehutano iri pedyo. Uchawanawo zano reteleconsultation nachiremba aripo.",
                "footer.baseline": "AI mushandi wekuchengetwa, neAfrica nokuda kweAfrica.",
                "footer.liens": "Zvinongedzo zvinobatsira",
                "footer.mentions": "Zviziviso zvepamutemo",
                "footer.confidentialite": "Mutemo Wekuvanzika",
                "footer.partenaires": "Vadyidzani",
                "footer.contact": "Kubata nesu",
                "footer.suivez": "Titevere",
                "map.partner": "Mudyidzani weSynergyAI",
                "map.dispenser": "Mugoveri akabatanidzwa",
                "map.teleconsult": "Teleconsultation inowanikwa",
                "map.doctors": "Vanachiremba vari online 24/7"
            },
            ar: {
                "header.subtitle": "الذكاء الطبي",
                "nav.parcours": "المسار",
                "nav.carte": "الخريطة",
                "nav.distributeurs": "الموزعون",
                "nav.temoignages": "الشهادات",
                "nav.faq": "الأسئلة",
                "btn.espace_pro": "الفضاء المهني",
                "hero.tag": "من أفريقيا، لأجل أفريقيا",
                "hero.title_part1": "رعاية",
                "hero.title_part2": "مُعزَّزة",
                "hero.title_part3": "صحة",
                "hero.title_part4": "مُتاحة",
                "hero.subtitle": "تجمع SynergyAI بين الذكاء الاصطناعي والصوت والموزعين المتصلين لتقديم رعاية عالية الجودة، حتى في المناطق النائية.",
                "btn.decouvrir": "اكتشف المسار",
                "btn.voir_carte": "عرض الخريطة",
                "hero.vocal": "التعرف على الصوت",
                "hero.securite": "أمان HDS",
                "hero.iot": "موزعو إنترنت الأشياء",
                "dashboard.title": "SynergyAI · لوحة القيادة",
                "dashboard.roles": "المرضى-الأطباء-المسؤولون",
                "dashboard.slogan": "اعثر على دورك بكل ثقة",
                "dashboard.symptoms": "الأعراض الشائعة:",
                "dashboard.level": "المستوى المحدث · المراقبة",
                "dashboard.tele": "التطبيب عن بعد متاح",
                "dashboard.partners": "+1000",
                "dashboard.partners_desc": "شركاء قريبون",
                "dashboard.nearest": "ابحث",
                "dashboard.nearest_desc": "أقرب مركز صحي",
                "parcours.surtitre": "كيف يعمل",
                "parcours.titre": "مسار رعايتك،<br>خطوة بخطوة",
                "parcours.sous_titre": "بداية سهلة، موجهة بالصوت ومؤمنة بالذكاء الاصطناعي.",
                "etape1.titre": "الترحيب واختيار اللغة",
                "etape1.texte": "واجهة بسيطة مع صور توضيحية عالمية. الاختيار بين <strong>الفرنسية، الإنجليزية، السواحيلية، الولوفية، الدارجة</strong> والمزيد. تكيف فوري.",
                "etape2.titre": "جمع الأعراض",
                "etape2.texte": "نموذج بديهي <strong>+ خيار الصوت</strong>. يمكن للمريض وصف أعراضه شفوياً. الذكاء الاصطناعي ينسخ البيانات وينظمها.",
                "etape2.badge": "التعرف على الصوت",
                "etape3.titre": "تحليل الذكاء الاصطناعي والأمان",
                "etape3.texte": "خوارزمية تربط الأعراض بقاعدة بيانات طبية، وكشف العلامات الحمراء وموانع الاستعمال.",
                "etape3.badge": "بروتوكول HDS",
                "etape4.titre": "القرار: نصيحة أو تنبيه",
                "etape4.texte": "<strong>حالة بسيطة:</strong> نصائح + صرف. <strong>حالة خطرة:</strong> تنبيه فوري + توجيه.",
                "etape4.simple": "حالة بسيطة",
                "etape4.risque": "حالة خطرة",
                "etape5.titre": "صرف مضبوط",
                "etape5.texte": "الأدوية تُصرف عبر <strong>موزعين متصلين</strong>. الجرعة والكمية متتبعة في الوقت الفعلي.",
                "etape5.badge": "موزع IoT",
                "etape6.titre": "متابعة شخصية",
                "etape6.texte": "توصيات ما بعد الرعاية، <strong>تذكيرات بأخذ الدواء</strong>، تصعيد تلقائي إذا لم يحدث تحسن.",
                "etape6.badge": "تذكيرات وتصعيد",
                "carte.surtitre": "تحديد الموقع",
                "carte.titre": "اعثر على مركز صحي<br>أو موزع قريب",
                "carte.sous_titre": "خريطتنا التفاعلية تشير إلى المؤسسات الشريكة والموزعين المتصلين.",
                "carte.legende": "وسيلة الإيضاح",
                "carte.legende1": "المراكز الصحية الشريكة",
                "carte.legende2": "موزعو الأدوية",
                "carte.legende3": "الاستشارات عن بعد متاحة",
                "carte.stats": "إحصائيات",
                "carte.stat1": "المراكز الصحية",
                "carte.stat2": "موزعو IoT",
                "carte.stat3": "التغطية: <strong>12 دولة</strong> في أفريقيا",
                "distributeurs.surtitre": "الموزعون المتصلون",
                "distributeurs.titre": "أدوية متاحة،<br>حتى بعيداً عن الصيدليات",
                "distributeurs.sous_titre": "موزعونا المتصلون يضمنون صرفاً آمناً ومتتبعاً ومراقباً عن بعد.",
                "distrib1.titre": "مصادقة آمنة",
                "distrib1.texte": "رمز فريد أو بصمة إصبع أو بطاقة صحية لفتح الموزع.",
                "distrib2.titre": "جرعة مضبوطة",
                "distrib2.texte": "الموزع يصرف الكمية المحددة بالوصفة الطبية. تتبع كامل.",
                "distrib3.titre": "متصل في الوقت الفعلي",
                "distrib3.texte": "المخزون وتنبيهات المخزون والتقارير ترسل تلقائياً إلى المركز الصحي.",
                "temoignages.surtitre": "شهادات",
                "temoignages.titre": "إنهم يثقون بنا",
                "temoignage1.texte": "\"سمحت لنا SynergyAI بتقليل وقت الانتظار بنسبة 40% في مستوصفنا الريفي. التعرف على الصوت ميزة رائعة.\"",
                "temoignage2.texte": "\"أنقذ الموزع الآلي الموقف خلال موسم الأمطار. تمكن المرضى من تلقي أدويتهم دون قطع مسافة 30 كم.\"",
                "temoignage3.texte": "\"الواجهة بسيطة لدرجة أن جدتي تستخدمها. اختيار الولوفية غيّر كل شيء بالنسبة لها.\"",
                "faq.surtitre": "الأسئلة",
                "faq.titre": "الأسئلة المتكررة",
                "faq.q1": "كيف يعمل التعرف على الصوت؟",
                "faq.r1": "يتحدث المريض في ميكروفون هاتفه. الذكاء الاصطناعي الخاص بنا ينسخ ويحلل الأعراض في الوقت الفعلي، بعدة لغات أفريقية.",
                "faq.q2": "هل الموزعون آمنون؟",
                "faq.r2": "نعم، كل موزع مجهز بنظام مصادقة قوي وتشفير AES-256. تتم مراقبة المخزون عن بعد.",
                "faq.q3": "ماذا يحدث إذا تم اعتبار حالتي خطرة؟",
                "faq.r3": "يتم إرسال تنبيه فوراً إلى أقرب مركز صحي. ستتلقى أيضاً اقتراحاً لاستشارة عن بعد مع طبيب متاح.",
                "footer.baseline": "الذكاء الاصطناعي في خدمة الرعاية، من أفريقيا لأجل أفريقيا.",
                "footer.liens": "روابط مفيدة",
                "footer.mentions": "إشعارات قانونية",
                "footer.confidentialite": "سياسة الخصوصية",
                "footer.partenaires": "الشركاء",
                "footer.contact": "اتصل بنا",
                "footer.suivez": "تابعنا",
                "map.partner": "شريك SynergyAI",
                "map.dispenser": "موزع متصل",
                "map.teleconsult": "استشارة عن بعد متاحة",
                "map.doctors": "أطباء متصلون 24/7"
            }
        };

        function getCurrentLang() {
            return localStorage.getItem('synergyLang') || 'fr';
        }

        function setCurrentLang(lang) {
            localStorage.setItem('synergyLang', lang);
            applyTranslations(lang);
            updateLangSwitcherUI(lang);
            document.documentElement.lang = lang;
        }

        function applyTranslations(lang) {
            const dict = translations[lang] || translations['en'] || {};
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.getAttribute('data-i18n');
                if (dict[key] !== undefined) {
                    el.innerHTML = dict[key];
                } else if (translations['en'] && translations['en'][key] !== undefined) {
                    el.innerHTML = translations['en'][key];
                }
            });
            document.getElementById('currentLang').textContent = lang.toUpperCase();
            // Mettre à jour les popups de la carte
            updateMapPopups(lang);
        }

        function updateMapPopups(lang) {
            const dict = translations[lang] || translations['en'] || {};
            map.eachLayer(layer => {
                if (layer instanceof L.CircleMarker && layer.getPopup()) {
                    const popup = layer.getPopup();
                    const content = popup.getContent();
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = content;
                    tempDiv.querySelectorAll('[data-i18n]').forEach(span => {
                        const key = span.getAttribute('data-i18n');
                        if (dict[key]) span.textContent = dict[key];
                        else if (translations['en'] && translations['en'][key]) span.textContent =
                            translations['en'][key];
                    });
                    popup.setContent(tempDiv.innerHTML);
                }
            });
        }

        function updateLangSwitcherUI(lang) {
            document.querySelectorAll('.lang-option').forEach(opt => {
                opt.classList.toggle('active', opt.getAttribute('data-lang') === lang);
            });
            document.getElementById('mobileLangSelect').value = lang;
        }

        // Construire dropdown desktop et mobile
        const langDropdown = document.getElementById('langDropdown');
        const mobileLangSelect = document.getElementById('mobileLangSelect');
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

            const mobileOption = document.createElement('option');
            mobileOption.value = l.code;
            mobileOption.textContent = `${l.flag} ${l.name}`;
            mobileLangSelect.appendChild(mobileOption);
        });

        document.getElementById('langButton').addEventListener('click', (e) => {
            e.stopPropagation();
            langDropdown.classList.toggle('show');
        });
        window.addEventListener('click', () => langDropdown.classList.remove('show'));

        mobileLangSelect.addEventListener('change', (e) => setCurrentLang(e.target.value));

        // Initialiser la langue au chargement
        const savedLang = getCurrentLang();
        setCurrentLang(savedLang);
    </script>
</body>
</html>