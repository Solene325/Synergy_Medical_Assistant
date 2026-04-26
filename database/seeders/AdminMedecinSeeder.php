<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminMedecinSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un administrateur
        User::create([
            'prenom' => 'Admin',
            'nom' => 'Super',
            'email' => 'admin@synergy.ma',
            'telephone' => '+212600000000',
            'photo_profil' => null,
            'piece_identite' => null,
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'identifiant_unique' => 'ADMIN001',
            'email_verified_at' => now(),
            'politiques_acceptees_at' => now(),
            'doit_changer_mdp' => false, // l'admin pourra changer s'il veut
        ]);

        // Créer un médecin
        User::create([
            'prenom' => 'Jean',
            'nom' => 'Dupont',
            'email' => 'jean.dupont@synergy.ma',
            'telephone' => '+212611111111',
            'photo_profil' => null,
            'piece_identite' => null,
            'role' => 'medecin',
            'password' => Hash::make('medecin123'),
            'identifiant_unique' => 'MED001',
            'email_verified_at' => now(),
            'politiques_acceptees_at' => now(),
            'doit_changer_mdp' => false,
        ]);
    }
}