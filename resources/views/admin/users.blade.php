@extends('layouts.admin')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-[#2d4e57] section-title-soft">Gestion des utilisateurs</h2>
    </div>

    <div class="glass-card p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-white/50">
                        <th class="py-3 px-2">ID</th>
                        <th class="py-3 px-2">Nom complet</th>
                        <th class="py-3 px-2">Email</th>
                        <th class="py-3 px-2">Rôle</th>
                        <th class="py-3 px-2">Inscrit le</th>
                        <th class="py-3 px-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b border-white/30 hover:bg-white/20 transition">
                        <td class="py-3 px-2">{{ $user->id }}</td>
                        <td class="py-3 px-2">{{ $user->prenom }} {{ $user->nom }}</td>
                        <td class="py-3 px-2">{{ $user->email }}</td>
                        <td class="py-3 px-2">
                            <span class="badge px-2 py-1 rounded-full text-xs 
                                @if($user->role == 'admin') bg-red-100 text-red-700
                                @elseif($user->role == 'medecin') bg-blue-100 text-blue-700
                                @else bg-green-100 text-green-700 @endif">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="py-3 px-2">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="py-3 px-2">
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
                    <tr><td colspan="6" class="text-center py-8 text-[#527a84]">Aucun utilisateur trouvé.</td></tr>
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