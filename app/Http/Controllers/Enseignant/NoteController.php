<?php

// app/Http/Controllers/Enseignant/NoteController.php
namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\Note;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        // Étudiants de l’enseignant
        $etudiants = Etudiant::where('user_id', $request->user()->id)
            ->orderBy('nom')
            ->get();

        // Notes de tous les étudiants de l’enseignant (pour filtrer côté Vue)
        $notes = Note::whereIn('etudiant_id', $etudiants->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Enseignant/Notes', [
            'etudiants' => $etudiants,
            'notes' => $notes,
        ]);
    }

    public function store(Request $request, Etudiant $etudiant)
    {
        // Sécurité: s’assurer que l’étudiant appartient à l’enseignant
        if ($etudiant->user_id !== $request->user()->id) {
            abort(403);
        }

        $data = $request->validate([
            'module' => ['required', 'string', 'max:150'],
            'note' => ['required', 'integer', 'min:0', 'max:20'],
            'coefficient' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'module' => $data['module'],
            'note' => $data['note'],
            'coefficient' => $data['coefficient'],
        ]);

        return back()->with('success', 'Note ajoutée.');
    }

    public function update(Request $request, Note $note)
    {
        // Sécurité: vérifier la propriété via l’étudiant
        if ($note->etudiant->user_id !== $request->user()->id) {
            abort(403);
        }

        $data = $request->validate([
            'module' => ['required', 'string', 'max:150'],
            'note' => ['required', 'integer', 'min:0', 'max:20'],
            'coefficient' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        $note->update($data);

        return back()->with('success', 'Note modifiée.');
    }

    public function destroy(Request $request, Note $note)
    {
        if ($note->etudiant->user_id !== $request->user()->id) {
            abort(403);
        }

        $note->delete();
        return back()->with('success', 'Note supprimée.');
    }
}
