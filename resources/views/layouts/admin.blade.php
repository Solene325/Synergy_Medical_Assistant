{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration · SynergyAI')</title>

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
                        'glow-primary': '0 0 40px rgba(10, 74, 59, 0.12)',
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

        /* Glass morphism */
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

        /* Sidebar admin (inspirée du patient) */
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

        /* Inputs et boutons (identiques à patient) */
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
        .btn-accent {
            background: linear-gradient(135deg, var(--accent), #c46a37);
            color: white;
        }
        .btn-accent:hover {
            box-shadow: 0 12px 28px -6px rgba(217,119,66,0.4);
        }
        .btn-outline-danger {
            border: 1px solid #e53e3e;
            color: #e53e3e;
            border-radius: 40px;
            padding: 6px 16px;
            transition: all 0.2s;
            background: rgba(255,255,255,0.5);
        }
        .btn-outline-danger:hover {
            background: #e53e3e;
            color: white;
        }

        /* Lang dropdown */
        .lang-dropdown {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 1.25rem;
            box-shadow: 0 16px 40px -8px rgba(10,74,59,0.12);
            padding: 0.5rem;
            min-width: 180px;
            display: none;
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

        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 10px; }

        /* Badge notification */
        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 18px;
            height: 18px;
            background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
            border-radius: 50%;
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10px;
            font-weight: 700;
        }

        /* Effet glow sur les cartes stats */
        .stat-card-glow {
            box-shadow: 0 8px 32px -8px rgba(10, 74, 59, 0.08), 0 0 0 1px rgba(255,255,255,0.5);
            transition: all 0.3s ease;
        }
        .stat-card-glow:hover {
            box-shadow: 0 16px 48px -12px rgba(10, 74, 59, 0.15), 0 0 30px rgba(217, 119, 66, 0.08);
            transform: translateY(-4px);
        }

        /* Table stylée */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th {
            text-align: left;
            padding: 12px 8px;
            font-weight: 600;
            color: var(--primary);
            border-bottom: 1px solid rgba(10,74,59,0.08);
        }
        .data-table td {
            padding: 12px 8px;
            border-bottom: 1px solid rgba(0,0,0,0.04);
        }
        .data-table tr:hover {
            background: rgba(255,255,255,0.3);
        }

        /* Section title */
        .section-title-soft {
            position: relative;
            display: inline-block;
            padding-bottom: 8px;
        }
        .section-title-soft::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 4px;
            opacity: 0.6;
        }

        /* Responsive sidebar mobile */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 40;
                width: 260px;
            }
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.15);
                backdrop-filter: blur(4px);
                z-index: 39;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

