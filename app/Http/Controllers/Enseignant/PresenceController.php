<?php

namespace App\Http\Controllers\Enseignant;

use App\Models\Etudiant;
use App\Models\Presence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PresenceController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::orderBy('nom')->get();
        $classes = ['IG1', 'IG2', 'IG3'];
        $professeurs = ['Mr Rakoto', 'Mme Rasoanaivo', 'Mr Ando'];

        return Inertia::render('Enseignant/Presence', [
            'etudiants' => $etudiants,
            'absents' => [],
            'classes' => $classes,
            'professeurs' => $professeurs,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'classe' => 'required|string|max:100',
            'professeur' => 'required|string|max:100',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'absents' => 'array',
        ]);

        $etudiants = Etudiant::all();

        foreach ($etudiants as $etudiant) {
            Presence::create([
                'etudiant_id' => $etudiant->id,
                'classe' => $data['classe'],
                'professeur' => $data['professeur'],
                'date' => $data['date'],
                'heure_debut' => $data['heure_debut'],
                'heure_fin' => $data['heure_fin'],
                'absent' => in_array($etudiant->id, $data['absents']),
            ]);
        }

        return back()->with('success', 'Présence enregistrée.');
    }
}
