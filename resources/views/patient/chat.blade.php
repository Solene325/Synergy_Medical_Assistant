@extends('layouts.pat')

@section('title', 'Chat IA médical · SynergyAI')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="glass-card overflow-hidden flex flex-col" style="height: 70vh;">
        <!-- En-tête du chat -->
        <div class="p-5 border-b border-white/30 flex items-center gap-3">
            <div class="soft-icon !w-12 !h-12">
                <i class="fas fa-robot text-2xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-[#2d4e57]">Assistant médical SynergyAI</h2>
                <p class="text-sm text-[#527a84]">Je vous aide à analyser vos symptômes – <span class="text-red-500">en cas d’urgence, appelez le 15</span></p>
            </div>
        </div>

        <!-- Zone des messages -->
        <div id="chatMessages" class="flex-1 overflow-y-auto p-5 space-y-4">
            <!-- Message d'accueil -->
            <div class="message-bot flex gap-3 items-start">
                <div class="soft-icon !w-10 !h-10 flex-shrink-0"><i class="fas fa-robot text-xl"></i></div>
                <div class="bg-white/50 backdrop-blur-sm rounded-2xl p-4 max-w-[80%]">
                    Bonjour ! Je suis votre assistant santé. Décrivez-moi vos symptômes, je vous orienterai au mieux. 🔍
                </div>
            </div>

            <!-- Historique des messages (affiché depuis la session) -->
            @foreach($history as $msg)
                <!-- Message utilisateur -->
                <div class="message-user flex gap-3 items-start justify-end">
                    <div class="bg-[#4f9da6]/20 rounded-2xl p-4 max-w-[80%]">
                        {{ $msg['user'] }}
                    </div>
                    <div class="soft-icon !w-10 !h-10 flex-shrink-0"><i class="fas fa-user text-xl"></i></div>
                </div>

                <!-- Réponse bot avec les maladies si présentes -->
                <div class="message-bot flex gap-3 items-start mt-2">
                    <div class="soft-icon !w-10 !h-10 flex-shrink-0"><i class="fas fa-robot text-xl"></i></div>
                    <div class="bg-white/50 backdrop-blur-sm rounded-2xl p-4 max-w-[85%]">
                        @if(isset($msg['diseases']) && count($msg['diseases']) > 0)
                            <p class="font-semibold text-[#2d4e57] mb-3">🔍 Hypothèses diagnostiques</p>
                            @foreach($msg['diseases'] as $disease)
                                <div class="mb-4">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="font-medium">{{ $disease['name'] }}</span>
                                        <span>{{ $disease['probability'] }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200/50 rounded-full h-2">
                                        <div class="bg-[#4f9da6] h-2 rounded-full" style="width: {{ $disease['probability'] }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-2">{{ $disease['advice'] }}</p>
                                </div>
                            @endforeach
                            <div class="text-sm text-[#527a84] mt-3 pt-2 border-t border-white/40">
                                {{ $msg['assistant'] }}
                            </div>
                        @else
                            {!! nl2br(e($msg['assistant'])) !!}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Zone de saisie -->
        <div class="p-5 border-t border-white/30 bg-white/20 backdrop-blur-sm">
            <div class="flex gap-3">
                <textarea id="messageInput" rows="1" placeholder="Décrivez vos symptômes (ex: fièvre, toux, fatigue, douleur abdominale...)" class="input-modern flex-1 resize-none rounded-2xl p-3 bg-white/70 focus:bg-white transition"></textarea>
                <button id="sendBtn" class="btn-soft-primary !px-6 !py-3 rounded-2xl">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
            <p class="text-[10px] text-gray-400 mt-2 text-center">⚡ Réponses basées sur l’IA médicale – ne remplace pas une consultation physique.</p>
        </div>
    </div>
</div>

<script>
    const messageInput = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');
    const chatContainer = document.getElementById('chatMessages');

    function appendUserMessage(text) {
        const userDiv = document.createElement('div');
        userDiv.className = 'message-user flex gap-3 items-start justify-end';
        userDiv.innerHTML = `
            <div class="bg-[#4f9da6]/20 rounded-2xl p-4 max-w-[80%]">${escapeHtml(text)}</div>
            <div class="soft-icon !w-10 !h-10 flex-shrink-0"><i class="fas fa-user text-xl"></i></div>
        `;
        chatContainer.appendChild(userDiv);
        scrollToBottom();
    }

    function appendBotMessage(content, isUrgent = false) {
        const botDiv = document.createElement('div');
        botDiv.className = 'message-bot flex gap-3 items-start mt-2';
        const urgentClass = isUrgent ? 'border-l-4 border-red-500 bg-red-50/30' : '';
        botDiv.innerHTML = `
            <div class="soft-icon !w-10 !h-10 flex-shrink-0"><i class="fas fa-robot text-xl"></i></div>
            <div class="bg-white/50 backdrop-blur-sm rounded-2xl p-4 max-w-[85%] ${urgentClass}">
                ${content}
            </div>
        `;
        chatContainer.appendChild(botDiv);
        scrollToBottom();
    }

    function appendTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.id = 'typingIndicator';
        typingDiv.className = 'message-bot flex gap-3 items-start mt-2';
        typingDiv.innerHTML = `
            <div class="soft-icon !w-10 !h-10 flex-shrink-0"><i class="fas fa-robot text-xl"></i></div>
            <div class="bg-white/50 backdrop-blur-sm rounded-2xl p-4">
                <div class="typing-dots">Analyse en cours</div>
            </div>
        `;
        chatContainer.appendChild(typingDiv);
        scrollToBottom();
    }

    function removeTypingIndicator() {
        const el = document.getElementById('typingIndicator');
        if (el) el.remove();
    }

    function scrollToBottom() {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        }).replace(/[\uD800-\uDBFF][\uDC00-\uDFFF]/g, function(c) {
            return c;
        });
    }

    // Afficher les maladies avec barres de progression
    function renderDiseases(diseases, additionalMessage) {
        let html = '<div class="font-semibold text-[#2d4e57] mb-3">🔍 Hypothèses diagnostiques</div>';
        diseases.forEach(d => {
            const prob = Math.min(100, Math.max(0, parseFloat(d.probability) || 0));
            html += `
                <div class="mb-4">
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-medium">${escapeHtml(d.name)}</span>
                        <span>${prob}%</span>
                    </div>
                    <div class="w-full bg-gray-200/50 rounded-full h-2">
                        <div class="bg-[#4f9da6] h-2 rounded-full" style="width: ${prob}%"></div>
                    </div>
                    <p class="text-xs text-gray-600 mt-2">${escapeHtml(d.advice)}</p>
                </div>
            `;
        });
        if (additionalMessage) {
            html += `<div class="text-sm text-[#527a84] mt-3 pt-2 border-t border-white/40">${escapeHtml(additionalMessage)}</div>`;
        }
        return html;
    }

    async function sendMessage() {
        const message = messageInput.value.trim();
        if (!message) return;
        messageInput.value = '';
        appendUserMessage(message);
        appendTypingIndicator();

        try {
            const response = await fetch('{{ route("patient.chat.send") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            });

            if (!response.ok) throw new Error('Erreur réseau');

            const data = await response.json();
            removeTypingIndicator();

            if (data.error) {
                appendBotMessage('❌ ' + data.error);
                return;
            }

            let displayContent = '';
            if (data.diseases && data.diseases.length) {
                displayContent = renderDiseases(data.diseases, data.reply);
            } else {
                displayContent = data.reply.replace(/\n/g, '<br>');
            }

            appendBotMessage(displayContent, data.urgent);

            if (data.warning) {
                const warnDiv = document.createElement('div');
                warnDiv.className = 'bg-red-100/60 border-l-4 border-red-500 rounded-xl p-3 mt-2 text-sm text-red-800';
                warnDiv.innerText = data.warning;
                chatContainer.appendChild(warnDiv);
                scrollToBottom();
            }
        } catch (err) {
            removeTypingIndicator();
            appendBotMessage('⚠️ Le service est momentanément indisponible. Veuillez réessayer plus tard.');
            console.error(err);
        }
    }

    sendBtn.addEventListener('click', sendMessage);
    messageInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    // Petite animation typing
    const style = document.createElement('style');
    style.textContent = `
        .typing-dots::after {
            content: '...';
            animation: blink 1.5s steps(3, end) infinite;
            display: inline-block;
            width: 24px;
            text-align: left;
        }
        @keyframes blink {
            0% { content: '.'; }
            33% { content: '..'; }
            66% { content: '...'; }
            100% { content: ''; }
        }
        .input-modern {
            background: rgba(255,255,255,0.7);
            border: 1px solid rgba(255,255,255,0.8);
            border-radius: 24px;
            padding: 0.75rem 1.25rem;
            transition: all 0.2s;
        }
        .input-modern:focus {
            outline: none;
            border-color: #4f9da6;
            background: white;
            box-shadow: 0 0 0 3px rgba(79,157,166,0.2);
        }
    `;
    document.head.appendChild(style);
</script>
@endsection