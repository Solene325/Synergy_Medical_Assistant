<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace Médecin · SynergyAI')</title>
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

        /* Glass Card Effect - Identique au patient */
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

        /* Sidebar Styles - Identique au patient */
        .sidebar {
            background: linear-gradient(180deg, var(--primary) 0%, #3c838c 100%);
            backdrop-filter: blur(10px);
            box-shadow: 4px 0 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
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

        /* Soft Icon - Identique au patient */
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

        /* Blobs flottants - Identique au patient */
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
            position: fixed;
            width: 350px;
            height: 350px;
            background: var(--soft-blue);
            filter: blur(80px);
            opacity: 0.2;
            animation: floatBlob2 18s infinite alternate;
            z-index: -1;
            pointer-events: none;
        }

        @keyframes floatBlob2 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-7%, 3%) scale(1.3); }
        }

        /* Badge Styles */
        .badge-accent {
            background: var(--accent);
            color: #3a4e5e;
            padding: 0.35rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.mobile-open { transform: translateX(0); }
            .main-content { margin-left: 0 !important; }
        }
    </style>
</head>
<body class="overflow-x-hidden">
    <div class="blob top-20 left-10"></div>
    <div class="blob2 bottom-20 right-20"></div>

    <div class="flex min-h-screen">
        <aside class="sidebar w-72 fixed h-screen overflow-y-auto z-50" id="sidebar">
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
                <span class="inline-block px-3 py-1 bg-white/10 backdrop-blur-sm rounded-full text-xs text-white/80 border border-white/20">Espace Médecin</span>
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('medecin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white {{ request()->routeIs('medecin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line w-5 text-lg"></i>
                    <span class="font-medium">Tableau de bord</span>
                </a>

                <a href="{{ route('medecin.patients.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white {{ request()->routeIs('medecin.patients.*') ? 'active' : '' }}">
                    <i class="fas fa-user-injured w-5 text-lg"></i>
                    <span class="font-medium">Mes Patients</span>
                </a>

                <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white">
                    <i class="fas fa-calendar-alt w-5 text-lg"></i>
                    <span class="font-medium">Agenda</span>
                    <span class="ml-auto badge-accent">3</span>
                </a>

                <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white">
                    <i class="fas fa-microscope w-5 text-lg"></i>
                    <span class="font-medium">Analyses IA</span>
                </a>

                <a href="{{ route('medecin.profile.edit') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-white {{ request()->routeIs('medecin.profile.*') ? 'active' : '' }}">
                    <i class="fas fa-user-md w-5 text-lg"></i>
                    <span class="font-medium">Mon Profil</span>
                </a>
            </nav>

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

        <main class="flex-1 ml-72 p-8 main-content">
            <button class="md:hidden fixed top-4 left-4 z-40 soft-icon" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>

            <div class="glass-card p-5 mb-8 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="soft-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div>
                        <p class="text-sm text-[#527a84] font-medium">Session Docteur</p>
                        <p class="font-semibold text-[#2d4e57] text-lg">Dr. {{ Auth::user()->name ?? 'Expert' }}</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="hidden lg:block text-right mr-4">
                        <p class="text-xs text-slate-500 uppercase font-bold tracking-widest">Date</p>
                        <p class="text-sm font-semibold">{{ now()->locale('fr')->isoFormat('LL') }}</p>
                    </div>
                    <button class="relative soft-icon hover:scale-110 transition-transform">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-4 right-4 w-3 h-3 bg-red-500 border-2 border-white rounded-full"></span>
                    </button>
                </div>
            </div>

            @if(session('success'))
                <div class="glass-card bg-green-50/50 border-green-200 p-4 mb-6 text-green-700 flex items-center gap-3">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="animate-fade-in">
                @yield('content')
            </div>
        </main>
    </div>

    <div class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40 hidden" id="menuOverlay" onclick="toggleSidebar()"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('menuOverlay');
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('hidden');
        }
    </script>
    @stack('scripts')
</body>
</html>