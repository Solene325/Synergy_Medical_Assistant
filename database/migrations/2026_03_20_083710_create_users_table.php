<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            $table->string('nom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('telephone')->nullable();
            $table->string('photo_profil')->nullable();
            $table->string('piece_identite')->nullable();
            $table->date('date_naissance')->nullable();
            $table->enum('sexe', ['M', 'F', 'Autre'])->nullable()->after('nom');
            $table->decimal('poids', 5, 2)->nullable();
            $table->integer('taille')->nullable();
            $table->string('groupe_sanguin')->nullable();
            $table->text('antecedents_personnels')->nullable();
            $table->text('antecedents_familiaux')->nullable();
            $table->string('password');
            $table->string('identifiant_unique')->unique()->nullable();
            $table->timestamp('politiques_acceptees_at')->nullable();
            $table->boolean('doit_changer_mdp')->default(false);
            $table->enum('role', ['patient', 'medecin', 'admin'])->default('patient');
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};