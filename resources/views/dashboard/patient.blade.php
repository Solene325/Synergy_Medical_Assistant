@extends('layouts.patient')

@section('title', 'Tableau de bord · SynergyAI')

@section('content')
<div class="space-y-8">

    <!-- ========== HERO CARD ========== -->
    <div class="glass-card p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-6 bg-gradient-to-br from-white/80 to-cream/50">
        <div>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-primary">
                Bonjour, {{ auth()->user()->prenom ?? 'Patient' }} 👋
            </h1>
            <p class="text-warm-gray mt-2 flex items-center gap-2">
                <i class="fas fa-clock text-accent"></i>
                Dernière connexion :
                <span class="font-medium">
                    {{ auth()->user()->last_login_at?->diffForHumans() ?? 'Première connexion' }}
                </span>
            </p>
            <div class="mt-5 flex flex-wrap gap-3">
                <a href="{{ route('patient.chat') }}" class="btn-primary text-sm">
                    <i class="fas fa-robot"></i> Diagnostic IA
                </a>
                <a href="{{ route('chat.index') }}" class="btn-primary btn-accent text-sm">
                    <i class="fas fa-user-md"></i> Consulter un médecin
                </a>
            </div>
        </div>
        <div class="hidden md:block">
            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-accent-light/40 to-primary/10 flex items-center justify-center text-5xl text-primary/20 shadow-inner">
                <i class="fas fa-user-md"></i>
            </div>
        </div>
    </div>

    <!-- ========== STATISTIQUES ========== -->
    <div>
        <h2 class="text-2xl font-display font-semibold text-primary mb-5 flex items-center gap-2">
            <span class="w-1.5 h-6 rounded-full bg-accent"></span> Mes indicateurs
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
            <!-- Poids -->
            <div class="stat-card hover:border-accent/30 transition">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-warm-gray">Poids</p>
                    <div class="w-10 h-10 rounded-full bg-soft-peach flex items-center justify-center text-accent">
                        <i class="fas fa-weight-scale"></i>
                    </div>
                </div>
                <p class="text-3xl font-display font-bold text-primary mt-3">
                    {{ auth()->user()->poids ?? '—' }}
                    <span class="text-lg font-normal text-warm-gray">kg</span>
                </p>
                <div class="w-full h-1.5 bg-gray-200/60 rounded-full mt-3">
                    <div class="h-full w-3/4 bg-gradient-to-r from-accent to-primary rounded-full"></div>
                </div>
            </div>

            <!-- Taille -->
            <div class="stat-card hover:border-slate/30 transition">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-warm-gray">Taille</p>
                    <div class="w-10 h-10 rounded-full bg-soft-blue flex items-center justify-center text-slate">
                        <i class="fas fa-ruler-vertical"></i>
                    </div>
                </div>
                <p class="text-3xl font-display font-bold text-primary mt-3">
                    {{ auth()->user()->taille ?? '—' }}
                    <span class="text-lg font-normal text-warm-gray">cm</span>
                </p>
                <div class="w-full h-1.5 bg-gray-200/60 rounded-full mt-3">
                    <div class="h-full w-1/2 bg-gradient-to-r from-slate to-primary rounded-full"></div>
                </div>
            </div>

            <!-- Groupe sanguin -->
            <div class="stat-card hover:border-gold/30 transition">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-warm-gray">Groupe sanguin</p>
                    <div class="w-10 h-10 rounded-full bg-gold-light/30 flex items-center justify-center text-gold">
                        <i class="fas fa-droplet"></i>
                    </div>
                </div>
                <p class="text-3xl font-display font-bold text-primary mt-3">
                    {{ auth()->user()->groupe_sanguin ?? '—' }}
                </p>
                <div class="w-full h-1.5 bg-gray-200/60 rounded-full mt-3">
                    <div class="h-full w-2/3 bg-gradient-to-r from-gold to-primary rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== GÉOLOCALISATION ========== -->
    <div>
        <h2 class="text-2xl font-display font-semibold text-primary mb-5 flex items-center gap-2">
            <span class="w-1.5 h-6 rounded-full bg-gold"></span> Centres de santé à proximité
        </h2>
        <div class="glass-card p-4">
            <div id="healthMap" class="map-container"></div>
            <div class="flex flex-wrap justify-between items-center mt-4 text-sm text-warm-gray">
                <div class="flex items-center gap-4">
                    <span><span class="inline-block w-3 h-3 rounded-full bg-primary mr-1"></span> Centres partenaires</span>
                    <span><span class="inline-block w-3 h-3 rounded-full bg-accent mr-1"></span> Distributeurs</span>
                </div>
                <a href="#" class="text-accent hover:underline font-medium">Voir en grand <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>
    </div>

    <!-- ========== GRAPHIQUES ========== -->
    <div>
        <h2 class="text-2xl font-display font-semibold text-primary mb-5 flex items-center gap-2">
            <span class="w-1.5 h-6 rounded-full bg-slate"></span> Activité & tendances
        </h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Donut -->
            <div class="glass-card p-6 bg-gradient-to-br from-white/70 to-soft-blue/30">
                <h3 class="font-display font-semibold text-primary text-lg mb-4">Profil de santé</h3>
                <div class="flex flex-col items-center">
                    <div class="relative w-40 h-40">
                        <svg viewBox="0 0 120 120" class="transform -rotate-90">
                            <circle cx="60" cy="60" r="50" fill="none" stroke="#e5e7eb" stroke-width="12"/>
                            <circle cx="60" cy="60" r="50" fill="none" stroke="url(#grad)" stroke-width="12"
                                    stroke-dasharray="314.16" stroke-dashoffset="0"
                                    x-data="{ progress: 0 }"
                                    x-init="setTimeout(() => { progress = 85; $el.style.strokeDashoffset = 314.16 - (314.16 * progress / 100); }, 400)"
                                    :style="`stroke-dashoffset: ${314.16 - (314.16 * 85 / 100)}`"
                                    stroke-linecap="round"/>
                            <defs>
                                <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#0A4A3B" />
                                    <stop offset="100%" stop-color="#D97742" />
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center text-2xl font-display font-bold text-primary">
                            85%
                        </div>
                    </div>
                    <p class="text-warm-gray text-sm mt-2">Complétude du dossier</p>
                </div>
            </div>

            <!-- Barres -->
            <div class="glass-card p-6 bg-gradient-to-br from-white/70 to-soft-peach/30">
                <h3 class="font-display font-semibold text-primary text-lg mb-4">Consultations (semaine)</h3>
                <div class="h-40 flex items-end justify-between gap-2">
                    @php
                        $days = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
                        $values = [2, 5, 3, 7, 4, 1, 0];
                        $max = max($values) ?: 1;
                    @endphp
                    @foreach($days as $index => $day)
                        <div class="flex flex-col items-center flex-1">
                            <div class="w-full rounded-t-lg transition-all duration-700"
                                 style="height: {{ ($values[$index] / $max) * 120 }}px; background: linear-gradient(180deg, #0A4A3B, #1A6B57);"
                                 x-data="{ height: 0 }"
                                 x-init="setTimeout(() => { height = {{ ($values[$index] / $max) * 120 }}; $el.style.height = height + 'px'; }, 300 + {{ $index * 100 }})">
                            </div>
                            <span class="text-xs text-warm-gray mt-1.5">{{ $day }}</span>
                            <span class="text-xs font-semibold text-primary">{{ $values[$index] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- ========== PRESCRIPTIONS ========== -->
    <div>
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-2xl font-display font-semibold text-primary flex items-center gap-2">
                <span class="w-1.5 h-6 rounded-full bg-accent"></span> Prescriptions récentes
            </h2>
            <a href="#" class="text-sm text-accent hover:underline font-medium">Voir tout <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
        <div class="glass-card p-6">
            @php
                $prescriptions = auth()->user()->prescriptionsAsPatient()->latest()->take(3)->get();
            @endphp
            @if($prescriptions->isEmpty())
                <div class="text-center py-10 text-warm-gray">
                    <i class="fas fa-prescription-bottle text-4xl text-gray-300 mb-3"></i>
                    <p>Aucune prescription pour le moment.</p>
                </div>
            @else
                <div class="divide-y divide-white/40">
                    @foreach($prescriptions as $prescription)
                        <div class="py-4 flex flex-wrap items-center justify-between gap-4">
                            <div>
                                <p class="font-semibold text-primary">Ordonnance #{{ $prescription->id }}</p>
                                <p class="text-sm text-warm-gray">
                                    <i class="fas fa-user-md mr-1 text-accent"></i>
                                    Dr. {{ $prescription->doctor->name ?? 'Non spécifié' }}
                                </p>
                                <p class="text-xs text-warm-gray/70">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ $prescription->created_at->format('d/m/Y à H:i') }}
                                </p>
                            </div>
                            <a href="#" class="btn-primary text-sm !py-1.5 !px-4">
                                <i class="fas fa-download"></i> Télécharger
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- ========== CONSEIL SANTÉ ========== -->
    <div class="glass-card p-6 bg-gradient-to-br from-blue-50/40 to-indigo-50/30 border-blue-200/30">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-blue-100/60 flex items-center justify-center text-blue-600">
                <i class="fas fa-lightbulb"></i>
            </div>
            <div>
                <h3 class="font-display font-semibold text-primary text-lg">💡 Conseil santé du jour</h3>
                <p class="text-warm-gray text-sm leading-relaxed max-w-2xl">
                    N'oubliez pas de boire au moins 1,5L d'eau par jour pour rester hydraté. Une bonne hydratation améliore votre concentration et votre bien-être général.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('right-panel')
<!-- ========================================= -->
<!-- PANEL DROIT : Calendrier, Planning, Tuteurs -->
<!-- ========================================= -->

<!-- Calendrier -->
<div class="glass-card p-5 mb-6">
    <div class="flex items-center justify-between mb-4">
        <h4 class="font-display font-semibold text-primary">Calendrier</h4>
        <div class="flex gap-2">
            <button class="text-sm text-warm-gray hover:text-primary transition" id="prevMonth"><i class="fas fa-chevron-left"></i></button>
            <span class="text-sm font-medium text-primary" id="currentMonth">Janvier 2026</span>
            <button class="text-sm text-warm-gray hover:text-primary transition" id="nextMonth"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
    <div id="calendarGrid" class="grid grid-cols-7 gap-1 text-center text-sm">
        <!-- Jours de la semaine -->
        <div class="text-warm-gray/60 font-medium">L</div>
        <div class="text-warm-gray/60 font-medium">M</div>
        <div class="text-warm-gray/60 font-medium">M</div>
        <div class="text-warm-gray/60 font-medium">J</div>
        <div class="text-warm-gray/60 font-medium">V</div>
        <div class="text-warm-gray/60 font-medium">S</div>
        <div class="text-warm-gray/60 font-medium">D</div>
        <!-- Les dates seront injectées par JS -->
    </div>
