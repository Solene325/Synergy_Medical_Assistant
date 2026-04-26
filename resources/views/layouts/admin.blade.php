{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration · SynergyAI')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
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
            background: linear-gradient(135deg, #f5f7fa 0%, #e9f0f5 100%);
            color: #3a4e5e;
            min-height: 100vh;
        }

        h1, h2, h3, h4 {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        /* Glass Card Effect */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid var(--glass-border);
            border-radius: 32px;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.1);
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .glass-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 30px 50px -20px rgba(79, 157, 166, 0.2);
            border-color: rgba(255, 255, 255, 0.9);
        }

        /* Sidebar Styles (version admin) */
        .sidebar {
            background: linear-gradient(180deg, #2d5a63 0%, #1f4047 100%);
            backdrop-filter: blur(10px);
            box-shadow: 4px 0 30px rgba(0, 0, 0, 0.12);
        }

        .sidebar-link {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border-left: 4px solid transparent;
            border-radius: 16px;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.12);
            border-left-color: var(--accent);
            transform: translateX(6px);
        }

        .sidebar-link.active {
            background: rgba(249, 199, 181, 0.25);
            border-left-color: var(--accent);
        }

        /* Stat Cards */
        .stat-card-soft {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 28px;
            padding: 1.5rem;
            transition: all 0.4s ease;
        }

        .stat-card-soft:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-6px);
            box-shadow: 0 25px 40px -18px var(--primary);
        }

        /* Button Styles */
        .btn-soft-primary {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 40px;
            padding: 12px 28px;
            font-weight: 600;
            box-shadow: 0 10px 20px -8px rgba(79, 157, 166, 0.3);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-soft-primary:hover {
            background: #3c838c;
            transform: translateY(-3px);
            box-shadow: 0 18px 25px -10px var(--primary);
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

        /* Soft Icon */
        .soft-icon {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(4px);
            border-radius: 24px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: var(--primary);
            box-shadow: 0 8px 20px rgba(79, 157, 166, 0.1);
            transition: 0.3s;
        }

        .soft-icon:hover {
            background: white;
            transform: scale(1.1) rotate(2deg);
        }

        /* Badge Styles */
        .badge-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 0.35rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.7rem;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: var(--light);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--secondary);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        /* User Avatar */
        .user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(79, 157, 166, 0.3);
        }

        /* Blobs flottants */
        .blob {
            position: fixed;
            width: 400px;
            height: 400px;
            background: linear-gradient(180deg, var(--secondary) 0%, var(--accent) 100%);
            border-radius: 50%;
            filter: blur(70px);
            opacity: 0.15;
            animation: floatBlob 20s infinite alternate ease-in-out;
            z-index: -1;
            pointer-events: none;
        }
        .blob2 {
            width: 350px;
            height: 350px;
            background: var(--soft-blue);
            filter: blur(80px);
            opacity: 0.2;
            animation: floatBlob2 18s infinite alternate;
        }
        @keyframes floatBlob {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(5%, 5%) scale(1.2); }
        }
        @keyframes floatBlob2 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-7%, 3%) scale(1.3); }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 60;
            }
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
            }
        }

        /* Section Title */
        .section-title-soft {
            position: relative;
            display: inline-block;
            padding-bottom: 12px;
        }
        .section-title-soft::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 4px;
            opacity: 0.7;
        }

        /* Notification badge */
        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 18px;
            height: 18px;
            background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
            border-radius: 50%;
            border: 2px solid white;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Table styling */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th {
            text-align: left;
            padding: 12px 8px;
            font-weight: 600;
            color: #2d4e57;
            border-bottom: 1px solid rgba(79,157,166,0.2);
        }
        .data-table td {
            padding: 12px 8px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .data-table tr:hover {
            background: rgba(255,255,255,0.4);
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Blobs flottants -->
    <div class="blob fixed top-20 left-10"></div>
    <div class="blob2 fixed bottom-20 right-20"></div>

    <div class="flex min-h-screen">
        <!-- Sidebar Admin -->
        <aside class="sidebar w-72 fixed h-screen overflow-y-auto z-50" id="sidebar">
            <div class="p-6 border-b border-white/15">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-white/15 backdrop-blur rounded-2xl flex items-center justify-center">
                        <i class="fas fa-shield-alt text-2xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">SynergyAI</h1>
                        <p class="text-xs text-white/70">Administration</p>
                    </div>
                </div>
                <span class="inline-block px-3 py-1 bg-white/10 backdrop-blur-sm rounded-full text-xs text-white/80 border border-white/20">Panel Admin</span>
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line w-5 text-lg"></i>
                    <span class="font-medium">Tableau de bord</span>
                </a>
                <a href="{{ route('admin.users') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fas fa-users w-5 text-lg"></i>
                    <span class="font-medium">Utilisateurs</span>
                </a>
                <a href="{{ route('admin.medicaments') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white {{ request()->routeIs('admin.medicaments') ? 'active' : '' }}">
                    <i class="fas fa-capsules w-5 text-lg"></i>
                    <span class="font-medium">Médicaments</span>
                </a>
                <a href="{{ route('admin.device-data') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white {{ request()->routeIs('admin.device-data') ? 'active' : '' }}">
                    <i class="fas fa-microchip w-5 text-lg"></i>
                    <span class="font-medium">Appareil tiers</span>
                    <span class="ml-auto text-[10px] bg-yellow-400/30 text-yellow-100 px-2 py-0.5 rounded-full">Bientôt</span>
                </a>
            </nav>

            <div class="p-4 absolute bottom-0 w-72 border-t border-white/15 bg-[#2d5a63]/40 backdrop-blur-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->prenom ?? 'A', 0, 1)) }}{{ strtoupper(substr(Auth::user()->nom ?? 'D', 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-sm font-semibold">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</p>
                        <p class="text-[#cde3e0] text-xs">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-link flex items-center gap-3 px-4 py-3 text-white rounded-2xl w-full hover:bg-red-500/20">
                        <i class="fas fa-sign-out-alt w-5 text-lg"></i>
                        <span class="font-medium">Déconnexion</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-72 p-8 main-content">
            <!-- Mobile Menu Toggle -->
            <button class="md:hidden fixed top-4 left-4 z-40 soft-icon" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>

            <!-- TOP BAR : visible uniquement sur la page d'accueil du dashboard admin -->
            @if(request()->routeIs('admin.dashboard'))
            <div class="glass-card p-5 mb-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="soft-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div>
                        <p class="text-sm text-[#527a84] font-medium">Aujourd'hui</p>
                        <p class="font-semibold text-[#2d4e57] text-lg">{{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <button class="relative soft-icon hover:scale-110 transition-transform">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge"></span>
                    </button>
                    <div class="hidden sm:flex items-center gap-2 bg-white/40 backdrop-blur-sm px-4 py-2 rounded-full">
                        <i class="fas fa-circle text-[10px] text-green-500"></i>
                        <span class="text-sm font-medium text-[#2d4e57]">Système opérationnel</span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Messages flash (succès / erreur) : visibles sur toutes les pages -->
            @if(session('success'))
                <div class="mb-6 px-5 py-4 rounded-2xl bg-green-100/80 backdrop-blur-sm border-l-4 border-green-500 text-green-800">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 px-5 py-4 rounded-2xl bg-red-100/80 backdrop-blur-sm border-l-4 border-red-500 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Overlay pour mobile -->
    <div class="menu-overlay fixed inset-0 bg-black/20 backdrop-blur-sm z-40 hidden" id="menuOverlay" onclick="toggleSidebar()"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('menuOverlay');
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('hidden');
        }
        // Fermer la sidebar si on clique sur un lien (mobile)
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    toggleSidebar();
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>