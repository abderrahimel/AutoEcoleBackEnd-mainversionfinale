<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use App\Models\Note; 
use App\Models\AutoEcole;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{   public function getNotes($auto_id)
    {
        $ecole = AutoEcole::find($auto_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvé"],404);
        }

        $notes = Note::where('auto_ecole_id',$auto_id)->get();
        return response()->json($notes,201);
    }
    public function count($ecole_id){
        $count = Note::where('auto_ecole_id', $ecole_id)->where('deleted_at', null)->count();
        return response()->json($count,200);
    }
    public function addNote($ecole_id,Request $request)
    {
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvé"],404);
        }
        $validator = Validator::make($request->all(), [
            'categorie' =>'required',
            'moyen' => 'required',
            'note_generale' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        $note = Note::create([
                    'auto_ecole_id'=>$ecole_id,
                    'categorie'=>$request->categorie,
                    'moyen'=>$request->moyen,
                    'note_generale'=>$request->note_generale,
        ]);

        $ecole->save();
        return response($note,200);
    }

    public function updateNote($id, Request $request)
    {
         $note = Note::find($id);
         if(is_null($note)){
            return response()->json(['message'=> "note dosn't exist"],404);
        }
        $note->categorie = $request->categorie;
        $note->moyen = $request->moyen;
        $note->note_generale = $request->note_generale;
        $note->save();
        return response($note,201);
    }

    public function deleteExamen($id)
    {
        $note = Note::find($id);
        if(is_null($note)){
            return response()->json(['message'=> "this note dosn't exist "],404);
        }
        $note->delete();
        return response()->json(['message'=>'deleted note '], 201);
    }
    
    public function getNoteById($id)
    {
        $note = Note::find($id);
        if(is_null($note)){
            return response()->json(['message'=> "this note dosn't exist "],404);
        }
    
        return response()->json($note, 201);
    }
}