</div>

<!-- Planning -->
<div class="glass-card p-5 mb-6">
    <h4 class="font-display font-semibold text-primary mb-3">Prochains rendez-vous</h4>
    <div class="space-y-3">
        <div class="flex items-center gap-3 text-sm">
            <div class="w-2 h-2 rounded-full bg-accent"></div>
            <span class="font-medium text-primary">15/06 à 14h</span>
            <span class="text-warm-gray">Consultation Dr. Martin</span>
        </div>
        <div class="flex items-center gap-3 text-sm">
            <div class="w-2 h-2 rounded-full bg-gold"></div>
            <span class="font-medium text-primary">17/06 à 9h</span>
            <span class="text-warm-gray">Suivi post‑opératoire</span>
        </div>
        <div class="flex items-center gap-3 text-sm">
            <div class="w-2 h-2 rounded-full bg-slate"></div>
            <span class="font-medium text-primary">20/06 à 11h</span>
            <span class="text-warm-gray">Téléconsultation</span>
        </div>
    </div>
</div>

<!-- Tuteurs -->
<div class="glass-card p-5">
    <h4 class="font-display font-semibold text-primary mb-3">Médecins recommandés</h4>
    <div class="space-y-3">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-accent-light/20 flex items-center justify-center text-accent font-bold text-sm shadow-inner">DM</div>
            <div>
                <p class="text-sm font-semibold text-primary">Dr. Martin</p>
                <p class="text-xs text-warm-gray">Généraliste</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-slate-light/20 flex items-center justify-center text-slate font-bold text-sm shadow-inner">SD</div>
            <div>
                <p class="text-sm font-semibold text-primary">Dr. Dubois</p>
                <p class="text-xs text-warm-gray">Cardiologue</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gold-light/20 flex items-center justify-center text-gold font-bold text-sm shadow-inner">AK</div>
            <div>
                <p class="text-sm font-semibold text-primary">Dr. Koné</p>
                <p class="text-xs text-warm-gray">Pédiatre</p>
            </div>
        </div>
    </div>
