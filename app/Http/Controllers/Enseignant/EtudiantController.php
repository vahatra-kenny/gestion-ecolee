<?php

// app/Http/Controllers/Enseignant/EtudiantController.php
namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:150'],
        ]);

        Etudiant::create([
            'user_id' => $request->user()->id,
            'nom' => $data['nom'],
        ]);
        

        return back()->with('success', 'Étudiant ajouté.');
    }

    public function destroy(Etudiant $etudiant)
    {
        // Optionnel: vérifier que l'étudiant appartient à l'enseignant connecté
        if ($etudiant->user_id !== request()->user()->id) {
            abort(403);
        }

        $etudiant->delete();
        return back()->with('success', 'Étudiant supprimé.');
    }
}
