@extends('layouts.medecin')

@section('title', 'Tableau de bord')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-[#2d4e57]">Tableau de bord</h1>
    <p class="text-[#527a84]">Bonjour Dr. {{ auth()->user()->prenom }} {{ auth()->user()->nom }}, bienvenue !</p>
</div>

<div class="grid md:grid-cols-3 gap-6">
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <i class="fas fa-clock text-4xl text-[#4f9da6]"></i>
            <span class="text-3xl font-bold">{{ $consultationsEnAttente }}</span>
        </div>
        <p class="mt-3 text-gray-600">Consultations en attente</p>
    </div>
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <i class="fas fa-prescription-bottle text-4xl text-[#4f9da6]"></i>
            <span class="text-3xl font-bold">{{ $prescriptionsActives }}</span>
        </div>
        <p class="mt-3 text-gray-600">Prescriptions actives</p>
    </div>
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <i class="fas fa-user-friends text-4xl text-[#4f9da6]"></i>
            <span class="text-3xl font-bold">{{ $patientsUniques }}</span>
        </div>
        <p class="mt-3 text-gray-600">Patients suivis</p>
    </div>
</div>

<div class="glass-card p-6 mt-10">
    <h2 class="text-xl font-semibold mb-4">Dernières consultations</h2>
    <table class="w-full text-sm">
        <thead class="border-b">
            <tr>
                <th class="text-left py-2">Patient</th>
                <th class="text-left py-2">Date</th>
                <th class="text-left py-2">Statut</th>
                <th class="text-left py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse(auth()->user()->consultationsAsMedecin()->latest()->limit(5)->get() as $consult)
            <tr class="border-b border-gray-100">
                <td class="py-2">{{ $consult->patient->prenom }} {{ $consult->patient->nom }}</td>
                <td class="py-2">{{ $consult->created_at->format('d/m/Y H:i') }}</td>
                <td class="py-2">
                    <span class="px-2 py-1 rounded-full text-xs {{ $consult->statut == 'en_attente' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                        {{ $consult->statut == 'en_attente' ? 'En attente' : 'Traité' }}
                    </span>
                </td>
                <td class="py-2">
                    @if($consult->statut == 'en_attente')
                        <a href="{{ route('medecin.patients.diagnose', $consult) }}" class="text-[#4f9da6] hover:underline">Diagnostiquer</a>
                    @else
                        <a href="{{ route('medecin.patients.show', $consult->patient_id) }}" class="text-[#4f9da6] hover:underline">Voir détails</a>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="py-4 text-center text-gray-500">Aucune consultation récente.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection