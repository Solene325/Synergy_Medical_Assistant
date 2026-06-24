@extends('layouts.admin')

@section('title', 'Appareils tiers · SynergyAI')

@section('content')
<div class="text-center py-12">
    <div class="glass-card p-12 max-w-2xl mx-auto stat-card-glow">
        <i class="fas fa-microchip text-6xl text-primary-light mb-6"></i>
        <h2 class="text-3xl font-display font-bold text-primary mb-4">Réception de données d’appareil tiers</h2>
        <p class="text-warm-gray text-lg mb-6">
            Cette fonctionnalité permettra bientôt de recevoir et visualiser en temps réel les données 
            provenant de dispositifs médicaux connectés (tensiomètres, glucomètres, etc.).
        </p>
        <div class="bg-accent/10 rounded-full p-3 inline-block">
            <span class="text-primary font-semibold"><i class="fas fa-hourglass-half mr-2"></i> En développement actif</span>
        </div>
        <p class="mt-8 text-sm text-warm-gray/70">Version bêta – Module "MedTech Connect" prévu pour la prochaine release.</p>
    </div>
</div>
@endsection