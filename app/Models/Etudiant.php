<?php

// app/Models/Etudiant.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nom'];

    public function notes() {
        return $this->hasMany(Note::class);
    }
    public function presences() { 
        return $this->hasMany(Presence::class); }
}
