<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Colonnes de localisation
            if (!Schema::hasColumn('users', 'adresse')) {
                $table->text('adresse')->nullable();
            }
            if (!Schema::hasColumn('users', 'adresse_rue')) {
                $table->string('adresse_rue')->nullable();
            }
            if (!Schema::hasColumn('users', 'ville')) {
                $table->string('ville')->nullable();
            }
            if (!Schema::hasColumn('users', 'code_postal')) {
                $table->string('code_postal')->nullable();
            }
            if (!Schema::hasColumn('users', 'pays')) {
                $table->string('pays')->nullable();
            }
            if (!Schema::hasColumn('users', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable();
            }
            if (!Schema::hasColumn('users', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable();
            }
            if (!Schema::hasColumn('users', 'telephone_urgence')) {
                $table->string('telephone_urgence')->nullable();
            }
            if (!Schema::hasColumn('users', 'langue_preferee')) {
                $table->string('langue_preferee')->default('fr');
            }
            if (!Schema::hasColumn('users', 'est_actif')) {
                $table->boolean('est_actif')->default(true);
            }
            // Champs spécifiques aux médecins
            if (!Schema::hasColumn('users', 'specialite')) {
                $table->string('specialite')->nullable();
            }
            if (!Schema::hasColumn('users', 'diplome')) {
                $table->text('diplome')->nullable();
            }
            if (!Schema::hasColumn('users', 'presentation')) {
                $table->text('presentation')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer uniquement les colonnes qui ont été ajoutées par cette migration
            // Mais on ne peut pas supprimer conditionnellement facilement, on supprime toutes celles qui existent
            $columns = [
                'adresse', 'adresse_rue', 'ville', 'code_postal', 'pays',
                'latitude', 'longitude', 'telephone_urgence', 'langue_preferee',
                'est_actif', 'specialite', 'diplome', 'presentation'
            ];
            foreach ($columns as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};