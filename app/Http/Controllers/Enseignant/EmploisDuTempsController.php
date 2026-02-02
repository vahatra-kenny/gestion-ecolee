<?php

// app/Http/Controllers/Enseignant/EmploisDuTempsController.php
namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\EmploiDuTemps;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmploisDuTempsController extends Controller
{
    public function index(Request $request)
    {// Récupère les emplois du temps déjà enregistrés
     $items = \App\Models\EmploiDuTemps::where('user_id', $request->user()->id) 
     ->orderBy('date')
      ->get(); 
      return Inertia::render('Enseignant/EmploisDuTemps', [ 
        'items' => $items,
         ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'classe' => ['required', 'string', 'max:100'],
            'mois' => ['required', 'string', 'max:50'],
            'planning' => ['required', 'array', 'min:1'],
            'planning.*.date' => ['required', 'date'],
            'planning.*.heureDebut' => ['required'],
            'planning.*.heureFin' => ['required'],
            'planning.*.module' => ['required', 'string', 'max:150'],
        ]);

        foreach ($data['planning'] as $p) {
            EmploiDuTemps::create([
                'user_id' => $request->user()->id,
                'classe' => $data['classe'],
                'mois' => $data['mois'],
                'date' => $p['date'],
                'heure_debut' => $p['heureDebut'],
                'heure_fin' => $p['heureFin'],
                'module' => $p['module'],
            ]);
        }

        return back()->with('success', 'Emplois du temps enregistré.');
    }
}

