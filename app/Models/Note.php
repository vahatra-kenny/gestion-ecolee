<?php

// app/Models/Note.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['etudiant_id', 'module', 'note', 'coefficient'];

    public function etudiant() {
        return $this->belongsTo(Etudiant::class);
    }

    // Accessor N×C
    public function getNcAttribute() {
        return $this->note * $this->coefficient;
    }
}