<div x-data="{
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
        // Vous pouvez déclencher un événement ou recharger la page si nécessaire
    },
    mobileSidebarOpen: false,
    toggleMobileSidebar() {
        this.mobileSidebarOpen = !this.mobileSidebarOpen;
        document.getElementById('sidebar').classList.toggle('mobile-open');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }
}" x-init="() => { document.getElementById('sidebarOverlay').addEventListener('click', () => toggleMobileSidebar()); }">

    <!-- Overlay pour mobile -->
    <div id="sidebarOverlay" class="sidebar-overlay"></div>

    <!-- ========================================= -->
    <!-- SIDEBAR ADMIN                             -->
    <!-- ========================================= -->
    <aside id="sidebar" class="sidebar fixed top-0 left-0 h-full z-30 flex flex-col justify-between py-6 px-3">
        <!-- Logo -->
        <div>
            <div class="flex items-center gap-3 px-2 mb-8">
                <div class="w-10 h-10 bg-white/80 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-sm border border-white/60">
                    <i class="fas fa-shield-alt text-2xl text-primary"></i>
                </div>
                <span class="font-display font-semibold text-primary text-xl whitespace-nowrap opacity-0 transition-opacity sidebar:hover:opacity-100">SynergyAI</span>
            </div>

            <!-- Navigation -->
            <nav class="flex flex-col gap-1.5">
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Tableau de bord</span>
                </a>
                <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Utilisateurs</span>
                </a>
                <a href="{{ route('admin.medicaments') }}" class="nav-item {{ request()->routeIs('admin.medicaments') ? 'active' : '' }}">
                    <i class="fas fa-capsules"></i>
                    <span>Médicaments</span>
                </a>
                <a href="{{ route('admin.device-data') }}" class="nav-item {{ request()->routeIs('admin.device-data') ? 'active' : '' }}">
                    <i class="fas fa-microchip"></i>
                    <span>Appareil tiers</span>
                    <span class="ml-auto text-[10px] bg-yellow-400/30 text-yellow-800 px-2 py-0.5 rounded-full">Bientôt</span>
                </a>
            </nav>
        </div>

        <!-- Footer sidebar : utilisateur + déconnexion -->
        <div class="flex flex-col gap-1.5 px-2 border-t border-white/30 pt-4">
            <div class="flex items-center gap-3 px-2 py-2 rounded-xl hover:bg-white/20 transition">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary to-primary-light text-white flex items-center justify-center font-bold text-sm shadow-md">
                    {{ strtoupper(substr(auth()->user()->prenom ?? 'A', 0, 1)) }}{{ strtoupper(substr(auth()->user()->nom ?? 'D', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-primary truncate">{{ auth()->user()->prenom ?? '' }} {{ auth()->user()->nom ?? '' }}</p>
                    <p class="text-xs text-warm-gray truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
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
    <!-- MAIN CONTENT                             -->
    <!-- ========================================= -->
    <div class="flex-1 ml-[76px] transition-all duration-350 sidebar:hover:ml-[220px] main-content">

        <!-- Header avec sélecteur de langue, notifs, etc. -->
        <header class="sticky top-0 z-20 bg-cream/60 backdrop-blur-xl border-b border-white/40 px-6 py-3 flex items-center justify-between flex-wrap gap-4">
            <!-- Bouton menu mobile -->
            <button @click="toggleMobileSidebar()" class="md:hidden text-2xl text-primary">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Search -->
            <div class="relative flex-1 min-w-[200px] max-w-md">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-warm-gray/40"></i>
                <input type="text" placeholder="Rechercher..." class="input-field pl-10 h-10 text-sm w-full">
            </div>

            <!-- Actions + langue -->
            <div class="flex items-center gap-4">
                <!-- Sélecteur de langue -->
                <div class="relative" @click.away="$refs.langDropdown.classList.remove('show')">
                    <button @click="$refs.langDropdown.classList.toggle('show')" class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/60 backdrop-blur-sm border border-white/50 text-sm text-warm-gray hover:text-primary transition">
                        <span x-text="langs.find(l => l.code === lang)?.flag || '🇫🇷'"></span>
                        <span class="hidden sm:inline" x-text="langs.find(l => l.code === lang)?.name || 'Français'"></span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div x-ref="langDropdown" class="lang-dropdown absolute right-0 mt-2">
                        <template x-for="l in langs" :key="l.code">
                            <div @click="setLang(l.code); $refs.langDropdown.classList.remove('show')" class="lang-option" :class="{ 'active': lang === l.code }">
                                <span x-text="l.flag"></span>
                                <span x-text="l.name"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Notifications -->
                <button class="relative w-10 h-10 rounded-full bg-white/60 backdrop-blur-sm flex items-center justify-center text-warm-gray hover:text-primary transition border border-white/50">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <!-- Messages -->
                <button class="relative w-10 h-10 rounded-full bg-white/60 backdrop-blur-sm flex items-center justify-center text-warm-gray hover:text-primary transition border border-white/50">
                    <i class="fas fa-envelope"></i>
                    <span class="notification-badge">5</span>
                </button>

                <!-- Avatar utilisateur (visible sur desktop) -->
                <div class="hidden sm:flex items-center gap-2 pl-3 border-l border-white/50">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary to-primary-light text-white flex items-center justify-center font-bold text-sm shadow-md">
                        {{ strtoupper(substr(auth()->user()->prenom ?? 'A', 0, 1)) }}{{ strtoupper(substr(auth()->user()->nom ?? 'D', 0, 1)) }}
                    </div>
                    <div class="text-sm leading-tight">
                        <p class="font-semibold text-primary">{{ auth()->user()->prenom ?? '' }} {{ auth()->user()->nom ?? '' }}</p>
                        <p class="text-xs text-warm-gray">Administrateur</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenu principal -->
        <main class="p-6 lg:p-8">
            <!-- Messages flash -->
            @if(session('success'))
                <div class="mb-6 px-5 py-4 rounded-2xl bg-green-100/80 backdrop-blur-sm border-l-4 border-green-500 text-green-800 glass-card">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 px-5 py-4 rounded-2xl bg-red-100/80 backdrop-blur-sm border-l-4 border-red-500 text-red-800 glass-card">
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>

</div>

@stack('scripts')
</body>
</html>