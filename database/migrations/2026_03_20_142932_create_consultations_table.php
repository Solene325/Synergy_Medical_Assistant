<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('medecin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('symptomes')->nullable();
            $table->text('diagnostic_ia')->nullable(); // prédiction IA (texte)
            $table->text('diagnostic_medecin')->nullable(); // diagnostic final du médecin
            $table->text('recommandations')->nullable();
            $table->string('statut')->default('en_attente'); // en_attente, traite, clos
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};