@extends('layouts.admin')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-[#2d4e57] section-title-soft">Médicaments</h2>
    </div>

    <div class="glass-card p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-white/50">
                        <th class="py-3 px-2">ID</th>
                        <th class="py-3 px-2">Nom</th>
                        <th class="py-3 px-2">Forme</th>
                        <th class="py-3 px-2">Dosage standard</th>
                        <th class="py-3 px-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medicaments as $medicament)
                    <tr class="border-b border-white/30 hover:bg-white/20">
                        <td class="py-3 px-2">{{ $medicament->id }}</td>
                        <td class="py-3 px-2">{{ $medicament->nom }}</td>
                        <td class="py-3 px-2">{{ $medicament->forme ?? '—' }}</td>
                        <td class="py-3 px-2">{{ $medicament->dosage_standard ?? '—' }}</td>
                        <td class="py-3 px-2">
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
                    <tr><td colspan="5" class="text-center py-8">Aucun médicament enregistré.</td></tr>
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