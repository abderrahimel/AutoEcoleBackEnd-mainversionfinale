<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use App\Models\Note; 
class NoteController extends Controller
{
    public function addNote($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvé"],404);
        }

        $note = Note::create([
                    'auto_ecole_id'=>$ecole_id,
                    'categorie'=>$request->categorie,
                    'moyen'=>$request->moyen,
                    'note_generale'=>$request->note_generale,
        ]);

        $ecole -> notes()->save($note);
        return response($note,201);
    }
}
