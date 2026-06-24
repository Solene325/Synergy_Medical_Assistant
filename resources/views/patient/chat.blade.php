@extends('layouts.chat') 

@section('title', 'Assistant médical · SynergyAI')

@section('content')
<div x-data="chatApp()" class="h-full" style="min-height: 80vh;">
    <!-- Fond décoratif -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-accent/5 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-primary/3 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-gold/5 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-4 gap-6">

        <!-- Sidebar gauche : Résumé et historique -->
        <div class="lg:col-span-1 order-2 lg:order-1">
            <div class="glass-card p-4 sticky top-24 max-h-[75vh] overflow-y-auto">
                <!-- Historique -->
                <div class="mb-6">
                    <h3 class="font-display font-semibold text-primary text-sm flex items-center gap-2 mb-3">
                        <i class="fas fa-clock text-accent"></i> Historique
                    </h3>
                    <div class="space-y-1 max-h-40 overflow-y-auto">
                        <template x-for="msg in messages.slice().reverse()" :key="msg.timestamp">
                            <div x-show="msg.role === 'user'" class="text-xs text-warm-gray/70 truncate px-2 py-1 hover:bg-white/30 rounded">
                                <span class="font-medium" x-text="msg.content.substring(0, 30) + (msg.content.length > 30 ? '...' : '')"></span>
                            </div>
                        </template>
                        <p x-show="messages.length === 0" class="text-xs text-warm-gray/40">Aucun message</p>
                    </div>
                </div>

                <!-- Résumé médical -->
                <div>
                    <button @click="showSummary = !showSummary" class="w-full flex items-center justify-between text-sm font-semibold text-primary">
                        <span><i class="fas fa-file-medical-alt text-accent mr-2"></i>Résumé médical</span>
                        <i class="fas fa-chevron-down transition-transform" :class="{'rotate-180': showSummary}"></i>
                    </button>
                    <div x-show="showSummary" x-transition.duration.300ms class="mt-3 text-xs text-warm-gray leading-relaxed space-y-2">
                        <div class="bg-white/30 rounded-xl p-3 space-y-1">
                            <p><span class="font-medium">Symptômes :</span> <span x-text="medicalSummary.symptomes || 'Aucun'"></span></p>
                            <p><span class="font-medium">Antécédents :</span> <span x-text="medicalSummary.antecedents || 'Aucun'"></span></p>
                            <p><span class="font-medium">Allergies :</span> <span x-text="medicalSummary.allergies || 'Aucune'"></span></p>
                            <p><span class="font-medium">Traitements :</span> <span x-text="medicalSummary.traitements || 'Aucun'"></span></p>
                        </div>
                        <button @click="generateSummary()" class="w-full btn-primary text-xs !py-1.5 !px-2 flex items-center justify-center gap-2">
                            <i class="fas fa-sync-alt" :class="{'animate-spin': loadingSummary}"></i>
                            Mettre à jour
                        </button>
                    </div>
                </div>

                <!-- Bouton contact médecin -->
                @if(auth()->user()->medecin_id)
                    <a href="{{ route('chat.conversation', auth()->user()->medecinTraitant) }}" class="mt-4 btn-primary text-xs !py-2 !px-3 w-full flex items-center justify-center gap-2 bg-accent hover:bg-[#c46a37]">
                        <i class="fas fa-user-md"></i> Contacter mon médecin
                    </a>
                @else
                    <a href="{{ route('patient.medecins.index') }}" class="mt-4 btn-primary text-xs !py-2 !px-3 w-full flex items-center justify-center gap-2 bg-accent hover:bg-[#c46a37]">
                        <i class="fas fa-search"></i> Trouver un médecin
                    </a>
                @endif
            </div>
        </div>

        <!-- Chat principal -->
        <div class="lg:col-span-3 order-1 lg:order-2">
            <div class="glass-card overflow-hidden flex flex-col shadow-soft-lg" style="height: 75vh;">

                <!-- En-tête du chat -->
                <div class="p-5 border-b border-white/30 flex items-center justify-between flex-wrap gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-full bg-gradient-to-br from-primary to-primary-light flex items-center justify-center text-white shadow-lg">
                            <i class="fas fa-heartbeat text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-display font-bold text-primary">Assistant médical</h2>
                            <p class="text-xs text-warm-gray flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-green-400 inline-block"></span>
                                <span x-text="currentLangLabel"></span>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-wrap">
                        <!-- Sélecteur de langue -->
                        <div class="relative" @click.away="langOpen = false">
                            <button @click="langOpen = !langOpen" class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/50 backdrop-blur-sm border border-white/50 text-sm text-warm-gray hover:text-primary transition">
                                <span x-text="langs.find(l => l.code === currentLang)?.flag || '🇫🇷'"></span>
                                <span class="hidden sm:inline" x-text="langs.find(l => l.code === currentLang)?.name || 'Français'"></span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div x-show="langOpen" x-transition.duration.200ms class="absolute right-0 mt-2 bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg border border-white/50 p-1 min-w-[150px] z-50">
                                <template x-for="l in langs" :key="l.code">
                                    <div @click="setLanguage(l.code)" class="flex items-center gap-2 px-3 py-1.5 rounded-xl hover:bg-primary/5 cursor-pointer transition" :class="{'bg-primary/10': currentLang === l.code}">
                                        <span x-text="l.flag"></span>
                                        <span class="text-sm" x-text="l.name"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <button @click="toggleVoice" class="w-9 h-9 rounded-full flex items-center justify-center transition border border-white/50" :class="isListening ? 'bg-red-500 text-white shadow-lg shadow-red-500/30' : 'bg-white/50 text-warm-gray hover:text-primary'">
                            <i class="fas fa-microphone" :class="{'animate-pulse': isListening}"></i>
                        </button>

                        <button @click="clearHistory()" class="w-9 h-9 rounded-full bg-white/50 flex items-center justify-center text-warm-gray hover:text-red-400 transition border border-white/50">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>

                <!-- Zone des messages -->
                <div id="chatMessages" class="flex-1 overflow-y-auto p-5 space-y-4 bg-gradient-to-b from-cream/20 to-white/10">
                    <!-- Message d'accueil -->
                    <div x-show="messages.length === 0" class="flex flex-col items-center justify-center h-full text-center text-warm-gray/60 py-10">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-primary/10 to-accent/10 flex items-center justify-center text-4xl text-primary/20 mb-4">
                            <i class="fas fa-comment-medical"></i>
                        </div>
                        <h3 class="text-xl font-display font-semibold text-primary">Assistant médical</h3>
                        <p class="text-sm max-w-md mt-2">Bonjour ! Je suis là pour vous écouter et vous aider à comprendre vos symptômes. Prenez votre temps, décrivez-moi ce que vous ressentez.</p>
                    </div>

                    <!-- Messages -->
                    <template x-for="(msg, index) in messages" :key="index">
                        <div>
                            <div x-show="msg.role === 'user'" class="flex gap-3 items-start justify-end">
                                <div class="bg-primary/10 backdrop-blur-sm rounded-2xl rounded-tr-sm p-4 max-w-[80%]">
                                    <p class="text-sm text-primary" x-text="msg.content"></p>
                                    <p class="text-[10px] text-warm-gray/40 mt-1 text-right" x-text="formatTime(msg.timestamp)"></p>
                                </div>
                                <div class="w-9 h-9 rounded-full bg-primary/20 flex items-center justify-center text-primary flex-shrink-0">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                            </div>

                            <div x-show="msg.role === 'assistant'" class="flex gap-3 items-start mt-3">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary to-primary-light flex items-center justify-center text-white flex-shrink-0 shadow-md">
                                    <i class="fas fa-heartbeat text-sm"></i>
                                </div>
                                <div class="bg-white/50 backdrop-blur-sm rounded-2xl rounded-tl-sm p-4 max-w-[85%]" :class="{'border-l-4 border-red-500': msg.urgent}">
                                    <p class="text-sm text-warm-gray leading-relaxed" x-text="msg.content"></p>
                                    
                                    <!-- Affichage des hypothèses seulement si présentes -->
                                    <template x-if="msg.diseases && msg.diseases.length">
                                        <div class="mt-3 pt-3 border-t border-white/30">
                                            <p class="font-semibold text-primary text-sm flex items-center gap-2">
                                                <i class="fas fa-stethoscope text-accent"></i> 
                                                <span>Pistes possibles (à confirmer par un médecin)</span>
                                            </p>
                                            <template x-for="disease in msg.diseases" :key="disease.name">
                                                <div class="mt-2">
                                                    <div class="flex justify-between text-xs">
                                                        <span class="font-medium text-primary" x-text="disease.name"></span>
                                                        <span class="text-warm-gray" x-text="disease.probability + '%'"></span>
                                                    </div>
                                                    <div class="w-full bg-gray-200/50 rounded-full h-1.5">
                                                        <div class="h-1.5 rounded-full bg-gradient-to-r from-accent to-primary" :style="'width: ' + Math.min(100, disease.probability) + '%'"></div>
                                                    </div>
                                                    <p class="text-xs text-warm-gray mt-1" x-text="disease.advice"></p>
                                                </div>
                                            </template>
                                            <p class="text-[10px] text-warm-gray/60 mt-2 italic">
                                                ⚠️ Ces hypothèses ne remplacent pas un avis médical. Consultez un professionnel si les symptômes persistent.
                                            </p>
                                        </div>
                                    </template>

                                    <!-- Indicateur si l'assistant est en phase de questionnement (pas de maladies) -->
                                    <template x-if="!msg.diseases || msg.diseases.length === 0">
                                        <p class="text-[10px] text-warm-gray/40 mt-1 italic">
                                            L'assistant recueille des informations pour mieux vous comprendre.
                                        </p>
                                    </template>

                                    <p x-show="msg.urgent" class="mt-2 text-xs font-semibold text-red-600 flex items-center gap-1">
                                        <i class="fas fa-exclamation-triangle"></i> Urgence potentielle - Consultez immédiatement
                                    </p>
                                    <p class="text-[10px] text-warm-gray/40 mt-2 text-right" x-text="formatTime(msg.timestamp)"></p>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div x-show="isTyping" class="flex gap-3 items-start mt-3">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary to-primary-light flex items-center justify-center text-white flex-shrink-0 shadow-md">
                            <i class="fas fa-heartbeat text-sm"></i>
                        </div>
                        <div class="bg-white/50 backdrop-blur-sm rounded-2xl p-4">
                            <div class="flex gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-primary/40 animate-bounce" style="animation-delay: 0s"></span>
                                <span class="w-2 h-2 rounded-full bg-primary/40 animate-bounce" style="animation-delay: 0.15s"></span>
                                <span class="w-2 h-2 rounded-full bg-primary/40 animate-bounce" style="animation-delay: 0.3s"></span>
                            </div>
                            <span class="text-xs text-warm-gray/50 ml-1">L'assistant réfléchit...</span>
                        </div>
                    </div>
                </div>

                <!-- Zone de saisie -->
                <div class="p-5 border-t border-white/30 bg-white/10 backdrop-blur-sm">
                    <form @submit.prevent="sendMessage" class="flex gap-3">
                        <div class="flex-1 relative">
                            <textarea x-model="newMessage" rows="1" placeholder="Décrivez vos symptômes..." class="input-modern w-full resize-none rounded-2xl p-3 pr-12 bg-white/70 focus:bg-white transition text-sm" style="min-height: 48px; max-height: 120px;" @keydown.enter.prevent="if(!$event.shiftKey) sendMessage()" x-ref="messageInput"></textarea>
                            <button type="button" @click="clearMessage" class="absolute right-3 top-1/2 -translate-y-1/2 text-warm-gray/30 hover:text-red-400 transition text-xs" x-show="newMessage.length > 0">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </div>
                        <button type="submit" class="btn-primary !px-5 !py-2 rounded-2xl flex items-center gap-2 text-sm" :disabled="isTyping || !newMessage.trim()">
                            <i class="fas fa-paper-plane" :class="{'animate-pulse': isTyping}"></i>
                            <span class="hidden sm:inline">Envoyer</span>
                        </button>
                    </form>
                    <p class="text-[10px] text-warm-gray/40 mt-2 text-center flex items-center justify-center gap-2">
                        <span class="w-1 h-1 rounded-full bg-warm-gray/20"></span>
                        Réponses basées sur l'IA médicale – ne remplace pas une consultation physique
                        <span class="w-1 h-1 rounded-full bg-warm-gray/20"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .input-modern {
        background: rgba(255,255,255,0.7);
        border: 1px solid rgba(255,255,255,0.6);
        border-radius: 24px;
        padding: 0.75rem 1.25rem;
        transition: all 0.25s;
        font-family: 'DM Sans', sans-serif;
    }
    .input-modern:focus {
        outline: none;
        border-color: #0A4A3B;
        background: white;
        box-shadow: 0 0 0 3px rgba(10,74,59,0.08);
    }
    .input-modern::placeholder {
        color: #A09080;
    }
