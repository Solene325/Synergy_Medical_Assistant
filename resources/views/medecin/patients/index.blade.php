@extends('layouts.medecin')

@section('title', 'Mes patients')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-[#2d4e57]">Mes patients</h1>
    <p class="text-[#527a84]">Liste des patients que vous suivez.</p>
</div>

<div class="glass-card p-6">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="border-b">
                <tr>
                    <th class="text-left py-3">Nom complet</th>
                    <th class="text-left py-3">Email</th>
                    <th class="text-left py-3">Téléphone</th>
                    <th class="text-left py-3">Dernière consultation</th>
                    <th class="text-left py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                <tr class="border-b border-gray-100">
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
                        <a href="{{ route('medecin.patients.show', $patient) }}" class="text-[#4f9da6] hover:underline">Voir fiche</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="py-4 text-center text-gray-500">Aucun patient pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection