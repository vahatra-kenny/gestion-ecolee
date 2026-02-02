<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('presences', function (Blueprint $table) {
    $table->id();
    $table->foreignId('etudiant_id')->constrained('etudiants')->cascadeOnDelete();
    $table->string('classe', 100);
    $table->string('professeur', 100);
    $table->date('date');
    $table->time('heure_debut');
    $table->time('heure_fin');
    $table->boolean('absent')->default(false);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
