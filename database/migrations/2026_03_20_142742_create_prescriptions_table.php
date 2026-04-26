<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('medecin_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('medicament_id')->constrained('medicaments');
            $table->string('posologie'); // ex: "1 comprimé matin et soir"
            $table->text('instructions')->nullable(); // conseils supplémentaires
            $table->integer('duree_jours')->nullable(); // en jours
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->enum('statut', ['active', 'terminee', 'annulee'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};