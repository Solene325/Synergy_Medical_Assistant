@extends('layouts.' . (Auth::user()->role === 'medecin' ? 'medecin' : 'patient'))

@section('title', 'Appel vidéo')

@section('content')
<div class="container mx-auto px-6 py-8 max-w-4xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('chat.conversation', $user) }}" class="text-warm-gray hover:text-primary transition">
            <i class="fas fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-3xl font-display font-bold text-primary">Appel vidéo avec {{ $user->prenom }}</h1>
    </div>

    <div class="glass-card p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold text-primary mb-2">Votre vidéo</h3>
                <video id="localVideo" autoplay muted class="w-full rounded-2xl bg-black/10 border-2 border-white aspect-video object-cover"></video>
            </div>
            <div>
                <h3 class="font-semibold text-primary mb-2">Vidéo de {{ $user->prenom }}</h3>
                <video id="remoteVideo" autoplay class="w-full rounded-2xl bg-black/10 border-2 border-white aspect-video object-cover"></video>
            </div>
        </div>
        <div class="mt-6 flex flex-wrap justify-center gap-4">
            <button id="startCall" class="btn-primary">Démarrer l'appel</button>
            <button id="endCall" class="btn-primary !bg-red-500 hover:!bg-red-600">Raccrocher</button>
        </div>
        <div id="status" class="mt-4 text-center text-sm text-warm-gray">En attente de connexion...</div>
    </div>
</div>

<script src="https://unpkg.com/peerjs@1.5.1/dist/peerjs.min.js"></script>
<script>
    (function() {
        const userId = {{ Auth::id() }};
        const targetUserId = {{ $user->id }};
        const peer = new Peer('user-' + userId, {
            debug: 2
        });
        let conn = null;
        let call = null;

        const localVideo = document.getElementById('localVideo');
        const remoteVideo = document.getElementById('remoteVideo');
        const status = document.getElementById('status');
        const startBtn = document.getElementById('startCall');
        const endBtn = document.getElementById('endCall');

        let localStream = null;

        // Démarrer la caméra
        function startLocalStream() {
            return navigator.mediaDevices.getUserMedia({ video: true, audio: true })
                .then(stream => {
                    localStream = stream;
                    localVideo.srcObject = stream;
                    status.textContent = 'Caméra prête';
                    return stream;
                })
                .catch(err => {
                    alert('Erreur accès caméra: ' + err.message);
                    status.textContent = 'Erreur caméra';
                    throw err;
                });
        }

        // Attente d'appel
        peer.on('call', incomingCall => {
            if (confirm('Appel entrant de ' + incomingCall.peer)) {
                startLocalStream().then(stream => {
                    incomingCall.answer(stream);
                    incomingCall.on('stream', remoteStream => {
                        remoteVideo.srcObject = remoteStream;
                    });
                    incomingCall.on('close', () => {
                        status.textContent = 'Appel terminé par l\'autre utilisateur';
                        remoteVideo.srcObject = null;
                    });
                    call = incomingCall;
                    status.textContent = 'En appel...';
                });
            }
        });

        // Démarrer un appel
        startBtn.addEventListener('click', () => {
            const targetPeerId = 'user-' + targetUserId;
            startLocalStream().then(stream => {
                const outgoingCall = peer.call(targetPeerId, stream);
                outgoingCall.on('stream', remoteStream => {
                    remoteVideo.srcObject = remoteStream;
                });
                outgoingCall.on('close', () => {
                    status.textContent = 'Appel terminé.';
                    remoteVideo.srcObject = null;
                });
                call = outgoingCall;
                status.textContent = 'Appel en cours...';
            });
        });

        // Raccrocher
        endBtn.addEventListener('click', () => {
            if (call) {
                call.close();
                call = null;
                remoteVideo.srcObject = null;
                status.textContent = 'Appel terminé.';
            }
            if (localStream) {
                localStream.getTracks().forEach(track => track.stop());
                localStream = null;
                localVideo.srcObject = null;
            }
        });

        // Gestion des erreurs peer
        peer.on('error', err => {
            status.textContent = 'Erreur: ' + err.message;
        });

        // Connexion établie
        peer.on('open', id => {
            status.textContent = 'Connecté (ID: ' + id + ')';
        });

        // Nettoyer à la sortie
        window.addEventListener('beforeunload', () => {
            if (call) call.close();
            if (localStream) localStream.getTracks().forEach(track => track.stop());
        });
    })();
</script>
@endsection