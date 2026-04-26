@extends('layouts.medecin')

@section('title', 'Fiche patient')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <h1 class="text-3xl font-bold text-[#2d4e57]">{{ $patient->prenom }} {{ $patient->nom }}</h1>
    <a href="{{ route('medecin.patients.index') }}" class="text-[#4f9da6] hover:underline">&larr; Retour à la liste</a>
</div>

<!-- Infos patient -->
<div class="grid md:grid-cols-2 gap-6 mb-8">
    <div class="glass-card p-6">
        <h2 class="text-xl font-semibold mb-4">Informations personnelles</h2>
        <p><strong>Email :</strong> {{ $patient->email }}</p>
        <p><strong>Téléphone :</strong> {{ $patient->telephone ?? 'Non renseigné' }}</p>
        <p><strong>Date de naissance :</strong> {{ $patient->date_naissance ? \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y') : '—' }}</p>
        <p><strong>Âge :</strong> {{ $patient->date_naissance ? \Carbon\Carbon::parse($patient->date_naissance)->age : '—' }} ans</p>
        <p><strong>Groupe sanguin :</strong> {{ $patient->groupe_sanguin ?? '—' }}</p>
    </div>
    <div class="glass-card p-6">
        <h2 class="text-xl font-semibold mb-4">Données biométriques</h2>
        <p><strong>Poids :</strong> {{ $patient->poids ?? '—' }} kg</p>
        <p><strong>Taille :</strong> {{ $patient->taille ?? '—' }} cm</p>
        <p><strong>Antécédents personnels :</strong> {{ $patient->antecedents_personnels ?: 'Aucun' }}</p>
        <p><strong>Antécédents familiaux :</strong> {{ $patient->antecedents_familiaux ?: 'Aucun' }}</p>
    </div>
</div>

<!-- Consultations -->
<div class="glass-card p-6 mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Consultations</h2>
        <a href="#" class="text-sm text-[#4f9da6] hover:underline">Nouvelle consultation</a>
    </div>
    @if($consultations->count())
    <div class="space-y-4">
        @foreach($consultations as $consult)
        <div class="border-b pb-3">
            <div class="flex justify-between items-start">
                <div>
                    <span class="font-medium">Date : {{ $consult->created_at->format('d/m/Y H:i') }}</span>
                    <span class="ml-3 text-xs px-2 py-1 rounded-full {{ $consult->statut == 'en_attente' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                        {{ $consult->statut == 'en_attente' ? 'En attente' : 'Traité' }}
                    </span>
                </div>
                @if($consult->statut == 'en_attente')
                    <a href="{{ route('medecin.patients.diagnose', $consult) }}" class="text-[#4f9da6] hover:underline text-sm">Diagnostiquer</a>
                @endif
            </div>
            <p class="text-sm text-gray-600 mt-1"><strong>Symptômes :</strong> {{ $consult->symptomes ?: '—' }}</p>
            @if($consult->diagnostic_ia)
                <p class="text-sm text-gray-600"><strong>Prédiction IA :</strong> {{ $consult->diagnostic_ia }}</p>
            @endif
            @if($consult->diagnostic_medecin)
                <p class="text-sm text-gray-600"><strong>Diagnostic médecin :</strong> {{ $consult->diagnostic_medecin }}</p>
            @endif
            @if($consult->recommandations)
                <p class="text-sm text-gray-600"><strong>Recommandations :</strong> {{ $consult->recommandations }}</p>
            @endif
        </div>
        @endforeach
    </div>
    @else
        <p class="text-gray-500">Aucune consultation pour ce patient.</p>
    @endif
</div>

<!-- Prescriptions -->
<div class="glass-card p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Prescriptions</h2>
        <a href="{{ route('medecin.prescriptions.create', $patient) }}" class="btn-soft-primary text-sm py-2 px-4">+ Nouvelle prescription</a>
    </div>
    @if($prescriptions->count())
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="border-b">
                <tr>
                    <th class="text-left py-2">Médicament</th>
                    <th class="text-left py-2">Posologie</th>
                    <th class="text-left py-2">Durée</th>
                    <th class="text-left py-2">Statut</th>
                    <th class="text-left py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prescriptions as $presc)
                <tr class="border-b">
                    <td class="py-2">{{ $presc->medicament->nom }}</td>
                    <td class="py-2">{{ $presc->posologie }}</td>
                    <td class="py-2">{{ $presc->duree_jours ? $presc->duree_jours.' jours' : '—' }}</td>
                    <td class="py-2">
                        <span class="px-2 py-1 rounded-full text-xs 
                            @if($presc->statut == 'active') bg-green-100 text-green-700
                            @elseif($presc->statut == 'terminee') bg-gray-100 text-gray-700
                            @else bg-red-100 text-red-700 @endif">
                            {{ $presc->statut }}
                        </span>
                    </td>
                    <td class="py-2">
                        <a href="{{ route('medecin.prescriptions.edit', $presc) }}" class="text-blue-600 hover:underline mr-2">Modifier</a>
                        <form action="{{ route('medecin.prescriptions.destroy', $presc) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Supprimer cette prescription ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="text-gray-500">Aucune prescription en cours.</p>
    @endif
</div>
@endsection