</style>

<script>
    function chatApp() {
        return {
            messages: @json($history ?? []),
            newMessage: '',
            isTyping: false,
            isListening: false,
            showSummary: false,
            loadingSummary: false,
            langOpen: false,
            currentLang: localStorage.getItem('synergyLang') || 'fr',
            medicalSummary: @json($medicalSummary ?? []),
            langs: [
                { code: 'fr', name: 'Français', flag: '🇫🇷' },
                { code: 'ar', name: 'العربية', flag: '🇲🇦' }
            ],
            recognition: null,

            init() {
                this.scrollToBottom();
                const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
                if (SR) {
                    this.recognition = new SR();
                    this.recognition.continuous = false;
                    this.recognition.interimResults = true;
                    this.recognition.lang = this.getSpeechLang();
                    this.recognition.onresult = (e) => {
                        let transcript = '';
                        for (let i = e.resultIndex; i < e.results.length; i++) {
                            transcript += e.results[i][0].transcript;
                        }
                        this.newMessage = transcript;
                        this.$refs.messageInput.focus();
                    };
                    this.recognition.onend = () => { this.isListening = false; };
                    this.recognition.onerror = () => { this.isListening = false; };
                }
            },

            get currentLangLabel() {
                const l = this.langs.find(l => l.code === this.currentLang);
                return l ? `${l.flag} ${l.name}` : '🇫🇷 Français';
            },

            getSpeechLang() {
                const map = { 'fr': 'fr-FR', 'ar': 'ar-MA' };
                return map[this.currentLang] || 'fr-FR';
            },

            setLanguage(code) {
                this.currentLang = code;
                localStorage.setItem('synergyLang', code);
                this.langOpen = false;
                if (this.recognition) {
                    this.recognition.lang = this.getSpeechLang();
                }
            },

            toggleVoice() {
                if (!this.recognition) {
                    alert('Reconnaissance vocale non supportée.');
                    return;
                }
                if (this.isListening) {
                    this.recognition.stop();
                    this.isListening = false;
                } else {
                    this.newMessage = '';
                    this.recognition.lang = this.getSpeechLang();
                    this.recognition.start();
                    this.isListening = true;
                }
            },

            clearMessage() {
                this.newMessage = '';
                this.$refs.messageInput.focus();
            },

            async sendMessage() {
                const message = this.newMessage.trim();
                if (!message || this.isTyping) return;
                this.newMessage = '';
                this.messages.push({
                    role: 'user',
                    content: message,
                    timestamp: new Date().toISOString()
                });
                this.scrollToBottom();
                this.isTyping = true;

                try {
                    const response = await fetch('{{ route("patient.chat.send") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            message: message,
                            lang: this.currentLang
                        })
                    });
                    const data = await response.json();
                    this.isTyping = false;
                    if (data.error) {
                        this.messages.push({
                            role: 'assistant',
                            content: '❌ ' + data.error,
                            timestamp: new Date().toISOString()
                        });
                        this.scrollToBottom();
                        return;
                    }
                    this.messages.push({
                        role: 'assistant',
                        content: data.reply,
                        diseases: data.diseases || [],
                        urgent: data.urgent || false,
                        timestamp: new Date().toISOString()
                    });
                    if (data.summary) {
                        this.medicalSummary = data.summary;
                    }
                    this.scrollToBottom();
                } catch (err) {
                    this.isTyping = false;
                    this.messages.push({
                        role: 'assistant',
                        content: '⚠️ Service indisponible.',
                        timestamp: new Date().toISOString()
                    });
                    this.scrollToBottom();
                }
            },

            async generateSummary() {
                this.loadingSummary = true;
                try {
                    const resp = await fetch('{{ route("patient.chat.summary") }}');
                    const data = await resp.json();
                    if (data.summary) {
                        this.medicalSummary = data.summary;
                        this.showSummary = true;
                    }
                } catch (e) {
                    console.error(e);
                }
                this.loadingSummary = false;
            },

            async clearHistory() {
                if (!confirm('Effacer l\'historique ?')) return;
                await fetch('{{ route("patient.chat.clear") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
                this.messages = [];
            },

            formatTime(iso) {
                if (!iso) return '';
                const d = new Date(iso);
                return d.toLocaleString('fr-FR', { hour: '2-digit', minute: '2-digit' });
            },

            scrollToBottom() {
                const el = document.getElementById('chatMessages');
                if (el) setTimeout(() => { el.scrollTop = el.scrollHeight; }, 50);
            }
        };
    }
</script>
@endsection