<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes_Ministerielles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class NotesMinisterielleController extends Controller
{         
    public function getNoteMinisterielle(){
        $Notes_Ministerielles = Notes_Ministerielles::all();
        foreach($Notes_Ministerielles as $key => $Notes_Ministerielle) {
            $Notes_Ministerielle['date'] = explode(" ", $Notes_Ministerielle->created_at)[0];
        }
        //
        foreach($Notes_Ministerielles as $key => $Notes_Ministerielle) {
            if($Notes_Ministerielle->fichier){
                $namepdf = $Notes_Ministerielle->fichier;
                $Notes_Ministerielle->fichier =   request()->getHttpHost() . '/' . 'storage/' .  $namepdf;  
            }
        }
        return response()->json($Notes_Ministerielles, 200);
    }

    public function getNoteMinisterielleById($id){

        $Notes_Ministerielle = Notes_Ministerielles::find($id);
        if(is_null($Notes_Ministerielle)){
            return response()->json(['note ministerielle not exist'], 200);
        }
         if(!is_null($Notes_Ministerielle->fichier)){
            // $path = 'storage/' . $Notes_Ministerielle->fichier;
            // $type = pathinfo($path, PATHINFO_EXTENSION);
            // $data = file_get_contents($path);
            // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            // $produit->image = $base64; 
            $Notes_Ministerielle->fichier =  'http://' . request()->getHttpHost() . '/' . 'storage/' .  $Notes_Ministerielle->fichier;  
         }
        return response()->json($Notes_Ministerielle, 200);
    }

    public function addNoteMinisterielle(Request $request){
        // http://localhost:8000/storage/1662456961.pdf
        $validator = Validator::make($request->all(), [
            'category' =>'required',
            'titre' =>'required',
            'lien' =>'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        $name_fichier = '';
        if($request->fichier != ''){
            $name_fichier = time().'.' . explode('/', explode(':', substr($request->fichier, 0, strpos($request->fichier, ';')))[1])[1];
            $pdf_64 = $request->fichier; //your base64 encoded data
            $replace = substr($pdf_64, 0, strpos($pdf_64, ',')+1); 
          // find substring fro replace here eg: data:image/png;base64,
           $pdf = str_replace($replace, '', $pdf_64); 
           $pdf = str_replace(' ', '+', $pdf); 
           Storage::disk('public')->put($name_fichier, base64_decode($pdf));
        }
       
        $Notes_Ministerielle = Notes_Ministerielles::create([
            'category'=> $request->category,
            'titre'=> $request->titre,
            'lien'=> $request->lien,
            'fichier'=> $name_fichier,
        ]);
        $Notes_Ministerielle->save();
        return response()->json($Notes_Ministerielle, 200);
    }

    public function updateNoteMinisterielle($id, Request $request){
        $Notes_Ministerielle = Notes_Ministerielles::find($id);
        if(is_null($Notes_Ministerielle)){
            return response()->json(['note ministerielle not exist'], 200);
        }
        $validator = Validator::make($request->all(), [
            'category' =>'required',
            'titre' =>'required',
            'lien' =>'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        if($request->fichier != ''){
            $name_fichier = time().'.' . explode('/', explode(':', substr($request->fichier, 0, strpos($request->fichier, ';')))[1])[1];
            $pdf_64 = $request->fichier; //your base64 encoded data
            $replace = substr($pdf_64, 0, strpos($pdf_64, ',')+1); 
          // find substring fro replace here eg: data:image/png;base64,
           $pdf = str_replace($replace, '', $pdf_64); 
           $pdf = str_replace(' ', '+', $pdf); 
           Storage::disk('public')->put($name_fichier, base64_decode($pdf));
           $Notes_Ministerielle->fichier = $name_fichier;
        }
        $Notes_Ministerielle->category =  $request->category;
        $Notes_Ministerielle->titre = $request->titre;
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
