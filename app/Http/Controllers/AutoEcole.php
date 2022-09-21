<?php

namespace App\Http\Controllers;

use App\Models\AutoEcole as ModelsAutoEcole;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AutoEcole extends Controller
{
    public function getAutoEcole($user_id)
    {
        $ecole = ModelsAutoEcole::all();
        return response()->json($ecole,200);
        
    }
    public function getArchiveAutoEcole(){

        $ecoles = ModelsAutoEcole::onlyTrashed()->get();
       
        if(is_null($ecoles)){
            return response()->json(['message'=> "Auto Ecoles n'est pas trouvée"],404);
        }
        return response()->json($ecoles,200);
    }
    public function recupererAutoEcole($id)
    {  
        $ecole = ModelsAutoEcole::onlyTrashed()->findOrFail($id);
        $ecole->restore();
        $ecole->save();
        return response()->json($ecole,200);
    }
    public function getAutoEcoleById($id)
    {
        $ecole = ModelsAutoEcole::find($id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Auto Ecole n'est pas trouvée"],404);
        }
        return response()->json($ecole,200);
    }
    public function approverAutoEcole($id)
    {   
        $ecole = ModelsAutoEcole::find($id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Auto Ecole n'est pas trouvée"],404);
        }
        $ecole->etat = 'approuve';
        $ecole->save();
        return response()->json($ecole,200);
    }
    public function desapproverAutoEcole($id)
    {
        $ecole = ModelsAutoEcole::find($id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Auto Ecole n'est pas trouvée"],404);
        }
        $ecole->etat = 'en_attente';
        $ecole->save();
        return response()->json($ecole,200);
    }
    public function addAutoEcole(Request $request,$user_id)
    {
        $user= User::find($user_id);
        $ecole = new ModelsAutoEcole($request->all());
        if($request->hasFile('photo_cin')){
            $completeFileName = $request->file('photo_cin')->getClientOriginalName();
            $fileNameOnly= pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('photo_cin')->getClientOriginalExtension();
            $compPic= str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('photo_cin')->storeAs('public/autoEcole/CIN',$compPic);
            $ecole->photo_cin = $compPic;
            $ecole->save();
        }
        if($request->hasFile('photo1')){
            $completeFileName = $request->file('photo1')->getClientOriginalName();
            $fileNameOnly= pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('photo1')->getClientOriginalExtension();
            $compPic= str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('photo1')->storeAs('public/autoEcole/photos',$compPic);
            $ecole->photo1 = $compPic;
            $ecole->save();
        }
        if($request->hasFile('photo2')){
            $completeFileName = $request->file('photo2')->getClientOriginalName();
            $fileNameOnly= pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('photo2')->getClientOriginalExtension();
            $compPic= str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('photo2')->storeAs('public/autoEcole/photos',$compPic);
            $ecole->photo2 = $compPic;
            $ecole->save();
        }
        $user -> autoEcoles()->save($ecole);
        return response($ecole,201);
    }


    public function UpdateAutoEcole(Request $request,$id)
    {
        $ecole = ModelsAutoEcole::find($id);
        if (is_null($ecole)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $ecole->nom = $request->nom;
        $ecole->registre_commerce = $request -> registre_commerce;
        $ecole->num_agrement = $request -> num_agrement;
        $ecole->num_patente = $request -> num_patente;
        $ecole->date_autorisation = $request -> date_autorisation;
        $ecole->ident_fiscale = $request -> ident_fiscale;
        $ecole->date_ouverture = $request -> date_ouverture;
        $ecole->CNSS = $request -> CNSS;
        $ecole->ICE = $request -> ICE;
        $ecole->compte_bancaire = $request -> compte_bancaire;
        $ecole->TVA = $request -> TVA;
        $ecole->pays = $request -> pays;
        $ecole->ville = $request -> ville;
        $ecole->telephone = $request -> telephone;
        $ecole->fax = $request -> fax;
        $ecole->site_web = $request -> site_web;
        $ecole->adresse = $request -> adresse;
        $ecole->CIN_responsable = $request -> CIN_responsable;
        $ecole->nom_responsable = $request -> nom_responsable;
        $ecole->prenom_responsable = $request -> prenom_responsable;
        $ecole->tele_responsable = $request -> tele_responsable;
        $ecole->adresse_responsable = $request -> adresse_responsable;
        if($request->hasFile('photo_cin')){
            $completeFileName = $request->file('photo_cin')->getClientOriginalName();
            $fileNameOnly= pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('photo_cin')->getClientOriginalExtension();
            $compPic= str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('photo_cin')->storeAs('public/autoEcole/CIN',$compPic);
            $ecole->photo_cin = $compPic;
            $ecole->save();
        }
        if($request->hasFile('photo1')){
            $completeFileName = $request->file('photo1')->getClientOriginalName();
            $fileNameOnly= pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('photo1')->getClientOriginalExtension();
            $compPic= str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('photo1')->storeAs('public/autoEcole/photos',$compPic);
            $ecole->photo1 = $compPic;
            $ecole->save();
        }
        if($request->hasFile('photo2')){
            $completeFileName = $request->file('photo2')->getClientOriginalName();
            $fileNameOnly= pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('photo2')->getClientOriginalExtension();
            $compPic= str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('photo2')->storeAs('public/autoEcole/photos',$compPic);
            $ecole->photo2 = $compPic;
            $ecole->save();
        }
        $ecole->save();
        return response($ecole,200);
    }


    public function deleteAutoEcole(Request $request,$id)
    {
        $ecole = ModelsAutoEcole::find($id);
        if (is_null($ecole)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $ecole->delete();
        return response()->json(['message'=>'auto ecole deleted'],204);
    }

}
