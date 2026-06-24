@php
    $userRole = Auth::user()->role;
    $layout = $userRole === 'medecin' ? 'layouts.medecin' : 'layouts.chat';
@endphp

@extends($layout)
@section('title', 'Discussion avec ' . ($user->role === 'medecin' ? 'Dr. ' : '') . $user->prenom)

@section('content')
<div class="container mx-auto px-4 sm:px-6 py-6 max-w-5xl">

    <!-- ============================================= -->
    <!-- CONTENEUR PRINCIPAL ALPINE (boutons + modales) -->
    <!-- ============================================= -->
    <div x-data="chatModals()" x-init="window.chatModals = this" class="relative">

        <!-- En-tête conversation avec actions -->
        <div class="flex flex-wrap items-center gap-4 mb-4">
            <div class="flex items-center gap-4 bg-white/30 backdrop-blur-sm rounded-2xl px-5 py-3 flex-1">
                <div class="w-14 h-14 rounded-full bg-white/50 flex items-center justify-center overflow-hidden shadow-md">
                    @if($user->photo_profil)
                        <img src="{{ Storage::url($user->photo_profil) }}" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-{{ $user->role === 'patient' ? 'user' : 'user-md' }} text-3xl text-primary"></i>
                    @endif
                </div>
                <div>
                    <h1 class="text-xl font-display font-bold text-primary">
                        @if($user->role === 'medecin') Dr. @endif{{ $user->prenom }} {{ $user->nom }}
                    </h1>
                    <p class="text-sm text-warm-gray">
                        {{ $user->role === 'medecin' ? ($user->specialite ?? 'Généraliste') : 'Patient' }}
                    </p>
                </div>
            </div>

            <!-- Actions selon le rôle (à l'intérieur du scope Alpine) -->
            @if($userRole === 'medecin')
                <div class="flex flex-wrap gap-2">
                    <button @click="openDiagnosis()" class="btn-primary text-sm !py-1.5 !px-4">
                        <i class="fas fa-stethoscope"></i> Diagnostiquer
                    </button>
                    <button @click="openPrescription()" class="btn-primary text-sm !py-1.5 !px-4">
                        <i class="fas fa-prescription-bottle"></i> Prescrire
                    </button>
                    <button @click="openSummaryModal()" class="btn-primary text-sm !py-1.5 !px-4 !bg-slate hover:!bg-[#1f4a63]">
                        <i class="fas fa-robot"></i> Résumé IA
                    </button>
                    <a href="{{ route('chat.video', $user) }}" class="btn-primary text-sm !py-1.5 !px-4 !bg-accent hover:!bg-[#c46a37]">
                        <i class="fas fa-video"></i> Appel vidéo
                    </a>
                </div>
            @else
                <div class="flex flex-wrap gap-2">
                    <button @click="openConsultation()" class="btn-primary text-sm !py-1.5 !px-4">
                        <i class="fas fa-stethoscope"></i> Demander consultation
                    </button>
                    <a href="{{ route('chat.video', $user) }}" class="btn-primary text-sm !py-1.5 !px-4 !bg-accent hover:!bg-[#c46a37]">
                        <i class="fas fa-video"></i> Appel vidéo
                    </a>
                </div>
            @endif
        </div>

        <!-- Zone de discussion -->
        <div class="glass-card p-0 overflow-hidden shadow-xl">
            <div id="messagesContainer" class="h-[500px] overflow-y-auto p-4 space-y-3 bg-gradient-to-b from-cream/50 to-cream/80">
                @forelse($messages as $message)
                    <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }} message-item" data-message-id="{{ $message->id }}">
                        <div class="max-w-[75%] rounded-2xl px-4 py-2.5 shadow-sm
                                    {{ $message->sender_id === Auth::id() 
                                        ? 'bg-gradient-to-r from-primary to-primary-light text-white' 
                                        : 'bg-white/90 text-gray-700' }}">
                            <p class="break-words text-sm leading-relaxed">{{ $message->message }}</p>
                            <p class="text-xs mt-1 opacity-70 text-right">
                                {{ $message->created_at->format('H:i') }}
                                @if($message->sender_id === Auth::id() && $message->is_read)
                                    <i class="fas fa-check-double ml-1"></i>
                                @endif
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-warm-gray/60 py-10">
                        <i class="fas fa-comments text-5xl mb-3 opacity-30"></i>
                        <p>Aucun message pour le moment.</p>
                    </div>
                @endforelse
            </div>

            <!-- Indicateur de frappe -->
            <div id="typingIndicator" class="hidden px-5 py-2 text-xs text-warm-gray/70 italic bg-white/40 border-t border-gray-100">
                <i class="fas fa-ellipsis-h mr-1"></i> L'interlocuteur est en train d'écrire...
            </div>

            <!-- Formulaire d'envoi -->
            <form id="messageForm" class="p-4 border-t border-gray-200 flex flex-wrap gap-3 bg-white/40 backdrop-blur-sm">
                @csrf
                <div class="flex-1 relative">
                    <input type="text" id="messageInput" placeholder="Écrivez votre message..." autocomplete="off"
                           class="w-full px-5 py-3.5 rounded-full bg-white border-0 focus:ring-2 focus:ring-primary outline-none shadow-inner transition">
                </div>
                <button type="submit" class="btn-primary !py-3 !px-6 flex items-center gap-2">
                    <i class="fas fa-paper-plane"></i> <span class="hidden sm:inline">Envoyer</span>
                </button>
            </form>
            <div id="errorMessage" class="hidden text-red-500 text-sm px-5 pb-3"></div>
        </div>

        <!-- ========================================== -->
        <!-- MODALES (dans le même scope Alpine)        -->
        <!-- ========================================== -->

        <!-- Modal Diagnostic -->
        <div x-show="diagnosisOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm" @click.away="diagnosisOpen = false">
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-6 max-w-lg w-full shadow-2xl">
                <h3 class="text-2xl font-display font-bold text-primary mb-4">Diagnostiquer</h3>
                <form method="POST" action="{{ route('chat.diagnose', $user) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="diagnostic" class="block text-sm font-medium text-warm-gray mb-1">Diagnostic *</label>
                        <textarea name="diagnostic" id="diagnostic" rows="3" class="input-field w-full" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="recommandations" class="block text-sm font-medium text-warm-gray mb-1">Recommandations</label>
                        <textarea name="recommandations" id="recommandations" rows="2" class="input-field w-full"></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" @click="diagnosisOpen = false" class="btn-outline text-sm">Annuler</button>
                        <button type="submit" class="btn-primary text-sm">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Prescription -->
        <div x-show="prescriptionOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm" @click.away="prescriptionOpen = false">
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-6 max-w-lg w-full shadow-2xl">
                <h3 class="text-2xl font-display font-bold text-primary mb-4">Prescrire</h3>
                <form method="POST" action="{{ route('chat.prescribe', $user) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="medicament_id" class="block text-sm font-medium text-warm-gray mb-1">Médicament *</label>
                        <select name="medicament_id" id="medicament_id" class="input-field w-full" required>
                            <option value="">Sélectionnez</option>
                            @foreach($medicaments ?? [] as $med)
                                <option value="{{ $med->id }}">{{ $med->nom }} ({{ $med->forme ?? 'n/a' }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="posologie" class="block text-sm font-medium text-warm-gray mb-1">Posologie *</label>
                        <input type="text" name="posologie" id="posologie" class="input-field w-full" required placeholder="ex: 1 comprimé matin et soir">
                    </div>
                    <div class="mb-4">
                        <label for="instructions" class="block text-sm font-medium text-warm-gray mb-1">Instructions</label>
                        <textarea name="instructions" id="instructions" rows="2" class="input-field w-full"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="duree_jours" class="block text-sm font-medium text-warm-gray mb-1">Durée (jours)</label>
                            <input type="number" name="duree_jours" id="duree_jours" class="input-field w-full">
                        </div>
                        <div>
                            <label for="date_debut" class="block text-sm font-medium text-warm-gray mb-1">Date de début</label>
                            <input type="date" name="date_debut" id="date_debut" class="input-field w-full">
                        </div>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" @click="prescriptionOpen = false" class="btn-outline text-sm">Annuler</button>
                        <button type="submit" class="btn-primary text-sm">Prescrire</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Demande de consultation -->
        <div x-show="consultationOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm" @click.away="consultationOpen = false">
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-6 max-w-lg w-full shadow-2xl">
                <h3 class="text-2xl font-display font-bold text-primary mb-4">Demander une consultation</h3>
                <form method="POST" action="{{ route('chat.request-consultation', $user) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="symptomes" class="block text-sm font-medium text-warm-gray mb-1">Décrivez vos symptômes *</label>
                        <textarea name="symptomes" id="symptomes" rows="3" class="input-field w-full" required></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" @click="consultationOpen = false" class="btn-outline text-sm">Annuler</button>
                        <button type="submit" class="btn-primary text-sm">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- MODALE RÉSUMÉ IA (pour médecin)            -->
        <!-- ========================================== -->
        <div x-show="summaryOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm" @click.away="summaryOpen = false">
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-6 max-w-2xl w-full shadow-2xl max-h-[80vh] overflow-y-auto">
                <h3 class="text-2xl font-display font-bold text-primary mb-4 flex items-center gap-2">
                    <i class="fas fa-robot text-accent"></i> Résumé IA du patient
                </h3>

                @php
                    $summary = $user->medical_summary ?? null;
                @endphp

                @if($summary)
                    <div class="space-y-4 text-sm text-warm-gray">
                        <div class="bg-white/30 rounded-xl p-4">
                            <span class="font-semibold text-primary block mb-1">Symptômes décrits</span>
                            <p>{{ $summary['symptomes'] ?? 'Aucun symptôme décrit pour le moment.' }}</p>
                        </div>
                        <div class="bg-white/30 rounded-xl p-4">
                            <span class="font-semibold text-primary block mb-1">Antécédents</span>
                            <p>{{ $summary['antecedents'] ?? 'Aucun connu' }}</p>
                        </div>
                        <div class="bg-white/30 rounded-xl p-4">
                            <span class="font-semibold text-primary block mb-1">Allergies</span>
                            <p>{{ $summary['allergies'] ?? 'Aucune connue' }}</p>
                        </div>
                        <div class="bg-white/30 rounded-xl p-4">
                            <span class="font-semibold text-primary block mb-1">Traitements en cours</span>
                            <p>{{ $summary['traitements'] ?? 'Aucun' }}</p>
                        </div>
                        @if(isset($summary['notes']))
                            <div class="bg-white/30 rounded-xl p-4">
                                <span class="font-semibold text-primary block mb-1">Notes supplémentaires</span>
                                <p>{{ $summary['notes'] }}</p>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-8 text-warm-gray/60">
                        <i class="fas fa-robot text-4xl mb-3 opacity-30"></i>
                        <p>Aucun résumé disponible.</p>
                        <p class="text-xs mt-2">Le patient n'a pas encore utilisé le Chat IA.</p>
                    </div>
                @endif

                <div class="flex justify-end mt-6 pt-4 border-t border-white/30">
                    <button @click="summaryOpen = false" class="btn-primary text-sm">Fermer</button>
                </div>
            </div>
        </div>

    </div> <!-- Fin du conteneur Alpine -->

</div> <!-- Fin du conteneur principal -->

<!-- ============================================= -->
<!-- SCRIPTS                                       -->
<!-- ============================================= -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('chatModals', () => ({
            diagnosisOpen: false,
            prescriptionOpen: false,
            consultationOpen: false,
            summaryOpen: false,
            openDiagnosis() { this.diagnosisOpen = true; },
            openPrescription() { this.prescriptionOpen = true; },
            openConsultation() { this.consultationOpen = true; },
            openSummaryModal() { this.summaryOpen = true; },
        }));
    });

    // =============================================
    // GESTION DES MESSAGES (envoi + polling)
    // =============================================
    (function() {
        const container = document.getElementById('messagesContainer');
        const form = document.getElementById('messageForm');
        const input = document.getElementById('messageInput');
        const errorDiv = document.getElementById('errorMessage');
        let lastMessageId = {{ $messages->last() ? $messages->last()->id : 0 }};
        let autoScroll = true;

        function handleScroll() {
            if (!container) return;
            const distanceFromBottom = container.scrollHeight - container.scrollTop - container.clientHeight;
            autoScroll = distanceFromBottom < 30;
        }
        container.addEventListener('scroll', handleScroll);

        function scrollToBottom() {
            if (autoScroll && container) container.scrollTop = container.scrollHeight;
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function formatTime(date) {
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }

        function appendMessage(message, isSent, isNew = true) {
            const div = document.createElement('div');
            div.className = `flex ${isSent ? 'justify-end' : 'justify-start'} message-item animate-fade-in`;
            if (message.id) div.dataset.messageId = message.id;
            const messageText = escapeHtml(message.message);
            const time = message.created_at ? new Date(message.created_at).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'}) : formatTime(new Date());
            div.innerHTML = `
                <div class="max-w-[75%] rounded-2xl px-4 py-2.5 shadow-sm ${isSent ? 'bg-gradient-to-r from-primary to-primary-light text-white' : 'bg-white/90 text-gray-700'}">
                    <p class="break-words text-sm">${messageText}</p>
                    <p class="text-xs mt-1 opacity-70 text-right">${time}${isSent && message.is_read ? ' <i class="fas fa-check-double ml-1"></i>' : ''}</p>
                </div>
            `;
            container.appendChild(div);
            if (isNew) scrollToBottom();
        }

        // Envoi du message
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const msg = input.value.trim();
            if (!msg) return;
            errorDiv.classList.add('hidden');
            input.disabled = true;
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi...';

            try {
                const response = await fetch('{{ route("chat.send", $user) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ message: msg })
                });
                const data = await response.json();
                if (data.success) {
                    appendMessage(data.message, true);
                    input.value = '';
                    lastMessageId = data.message.id;
                } else {
                    throw new Error(data.message || "Erreur d'envoi");
                }
            } catch (err) {
                errorDiv.textContent = err.message || "Impossible d'envoyer le message. Réessayez.";
                errorDiv.classList.remove('hidden');
            } finally {
                input.disabled = false;
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> <span class="hidden sm:inline">Envoyer</span>';
                input.focus();
            }
        });

        // Polling des nouveaux messages
        async function fetchNewMessages() {
            try {
                const response = await fetch('{{ route("chat.new", $user) }}?last_message_id=' + lastMessageId);
                const newMessages = await response.json();
                if (Array.isArray(newMessages) && newMessages.length) {
                    // Afficher l'indicateur de frappe
                    const typingIndicator = document.getElementById('typingIndicator');
                    if (typingIndicator) {
                        typingIndicator.classList.remove('hidden');
                        setTimeout(() => typingIndicator.classList.add('hidden'), 1500);
                    }
                    newMessages.forEach(msg => {
                        appendMessage(msg, false);
                        lastMessageId = msg.id;
                    });
                }
            } catch (err) {
                console.warn("Polling error", err);
            }
        }

        setInterval(fetchNewMessages, 3000);
        setTimeout(scrollToBottom, 200);
    })();
</script>

<style>
    [x-cloak] { display: none !important; }
    .animate-fade-in {
        animation: fadeIn 0.25s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    #messagesContainer::-webkit-scrollbar { width: 6px; }
    #messagesContainer::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 10px; }
    #messagesContainer::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 10px; }
</style>
@endsection