@extends('layouts.medecin')

@section('title', 'Mes patients · SynergyAI')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-display font-bold text-primary">Mes patients</h1>
        <p class="text-warm-gray">Liste des patients que vous suivez.</p>
    </div>

    <div class="glass-card p-6 overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="border-b border-white/30">
                <tr>
                    <th class="text-left py-3 font-semibold text-warm-gray">Nom complet</th>
                    <th class="text-left py-3 font-semibold text-warm-gray">Email</th>
                    <th class="text-left py-3 font-semibold text-warm-gray">Téléphone</th>
                    <th class="text-left py-3 font-semibold text-warm-gray">Dernière consultation</th>
                    <th class="text-left py-3 font-semibold text-warm-gray">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                <tr class="border-b border-white/20 hover:bg-white/10 transition">
                    <td class="py-3">{{ $patient->prenom }} {{ $patient->nom }}</td>
                    <td class="py-3">{{ $patient->email }}</td>
                    <td class="py-3">{{ $patient->telephone ?? '—' }}</td>
                    <td class="py-3">
                        @php
                            $lastConsult = $patient->consultationsAsPatient()
                                ->where('medecin_id', auth()->id())
                                ->latest()
                                ->first();
                        @endphp
                        {{ $lastConsult ? $lastConsult->created_at->format('d/m/Y') : '—' }}
                    </td>
                    <td class="py-3">
                        <a href="{{ route('medecin.patients.show', $patient) }}" class="text-accent hover:underline">Voir fiche</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="py-4 text-center text-warm-gray/60">Aucun patient pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection