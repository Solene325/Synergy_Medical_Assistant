<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SynergyAI · Assistant médical')</title>

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
                        'slate': '#2C5A7A',
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
                        'soft': '0 4px 20px -6px rgba(10, 74, 59, 0.06)',
                        'soft-lg': '0 12px 40px -8px rgba(10, 74, 59, 0.10)',
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
            background: linear-gradient(145deg, #F8F5EF 0%, #EDE6D8 100%);
            color: #3A3A3A;
            min-height: 100vh;
        }
        h1, h2, h3, h4, .font-display {
            font-family: 'Outfit', sans-serif;
            letter-spacing: -0.02em;
        }

        /* Sidebar de navigation */
        .nav-sidebar {
            background: rgba(255,255,255,0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255,255,255,0.5);
            width: 72px;
            transition: width 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 40;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1.5rem 0.5rem;
        }
        .nav-sidebar:hover { width: 210px; }
        .nav-sidebar .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 0.8rem;
            border-radius: 1.25rem;
            transition: all 0.2s;
            color: var(--warm-gray);
            white-space: nowrap;
            overflow: hidden;
            font-weight: 500;
            font-size: 0.9rem;
        }
        .nav-sidebar .nav-item i {
            width: 1.5rem;
            text-align: center;
            font-size: 1.2rem;
        }
        .nav-sidebar .nav-item span {
            opacity: 0;
            transition: opacity 0.25s;
        }
        .nav-sidebar:hover .nav-item span { opacity: 1; }
        .nav-sidebar .nav-item.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            box-shadow: 0 6px 16px -4px rgba(10,74,59,0.25);
        }
        .nav-sidebar .nav-item:not(.active):hover {
            background: rgba(10,74,59,0.05);
            color: var(--primary);
        }

        /* Conteneur principal */
        .main-wrapper {
            margin-left: 72px;
            transition: margin-left 0.3s;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .nav-sidebar:hover ~ .main-wrapper {
            margin-left: 210px;
        }
        /* Pour le cas où on utilise un élément sibling, on gère avec une classe */
        .with-sidebar {
            margin-left: 72px;
            transition: margin-left 0.3s;
        }
        .nav-sidebar:hover + .with-sidebar {
            margin-left: 210px;
        }

        /* Header */
        .chat-header {
            background: rgba(255,255,255,0.3);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.4);
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        /* Cartes glass */
        .glass-card {
            background: rgba(255,255,255,0.5);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 1.75rem;
            box-shadow: 0 4px 24px -6px rgba(10,74,59,0.04);
            transition: all 0.3s ease;
        }
        .glass-card:hover {
            background: rgba(255,255,255,0.7);
            box-shadow: 0 8px 32px -8px rgba(10,74,59,0.08);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            border-radius: 3rem;
            padding: 0.5rem 1.6rem;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            box-shadow: 0 4px 14px -4px rgba(10,74,59,0.2);
            transition: all 0.25s;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px -6px rgba(10,74,59,0.3);
        }

        .input-field {
            background: rgba(255,255,255,0.5);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 2rem;
            padding: 0.5rem 1rem;
            outline: none;
            transition: all 0.2s;
            font-size: 0.9rem;
        }
        .input-field:focus {
            border-color: var(--accent);
            background: rgba(255,255,255,0.8);
            box-shadow: 0 0 0 3px rgba(217,119,66,0.1);
        }

        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 10px; }
    </style>
