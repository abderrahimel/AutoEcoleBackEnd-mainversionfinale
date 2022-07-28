<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes_Ministerielles;
class NotesMinisterielleController extends Controller
{         
    public function getNoteMinisterielle(){

        $Notes_Ministerielles = Notes_Ministerielles::all();
        return response()->json($Notes_Ministerielles, 200);
    }

    public function getNoteMinisterielleById($id){

        $Notes_Ministerielle = Notes_Ministerielles::find($id);
        return response()->json($Notes_Ministerielle, 200);
    }

    public function addNoteMinisterielle(Request $request){
           
        if($request->fichier != ''){
            $name_fichier = time().'.' . explode('/', explode(':', substr($request->fichier, 0, strpos($request->fichier, ';')))[1])[1];
            \Image::make($request->fichier)->save(public_path('notes_Ministerielle/').$name_fichier);
        }
        $Notes_Ministerielle = Notes_Ministerielles::create([
            'messages'=> $request->messages,
            'titre'=> $request->titre,
            'lien'=> $request->lien,
            'fichier'=> '$name_fichier',
        ]);
        $Notes_Ministerielle->save();
        return response()->json($Notes_Ministerielle, 200);
    }

    public function updateNoteMinisterielle($id){

        $Notes_Ministerielle = Notes_Ministerielles::find($id);

        if($request->fichier != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->fichier, 0, strpos($request->fichier, ';')))[1])[1];
            \Image::make($request->fichier)->save(public_path('notes_Ministerielle/').$name_fichier);
            $Notes_Ministerielle->fichier = $request->fichier;
        }
        $Notes_Ministerielle->messages =  $request->messages;
        $Notes_Ministerielle->titre = $request->titre;
        $Notes_Ministerielle->fichier = "request->date";
        $Notes_Ministerielle->lien = $request->lien;
        $Notes_Ministerielle->save();

        return response()->json($Notes_Ministerielle, 200);
    }

    public function deleteNoteMinisterielle($id){
        $Notes_Ministerielle = Notes_Ministerielles::find($id);
        $Notes_Ministerielle->delete();
        return response()->json(['message'=>'Note Ministerielles deleted'], 200);
    }
    
}
