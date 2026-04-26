<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicaments', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('forme')->nullable(); // comprimé, gélule, sirop, etc.
            $table->text('description')->nullable();
            $table->string('dosage_standard')->nullable(); // ex: 500mg
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicaments');
    }
};