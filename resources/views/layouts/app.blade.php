<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SynergyAI')</title>

    <!-- Tailwind config -->
    <script src="https://cdn.tailwindcss.com"></script>
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
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Chargement ALpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.0/dist/cdn.min.js"></script>
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: #F4EDE0;
            color: #3A3A3A;
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
        .btn-primary {
            background: #0A4A3B;
            color: #fff;
            border: none;
            border-radius: 3rem;
            padding: 0.85rem 2.2rem;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            box-shadow: 0 10px 22px -8px rgba(10, 74, 59, 0.35);
            transition: all 0.35s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        .btn-primary:hover {
            background: #083D30;
            transform: translateY(-3px);
            box-shadow: 0 18px 30px -10px rgba(10, 74, 59, 0.45);
        }
        .btn-outline {
            background: transparent;
            border: 2px solid #0A4A3B;
            color: #0A4A3B;
            border-radius: 3rem;
            padding: 0.8rem 2rem;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            transition: all 0.35s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        .btn-outline:hover {
            background: #0A4A3B;
            color: #fff;
            box-shadow: 0 12px 24px -8px rgba(10, 74, 59, 0.3);
        }
        .header-top {
            background: rgba(252, 249, 242, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(10, 74, 59, 0.08);
        }
        .input-field {
            background: rgba(255, 255, 255, 0.5);
            border: 1.5px solid rgba(255, 255, 255, 0.6);
            border-radius: 1.5rem;
            transition: all 0.25s ease;
            color: #2d2a25;
            width: 100%;
            padding: 0.6rem 1.2rem;
        }
        .input-field:focus {
            background: rgba(255, 255, 255, 0.8);
            border-color: #0A4A3B;
            box-shadow: 0 0 0 4px rgba(10, 74, 59, 0.08);
            outline: none;
        }
        .input-field::placeholder {
            color: rgba(92, 83, 70, 0.35);
            font-weight: 300;
        }
        .auth-bg {
            background: radial-gradient(ellipse at 80% 20%, rgba(226, 123, 70, 0.08) 0%, transparent 55%),
                        radial-gradient(ellipse at 20% 80%, rgba(10, 74, 59, 0.06) 0%, transparent 55%),
                        #F4EDE0;
        }
    </style>
    @stack('styles')
</head>
<body class="antialiased">

    <!-- ========== HEADER ========== -->
    <header class="fixed top-0 left-0 w-full z-50 header-top" id="mainHeader">
        <div class="max-w-7xl mx-auto px-5 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white/80 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-sm border border-white/60">
                    <i class="fas fa-heartbeat text-2xl text-primary"></i>
                </div>
                <div class="leading-tight">
                    <span class="text-xl font-display font-semibold text-primary">SynergyAI</span>
                    <span class="block text-[10px] text-warm-gray tracking-wide uppercase">Intelligence médicale</span>
                </div>
            </div>
            <nav class="hidden lg:flex items-center gap-6 text-[15px] font-medium">
                <a href="{{ url('/') }}" class="text-warm-gray hover:text-primary transition-colors">Accueil</a>
                @guest
                    <a href="{{ route('login') }}" class="text-warm-gray hover:text-primary transition-colors">Connexion</a>
                    <a href="{{ route('register.step1') }}" class="btn-primary text-sm !py-2 !px-5">Inscription</a>
                @else
                    <span class="text-warm-gray">Bonjour, {{ Auth::user()->prenom ?? 'Utilisateur' }}</span>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-warm-gray hover:text-primary">Déconnexion</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                @endguest
            </nav>
            <button class="lg:hidden text-2xl text-primary" id="menuToggle" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Mobile menu (optionnel) -->
    <div class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40 hidden" id="mobileOverlay"></div>
    <div class="fixed top-0 right-0 w-80 h-full bg-cream/90 backdrop-blur-xl z-50 shadow-2xl transform translate-x-full transition-transform duration-300 rounded-l-3xl" id="mobileMenu">
        <div class="p-6 flex flex-col gap-6 pt-20">
            <button id="closeMenu" class="absolute top-5 right-5 text-2xl text-primary"><i class="fas fa-times"></i></button>
            <a href="{{ url('/') }}" class="text-lg font-medium text-warm-gray">Accueil</a>
            @guest
                <a href="{{ route('login') }}" class="text-lg font-medium text-warm-gray">Connexion</a>
                <a href="{{ route('register.step1') }}" class="btn-primary text-center">Inscription</a>
            @else
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-lg font-medium text-warm-gray">Déconnexion</a>
            @endguest
        </div>
    </div>

    <!-- ========== CONTENU PRINCIPAL ========== -->
    <main class="pt-20 min-h-screen auth-bg flex items-center justify-center p-4">
        @yield('content')
    </main>

    <!-- ========== FOOTER ========== -->
    <footer class="bg-primary text-white/80 py-8">
        <div class="max-w-7xl mx-auto px-5 text-center text-sm text-white/60">
            © 2026 SynergyAI — Tous droits réservés — v2.0 · Certifié HDS & RGPD
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        // Mobile menu
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
    </script>
    @stack('scripts')
</body>
</html>