<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            // clé étrangère vers etudiants.id
            $table->unsignedBigInteger('etudiant_id');
            $table->foreign('etudiant_id')->references('id')->on('etudiants')->onDelete('cascade');

            $table->string('module', 150);
            $table->unsignedTinyInteger('note');        // 0–20
            $table->unsignedTinyInteger('coefficient'); // 1–10
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('notes');
    }
};
