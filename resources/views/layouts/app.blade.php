<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Synergy Medical Assistant')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @stack('styles')
    <style>
        /* Inclure ici les styles spécifiques du fichier welcome (les variables, etc.) */
        :root {
            --primary: #4f9da6;
            --secondary: #a7d0cd;
            --accent: #f9c7b5;
            --light: #f9f3e8;
            --soft-blue: #d4f1f9;
            --soft-white: #fff9f2;
            --glass-bg: rgba(255, 255, 255, 0.5);
            --glass-border: rgba(255, 255, 255, 0.6);
        }
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: var(--soft-white);
            color: #3a4e5e;
            scroll-behavior: smooth;
        }
        .header-glass {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }
        .btn-soft-primary {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 40px;
            padding: 14px 36px;
            font-weight: 600;
            box-shadow: 0 10px 20px -8px rgba(79, 157, 166, 0.3);
            transition: all 0.3s ease;
        }
        .btn-soft-primary:hover {
            background: #3c838c;
            transform: translateY(-3px);
            box-shadow: 0 18px 25px -10px var(--primary);
        }
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid var(--glass-border);
            border-radius: 32px;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="antialiased">
    <!-- Header -->
    <header class="header-glass sticky top-0 z-50 py-3">
        <div class="container mx-auto px-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 bg-white/80 backdrop-blur rounded-2xl flex items-center justify-center shadow-sm border border-white/50">
                    <i class="fas fa-heartbeat text-3xl text-[#4f9da6]"></i>
                </div>
                <div>
                    <span class="text-2xl font-semibold text-[#3a4e5e]">SynergyAI</span>
                    <span class="block text-xs text-gray-500 tracking-wide">intelligence médicale</span>
                </div>
            </div>
            
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}" class="text-[#4f6b73] hover:text-[#4f9da6] font-medium">Accueil</a>
                @guest
                    <a href="{{ route('login') }}" class="text-[#4f6b73] hover:text-[#4f9da6] font-medium">Connexion</a>
                    <a href="{{ route('register.step1') }}" class="btn-soft-primary text-sm">Inscription</a>
                @else
                    <span class="text-[#4f6b73]">Bonjour, {{ Auth::user()->prenom }}</span>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-[#4f6b73] hover:text-[#4f9da6] font-medium">Déconnexion</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                @endguest
            </nav>
        </div>
    </header>

    <!-- Contenu principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-soft py-8 bg-[#dbe9e6]">
        <div class="container mx-auto px-6 text-center text-[#527a84]">
            © 2026 Synergy Medical Assistant – Tous droits réservés
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });
    </script>
    @stack('scripts')
</body>
</html>