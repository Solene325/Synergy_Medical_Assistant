<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace Patient · SynergyAI')</title>
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

        /* Sidebar Styles */
        .sidebar {
            background: linear-gradient(180deg, var(--primary) 0%, #3c838c 100%);
            backdrop-filter: blur(10px);
            box-shadow: 4px 0 30px rgba(0, 0, 0, 0.08);
        }

        .sidebar-link {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border-left: 4px solid transparent;
            border-radius: 16px;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.15);
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
            padding: 1.8rem;
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

        .btn-soft-secondary {
            background: transparent;
            border: 1.5px solid white;
            color: white;
            border-radius: 40px;
            padding: 12px 30px;
            font-weight: 600;
            backdrop-filter: blur(5px);
            transition: all 0.3s;
        }

        .btn-soft-secondary:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: white;
        }

        /* Soft Icon */
        .soft-icon {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(4px);
            border-radius: 24px;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
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

        .badge-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 0.35rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 0.35rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
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
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.25rem;
            box-shadow: 0 8px 20px rgba(79, 157, 166, 0.25);
        }

        /* Action Card */
        .action-card {
            background: var(--glass-bg);
            backdrop-filter: blur(8px);
            border: 1px solid var(--glass-border);
            border-radius: 28px;
            padding: 2rem;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .action-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(79, 157, 166, 0.25);
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

        @keyframes floatBlob {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(5%, 5%) scale(1.2); }
        }

        .blob2 {
            width: 350px;
            height: 350px;
            background: var(--soft-blue);
            filter: blur(80px);
            opacity: 0.2;
            animation: floatBlob2 18s infinite alternate;
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
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 1000;
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

        /* Top notification badge */
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
    </style>
    @stack('styles')
</head>
<body>
    <!-- Blobs flottants -->
    <div class="blob fixed top-20 left-10"></div>
    <div class="blob2 fixed bottom-20 right-20"></div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar w-72 fixed h-screen overflow-y-auto z-50" id="sidebar">
            <!-- Logo / Brand -->
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center">
                        <i class="fas fa-heartbeat text-2xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">SynergyAI</h1>
                        <p class="text-xs text-[#a7d0cd]">intelligence médicale</p>
                    </div>
                </div>
                <span class="inline-block px-3 py-1 bg-white/10 backdrop-blur-sm rounded-full text-xs text-white/80 border border-white/20">Espace Patient</span>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-2">
                <a href="{{ route('dashboard.patient') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white {{ request()->routeIs('dashboard.patient') ? 'active' : '' }}">
                    <i class="fas fa-home w-5 text-lg"></i>
                    <span class="font-medium">Accueil</span>
                </a>

                <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white">
                    <i class="fas fa-pills w-5 text-lg"></i>
                    <span class="font-medium">Mes Prescriptions</span>
                </a>

                <!-- Lien vers la messagerie (chat) -->
                <a href="{{ route('chat.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white {{ request()->routeIs('chat.*') ? 'active' : '' }}">
                    <i class="fas fa-comment-dots w-5 text-lg"></i>
                    <span class="font-medium">Messagerie</span>
                    @php
                        $unreadCount = Auth::user()->unreadMessages()->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a>

                <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white">
                    <i class="fas fa-history w-5 text-lg"></i>
                    <span class="font-medium">Historique</span>
                </a>

                <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white">
                    <i class="fas fa-user-circle w-5 text-lg"></i>
                    <span class="font-medium">Mon Profil</span>
                </a>
            </nav>

            <!-- Logout -->
            <div class="p-4 absolute bottom-0 w-72 border-t border-white/10 bg-[#4f9da6]/20 backdrop-blur">
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

            <!-- Top Bar -->
            <div class="glass-card p-5 mb-8 flex items-center justify-between">
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
                </div>
            </div>

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

        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.sidebar-link').forEach(link => {
                const href = link.getAttribute('href');
                if (href && (href === currentPath || (currentPath.startsWith('/chat') && href === '{{ route('chat.index') }}'))) {
                    link.classList.add('active');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>