<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SynergyAI')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.0/dist/cdn.min.js"></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#0A4A3B',
                        'primary-light': '#1A6B57',
                        'primary-dark': '#07362B',
                        'accent': '#D97742',
                        'accent-light': '#F0C8A9',
                        'gold': '#C49A3E',
                        'gold-light': '#EAD7A0',
                        'slate': '#2C5A7A',
                        'slate-light': '#7AAAC2',
                        'cream': '#F8F5EF',
                        'sand': '#EDE6D8',
                        'warm-gray': '#6B5F51',
                        'soft-blue': '#E6F0F5',
                        'soft-green': '#E6F4EC',
                        'soft-peach': '#FDF0E8',
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
                        'soft': '0 8px 30px -8px rgba(10, 74, 59, 0.08)',
                        'soft-lg': '0 20px 50px -12px rgba(10, 74, 59, 0.12)',
                        'inner-soft': 'inset 0 2px 8px rgba(255,255,255,0.5)',
                        'glow': '0 0 30px rgba(210, 168, 67, 0.15)',
                    },
                }
            }
        }
    </script>

    <style>
        :root {
            --primary: #0A4A3B;
            --primary-light: #1A6B57;
            --accent: #D97742;
            --gold: #C49A3E;
            --slate: #2C5A7A;
            --cream: #F8F5EF;
            --sand: #EDE6D8;
            --warm-gray: #6B5F51;
        }
        * { scroll-behavior: smooth; }
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--cream);
            color: #3A3A3A;
        }
        h1, h2, h3, h4, .font-display {
            font-family: 'Outfit', sans-serif;
            letter-spacing: -0.02em;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 1.75rem;
            box-shadow: 0 8px 32px -8px rgba(10, 74, 59, 0.06);
            transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 16px 48px -12px rgba(10, 74, 59, 0.12);
            transform: translateY(-2px);
        }

        .sidebar {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.6);
            width: 76px;
            transition: width 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .sidebar:hover { width: 220px; }
        .sidebar .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1rem;
            border-radius: 1.25rem;
            transition: all 0.2s;
            color: var(--warm-gray);
            white-space: nowrap;
            overflow: hidden;
            font-weight: 500;
        }
        .sidebar .nav-item i {
            width: 1.5rem;
            text-align: center;
            font-size: 1.2rem;
        }
        .sidebar .nav-item span {
            opacity: 0;
            transition: opacity 0.25s;
        }
        .sidebar:hover .nav-item span { opacity: 1; }
        .sidebar .nav-item.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            box-shadow: 0 8px 20px -4px rgba(10,74,59,0.3);
        }
        .sidebar .nav-item.active i { color: white; }
        .sidebar .nav-item:not(.active):hover {
            background: rgba(10,74,59,0.06);
            color: var(--primary);
        }

        .input-field {
            background: rgba(255,255,255,0.5);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 2rem;
            padding: 0.6rem 1.2rem;
            outline: none;
            transition: all 0.25s;
            font-size: 0.9rem;
        }
        .input-field:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(217, 119, 66, 0.15);
            background: rgba(255,255,255,0.8);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            border-radius: 3rem;
            padding: 0.6rem 1.8rem;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            box-shadow: 0 6px 18px -4px rgba(10,74,59,0.25);
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px -6px rgba(10,74,59,0.35);
        }

        .stat-card {
            background: rgba(255,255,255,0.5);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 1.5rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px -6px rgba(10,74,59,0.04);
        }
        .stat-card:hover {
            transform: translateY(-4px);
            background: rgba(255,255,255,0.8);
            box-shadow: 0 20px 40px -12px rgba(10,74,59,0.1);
        }

        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 10px; }

        /* Styles pour le sélecteur de langue */
        .lang-dropdown {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 1.25rem;
            box-shadow: 0 16px 40px -8px rgba(10,74,59,0.12);
            padding: 0.5rem;
            min-width: 180px;
            display: none;
            z-index: 9999; /* 🔥 priorité absolue */
        }
        .lang-dropdown.show { display: block; }
        .lang-option {
            padding: 0.4rem 0.8rem;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: background 0.15s;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.9rem;
        }
        .lang-option:hover { background: rgba(10,74,59,0.05); }
        .lang-option.active { background: rgba(10,74,59,0.08); font-weight: 600; }
    </style>
