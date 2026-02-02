<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'etudiant_id', 'classe', 'professeur', 'date',
        'heure_debut', 'heure_fin', 'absent'
    ];

    public function etudiant() {
        return $this->belongsTo(Etudiant::class);
    }
}


