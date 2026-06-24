@extends('layouts.admin')

@section('title', 'Médicaments · SynergyAI')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-primary section-title-soft">Médicaments</h2>
    </div>

    <div class="glass-card p-6">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Forme</th>
                        <th>Dosage standard</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medicaments as $medicament)
                    <tr>
                        <td>{{ $medicament->id }}</td>
                        <td>{{ $medicament->nom }}</td>
                        <td>{{ $medicament->forme ?? '—' }}</td>
                        <td>{{ $medicament->dosage_standard ?? '—' }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.medicaments.destroy', $medicament) }}" onsubmit="return confirm('Supprimer ce médicament ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-outline-danger text-sm px-3 py-1">
                                    <i class="fas fa-trash-alt"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-8 text-warm-gray">Aucun médicament enregistré.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $medicaments->links() }}
        </div>
    </div>
</div>
@endsection