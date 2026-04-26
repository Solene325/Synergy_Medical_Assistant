@extends('layouts.admin')

@section('content')
<div class="text-center py-12">
    <div class="glass-card p-12 max-w-2xl mx-auto">
        <i class="fas fa-microchip text-6xl text-[#4f9da6] mb-6"></i>
        <h2 class="text-3xl font-bold text-[#2d4e57] mb-4">Réception de données d’appareil tiers</h2>
        <p class="text-[#527a84] text-lg mb-6">
            Cette fonctionnalité permettra bientôt de recevoir et visualiser en temps réel les données 
            provenant de dispositifs médicaux connectés (tensiomètres, glucomètres, etc.).
        </p>
        <div class="bg-[#f9c7b5]/30 rounded-full p-3 inline-block">
            <span class="text-[#2d4e57] font-semibold"><i class="fas fa-hourglass-half mr-2"></i> En développement actif</span>
        </div>
        <p class="mt-8 text-sm text-gray-500">Version bêta – Module "MedTech Connect" prévu pour la prochaine release.</p>
    </div>
</div>
@endsection