</div>

<!-- Scripts pour le calendrier et la carte -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Calendrier ---
        const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();

        function renderCalendar(month, year) {
            const grid = document.getElementById('calendarGrid');
            const headers = grid.querySelectorAll('div.text-warm-gray');
            grid.innerHTML = '';
            ['L', 'M', 'M', 'J', 'V', 'S', 'D'].forEach(day => {
                const div = document.createElement('div');
                div.className = 'text-warm-gray/60 font-medium';
                div.textContent = day;
                grid.appendChild(div);
            });
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            let startOffset = (firstDay === 0) ? 6 : firstDay - 1;
            for (let i = 0; i < startOffset; i++) {
                const div = document.createElement('div');
                grid.appendChild(div);
            }
            for (let d = 1; d <= daysInMonth; d++) {
                const div = document.createElement('div');
                div.className = 'p-1 rounded-full hover:bg-primary/10 transition cursor-pointer';
                if (d === new Date().getDate() && month === new Date().getMonth() && year === new Date().getFullYear()) {
                    div.classList.add('bg-primary', 'text-white', 'shadow-md');
                }
                div.textContent = d;
                grid.appendChild(div);
            }
            document.getElementById('currentMonth').textContent = monthNames[month] + ' ' + year;
        }

        document.getElementById('prevMonth').addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) { currentMonth = 11; currentYear--; }
            renderCalendar(currentMonth, currentYear);
        });
        document.getElementById('nextMonth').addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 11) { currentMonth = 0; currentYear++; }
            renderCalendar(currentMonth, currentYear);
        });
        renderCalendar(currentMonth, currentYear);

        // --- Carte Leaflet ---
        const map = L.map('healthMap').setView([6.5, 1.5], 5);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a> &copy; CartoDB',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);

        // Centres de santé (exemples)
        const centers = [
            { lat: 5.359, lng: -4.008, name: 'Centre de Santé · Abidjan' },
            { lat: 6.370, lng: 2.391, name: 'Hôpital · Cotonou' },
            { lat: 14.716, lng: -17.467, name: 'Clinique · Dakar' },
            { lat: 12.639, lng: -8.002, name: 'CS Réf · Bamako' },
            { lat: 9.057, lng: 7.495, name: 'CHU · Abuja' },
            { lat: 0.347, lng: 32.582, name: 'Hôpital · Kampala' },
        ];
        centers.forEach(c => {
            L.circleMarker([c.lat, c.lng], { radius: 8, fillColor: '#0A4A3B', color: '#fff', weight: 2, opacity: 1, fillOpacity: 0.8 })
                .addTo(map)
                .bindPopup(`<strong>🏥 ${c.name}</strong><br><span class="text-xs">Partenaire SynergyAI</span>`);
        });

        // Distributeurs
        const dispensers = [
            { lat: 5.320, lng: -4.040, name: 'Distributeur · Treichville' },
            { lat: 6.380, lng: 2.430, name: 'Distributeur · Akpakpa' },
            { lat: 14.700, lng: -17.450, name: 'Distributeur · Médina' },
        ];
        dispensers.forEach(d => {
            L.circleMarker([d.lat, d.lng], { radius: 6, fillColor: '#D97742', color: '#fff', weight: 2, opacity: 1, fillOpacity: 0.8 })
                .addTo(map)
                .bindPopup(`<strong>💊 ${d.name}</strong><br><span class="text-xs">Distributeur connecté</span>`);
        });

        setTimeout(() => map.invalidateSize(), 300);
        window.addEventListener('resize', () => map.invalidateSize());
    });
</script>
@endpush
@endsection