</head>
<body>

    <div class="min-h-screen flex" x-data="{
        lang: localStorage.getItem('synergyLang') || 'fr',
        langs: [
            { code: 'fr', name: 'Français', flag: '🇫🇷' },
            { code: 'en', name: 'English', flag: '🇬🇧' },
            { code: 'pt', name: 'Português', flag: '🇵🇹' },
            { code: 'sw', name: 'Kiswahili', flag: '🇹🇿' },
            { code: 'ha', name: 'Hausa', flag: '🇳🇬' },
            { code: 'yo', name: 'Yorùbá', flag: '🇳🇬' },
            { code: 'ar', name: 'العربية', flag: '🇲🇦' }
        ],
        setLang(code) {
            this.lang = code;
            localStorage.setItem('synergyLang', code);
        }
    }">

        <!-- ========================================= -->
        <!-- SIDEBAR                                   -->
        <!-- ========================================= -->
        <aside class="sidebar fixed top-0 left-0 h-full z-30 flex flex-col justify-between py-6 px-3">
            <div>
                <div class="flex items-center gap-3 px-2 mb-8">
                    <div class="w-10 h-10 bg-white/80 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-sm border border-white/60">
                        <i class="fas fa-heartbeat text-2xl text-primary"></i>
                    </div>
                    <span class="font-display font-semibold text-primary text-xl whitespace-nowrap opacity-0 transition-opacity sidebar:hover:opacity-100">SynergyAI</span>
                </div>

                <nav class="flex flex-col gap-1.5">
                    <a href="{{ route('dashboard.patient') }}" class="nav-item">
                        <i class="fas fa-home"></i>
                        <span>Accueil</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fas fa-calendar-check"></i>
                        <span>Rendez-vous</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fas fa-prescription-bottle"></i>
                        <span>Prescriptions</span>
                    </a>
                    <a href="{{ route('patient.medecins.index') }}" class="nav-item">
                        <i class="fas fa-user-md"></i>
                        <span>Médecins</span>
                    </a>
                    <a href="{{ route('patient.chat') }}" class="nav-item">
                        <i class="fas fa-comment-dots"></i>
                        <span>Chat IA</span>
                    </a>
                    <a href="{{ route('patient.medical-record') }}" class="nav-item active">
                        <i class="fas fa-file-medical-alt"></i>
                        <span>Dossier médical</span>
                    </a>
                </nav>
            </div>

            <div class="flex flex-col gap-1.5 px-2">
                <a href="#" class="nav-item">
                    <i class="fas fa-cog"></i>
                    <span>Paramètres</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-item w-full text-left">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- ========================================= -->
        <!-- CONTENU PRINCIPAL                         -->
        <!-- ========================================= -->
        <div class="flex-1 ml-[76px] transition-all duration-350 sidebar:hover:ml-[220px]">

            <!-- Header -->
            <header class="sticky top-0 z-20 bg-cream/60 backdrop-blur-xl border-b border-white/40 px-6 py-3 flex items-center justify-between flex-wrap gap-4">
                <div class="relative flex-1 min-w-[200px] max-w-md">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-warm-gray/40"></i>
                    <input type="text" placeholder="Rechercher..." class="input-field pl-10 h-10 text-sm">
                </div>

                <div class="flex items-center gap-4">
                    <!-- Sélecteur de langue (corrigé) -->
                    <div class="relative" @click.away="$refs.langDropdown.classList.remove('show')">
                        <button @click="$refs.langDropdown.classList.toggle('show')" class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/60 backdrop-blur-sm border border-white/50 text-sm text-warm-gray hover:text-primary transition cursor-pointer">
                            <span x-text="langs.find(l => l.code === lang)?.flag || '🇫🇷'"></span>
                            <span class="hidden sm:inline" x-text="langs.find(l => l.code === lang)?.name || 'Français'"></span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <!-- Ajout de z-50 pour s'assurer que le dropdown est au-dessus -->
                        <div x-ref="langDropdown" class="lang-dropdown absolute right-0 mt-2 z-50">
                            <template x-for="l in langs" :key="l.code">
                                <div @click="setLang(l.code); $refs.langDropdown.classList.remove('show')" class="lang-option" :class="{ 'active': lang === l.code }">
                                    <span x-text="l.flag"></span>
                                    <span x-text="l.name"></span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <button class="relative w-10 h-10 rounded-full bg-white/60 backdrop-blur-sm flex items-center justify-center text-warm-gray hover:text-primary transition border border-white/50">
                        <i class="fas fa-envelope"></i>
                        <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-accent text-white text-[10px] rounded-full flex items-center justify-center">3</span>
                    </button>
                    <button class="relative w-10 h-10 rounded-full bg-white/60 backdrop-blur-sm flex items-center justify-center text-warm-gray hover:text-primary transition border border-white/50">
                        <i class="fas fa-bell"></i>
                        <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-gold text-white text-[10px] rounded-full flex items-center justify-center">5</span>
                    </button>
                    <div class="flex items-center gap-2 pl-3 border-l border-white/50">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary to-primary-light text-white flex items-center justify-center font-bold text-sm shadow-md">
                            {{ strtoupper(substr(auth()->user()->prenom ?? 'U', 0, 1)) }}{{ strtoupper(substr(auth()->user()->nom ?? '', 0, 1)) }}
                        </div>
                        <div class="hidden sm:block text-sm leading-tight">
                            <p class="font-semibold text-primary">{{ auth()->user()->prenom ?? '' }} {{ auth()->user()->nom ?? '' }}</p>
                            <p class="text-xs text-warm-gray">Patient</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <main class="p-6 lg:p-8">
                @yield('content')
            </main>
        </div>

        <!-- Aucun panneau droit -->
    </div>

    @stack('scripts')
</body>
</html>