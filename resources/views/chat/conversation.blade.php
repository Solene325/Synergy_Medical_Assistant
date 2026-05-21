@php
    $userRole = Auth::user()->role;
    $layout = $userRole === 'medecin' ? 'layouts.medecin' : 'layouts.pat';
@endphp

@extends($layout)
@section('title', 'Discussion')

@section('content')
<div class="container mx-auto px-4 sm:px-6 py-6 max-w-5xl">
    <!-- En-tête conversation -->
    <div class="flex flex-wrap items-center gap-4 mb-6">
        <div class="flex items-center gap-4 bg-white/30 backdrop-blur-sm rounded-2xl px-5 py-3 flex-1">
            <div class="w-14 h-14 rounded-full bg-white/50 flex items-center justify-center overflow-hidden shadow-md">
                @if($user->photo_profil)
                    <img src="{{ Storage::url($user->photo_profil) }}" class="w-full h-full object-cover">
                @else
                    <i class="fas fa-{{ $user->role === 'patient' ? 'user' : 'user-md' }} text-3xl text-[#4f9da6]"></i>
                @endif
            </div>
            <div>
                <h1 class="text-xl font-bold text-[#2d4e57]">
                    @if($user->role === 'medecin') Dr. @endif{{ $user->prenom }} {{ $user->nom }}
                </h1>
                <p class="text-sm text-gray-600">
                    {{ $user->role === 'medecin' ? ($user->specialite ?? 'Généraliste') : 'Patient' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Zone de discussion -->
    <div class="glass-card p-0 overflow-hidden shadow-xl">
        <div id="messagesContainer" class="h-[500px] overflow-y-auto p-4 space-y-3 bg-gradient-to-b from-[#f9f3e8]/50 to-[#f9f3e8]/80">
            @forelse($messages as $message)
                <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }} message-item" data-message-id="{{ $message->id }}">
                    <div class="max-w-[75%] rounded-2xl px-4 py-2.5 shadow-sm
                                {{ $message->sender_id === Auth::id() 
                                    ? 'bg-gradient-to-r from-[#4f9da6] to-[#56b4be] text-white' 
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
                <div class="text-center text-gray-500 py-10">
                    <i class="fas fa-comments text-5xl mb-3 opacity-30"></i>
                    <p>Aucun message pour le moment. Commencez la conversation !</p>
                </div>
            @endforelse
        </div>

        <!-- Indicateur de frappe -->
        <div id="typingIndicator" class="hidden px-5 py-2 text-xs text-gray-500 italic bg-white/40 border-t border-gray-100">
            <i class="fas fa-ellipsis-h mr-1"></i> L'interlocuteur est en train d'écrire...
        </div>

        <!-- Formulaire d'envoi -->
        <form id="messageForm" class="p-4 border-t border-gray-200 flex flex-wrap gap-3 bg-white/40 backdrop-blur-sm">
            @csrf
            <div class="flex-1 relative">
                <input type="text" id="messageInput" placeholder="Écrivez votre message..." autocomplete="off"
                       class="w-full px-5 py-3.5 rounded-full bg-white border-0 focus:ring-2 focus:ring-[#4f9da6] outline-none shadow-inner transition">
            </div>
            <button type="submit" class="btn-soft-primary !py-3 !px-6 flex items-center gap-2">
                <i class="fas fa-paper-plane"></i> <span class="hidden sm:inline">Envoyer</span>
            </button>
        </form>
        <div id="errorMessage" class="hidden text-red-500 text-sm px-5 pb-3"></div>
    </div>
</div>

<!-- Scripts (identique à la version précédente, mais adapté aux routes) -->
<script>
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
                <div class="max-w-[75%] rounded-2xl px-4 py-2.5 shadow-sm ${isSent ? 'bg-gradient-to-r from-[#4f9da6] to-[#56b4be] text-white' : 'bg-white/90 text-gray-700'}">
                    <p class="break-words text-sm">${messageText}</p>
                    <p class="text-xs mt-1 opacity-70 text-right">${time}${isSent && message.is_read ? ' <i class="fas fa-check-double ml-1"></i>' : ''}</p>
                </div>
            `;
            container.appendChild(div);
            if (isNew) scrollToBottom();
        }

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

        async function fetchNewMessages() {
            try {
                const response = await fetch('{{ route("chat.new", $user) }}?last_message_id=' + lastMessageId);
                const newMessages = await response.json();
                if (Array.isArray(newMessages) && newMessages.length) {
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
        setTimeout(scrollToBottom, 100);
    })();
</script>

<style>
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