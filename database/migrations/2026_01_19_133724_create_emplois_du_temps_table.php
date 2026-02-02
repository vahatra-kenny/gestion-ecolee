<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_emplois_du_temps_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('emplois_du_temps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // enseignant
            $table->string('classe');           // ex: "1ère année"
            $table->string('mois');             // ex: "Novembre"
            $table->date('date');               // ex: 2025-11-01
            $table->time('heure_debut');        // ex: 07:00
            $table->time('heure_fin');          // ex: 11:00
            $table->string('module');           // ex: "Analyse et conception UML"
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('emplois_du_temps');
    }
};