</head>
<body>

    <div x-data="{ sidebarOpen: false }" class="relative">

        <!-- ========================================= -->
        <!-- SIDEBAR DE NAVIGATION                     -->
        <!-- ========================================= -->
        <aside class="nav-sidebar" @mouseenter="sidebarOpen = true" @mouseleave="sidebarOpen = false">
            <!-- Logo -->
            <div>
                <div class="flex items-center gap-2 px-2 mb-6">
                    <div class="w-9 h-9 bg-white/80 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-sm border border-white/60 flex-shrink-0">
                        <i class="fas fa-heartbeat text-xl text-primary"></i>
                    </div>
                    <span class="font-display font-semibold text-primary text-lg whitespace-nowrap opacity-0 transition-opacity" 
                          :class="{'opacity-100': sidebarOpen}">SynergyAI</span>
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
                    <a href="{{ route('patient.chat') }}" class="nav-item active">
                        <i class="fas fa-comment-medical"></i>
                        <span>Chat IA</span>
                    </a>
                    <a href="{{ route('patient.medical-record') }}" class="nav-item">
                        <i class="fas fa-file-medical-alt"></i>
                        <span>Dossier médical</span>
                    </a>
                </nav>
            </div>

            <!-- Footer -->
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
        <div class="main-wrapper with-sidebar">
            <!-- Header -->
            <header class="chat-header">
                <div class="flex items-center gap-3">
                    <i class="fas fa-stethoscope text-xl text-primary opacity-70"></i>
                    <span class="font-display font-semibold text-primary text-lg hidden sm:inline">Assistant médical</span>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Sélecteur de langue (sera géré dans la vue) -->
                    <div x-data="{ open: false, currentLang: localStorage.getItem('synergyLang') || 'fr',
                                  langs: [
                                      { code: 'fr', name: 'Français', flag: '🇫🇷' },
                                      { code: 'en', name: 'English', flag: '🇬🇧' },
                                      { code: 'pt', name: 'Português', flag: '🇵🇹' },
                                      { code: 'sw', name: 'Kiswahili', flag: '🇹🇿' },
                                      { code: 'ha', name: 'Hausa', flag: '🇳🇬' },
                                      { code: 'yo', name: 'Yorùbá', flag: '🇳🇬' },
                                      { code: 'ig', name: 'Igbo', flag: '🇳🇬' },
                                      { code: 'am', name: 'አማርኛ', flag: '🇪🇹' },
                                      { code: 'ar', name: 'العربية', flag: '🇲🇦' }
                                  ],
                                  setLang(code) {
                                      this.currentLang = code;
                                      localStorage.setItem('synergyLang', code);
                                      this.open = false;
                                      // On transmet l'événement à la vue Alpine enfant si besoin
                                      window.dispatchEvent(new CustomEvent('langChanged', { detail: code }));
                                  }
                               }" @click.away="open = false" class="relative">
                        <button @click="open = !open" class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/50 backdrop-blur-sm border border-white/50 text-sm text-warm-gray hover:text-primary transition">
                            <span x-text="langs.find(l => l.code === currentLang)?.flag || '🇫🇷'"></span>
                            <span class="hidden sm:inline" x-text="langs.find(l => l.code === currentLang)?.name || 'Français'"></span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div x-show="open" x-transition.duration.200ms 
                             class="absolute right-0 mt-2 bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg border border-white/50 p-1 min-w-[160px] z-50">
                            <template x-for="l in langs" :key="l.code">
                                <div @click="setLang(l.code)" class="flex items-center gap-2 px-3 py-1.5 rounded-xl hover:bg-primary/5 cursor-pointer transition" 
                                     :class="{'bg-primary/10': currentLang === l.code}">
                                    <span x-text="l.flag"></span>
                                    <span class="text-sm" x-text="l.name"></span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Profil -->
                    <div class="flex items-center gap-2 pl-3 border-l border-white/40">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-primary-light text-white flex items-center justify-center font-bold text-sm shadow-sm">
                            {{ strtoupper(substr(auth()->user()->prenom ?? 'U', 0, 1)) }}{{ strtoupper(substr(auth()->user()->nom ?? '', 0, 1)) }}
                        </div>
                        <span class="hidden sm:block text-sm font-medium text-primary">{{ auth()->user()->prenom ?? '' }} {{ auth()->user()->nom ?? '' }}</span>
                    </div>
                </div>
            </header>

            <!-- Contenu -->
            <main class="flex-1 p-4 md:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>