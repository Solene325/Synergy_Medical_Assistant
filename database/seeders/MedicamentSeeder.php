<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicament;

class MedicamentSeeder extends Seeder
{
    public function run(): void
    {
        $medicaments = [
            ['nom' => 'Paracétamol', 'forme' => 'comprimé', 'description' => 'Antalgique et antipyrétique', 'dosage_standard' => '500mg'],
            ['nom' => 'Ibuprofène', 'forme' => 'comprimé', 'description' => 'Anti-inflammatoire non stéroïdien', 'dosage_standard' => '400mg'],
            ['nom' => 'Amoxicilline', 'forme' => 'gélule', 'description' => 'Antibiotique', 'dosage_standard' => '500mg'],
            ['nom' => 'Oméprazole', 'forme' => 'gélule', 'description' => 'Inhibiteur de la pompe à protons', 'dosage_standard' => '20mg'],
            ['nom' => 'Salbutamol', 'forme' => 'inhalateur', 'description' => 'Bronchodilatateur', 'dosage_standard' => '100mcg/dose'],
            ['nom' => 'Loratadine', 'forme' => 'comprimé', 'description' => 'Antihistaminique', 'dosage_standard' => '10mg'],
            ['nom' => 'Diclofénac', 'forme' => 'gel', 'description' => 'Anti-inflammatoire topique', 'dosage_standard' => '1%'],
            ['nom' => 'Metformine', 'forme' => 'comprimé', 'description' => 'Antidiabétique', 'dosage_standard' => '500mg'],
            ['nom' => 'Aspirine', 'forme' => 'comprimé', 'description' => 'Antiplaquettaire, antalgique', 'dosage_standard' => '100mg'],
            ['nom' => 'Vitamine C', 'forme' => 'comprimé effervescent', 'description' => 'Complément vitaminique', 'dosage_standard' => '1000mg'],
        ];

        foreach ($medicaments as $med) {
            Medicament::create($med);
        }
    }
}