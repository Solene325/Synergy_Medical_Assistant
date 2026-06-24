@extends('layouts.admin')

@section('title', 'Gestion des utilisateurs · SynergyAI')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-primary section-title-soft">Gestion des utilisateurs</h2>
    </div>

    <div class="glass-card p-6">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Inscrit le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->prenom }} {{ $user->nom }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($user->role == 'admin') bg-red-100 text-red-700
                                @elseif($user->role == 'medecin') bg-blue-100 text-blue-700
                                @else bg-green-100 text-green-700 @endif">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Supprimer définitivement cet utilisateur ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-outline-danger text-sm px-3 py-1">
                                    <i class="fas fa-trash-alt mr-1"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-8 text-warm-gray">Aucun utilisateur trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection