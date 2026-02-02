<?php

// app/Models/EmploiDuTemps.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmploiDuTemps extends Model
{
    use HasFactory;
protected $table = 'emplois_du_temps';
    protected $fillable = [
        'user_id', 'classe', 'mois', 'date', 'heure_debut', 'heure_fin', 'module',
    ];
}

