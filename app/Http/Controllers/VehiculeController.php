<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\AutoEcole;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    public function getVehicule($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $vehicules = $ecole->vehicules;
        return response()->json($vehicules,200);
        
    }

    public function getVehiculeById($id)
    {
        $vehicule = Vehicule::find($id);
        if(is_null($vehicule)){
            return response()->json(['message'=> "Véhicule n'est pas trouvée"],404);
        }
        return response()->json($vehicule,200);
    }

    public function addVehicule($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $vehicule = new Vehicule($request->all()); 
        $ecole -> vehicules()->save($vehicule);
        if($request->hasFile('carte_grise')){
            $completeFileName = $request->file('carte_grise')->getClientOriginalName();
            $fileNameOnly= pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('carte_grise')->getClientOriginalExtension();
            $compPic= str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('carte_grise')->storeAs('public/vehicule/carte_grise',$compPic);
            $vehicule->carte_grise = $compPic;
            $vehicule->save();
        } 
        if($request->hasFile('assurance')){
            $completeFileName = $request->file('assurance')->getClientOriginalName();
            $fileNameOnly= pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('assurance')->getClientOriginalExtension();
            $compPic= str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('assurance')->storeAs('public/vehicule/assurance',$compPic);
            $vehicule->assurance = $compPic;
            $vehicule->save();
        } 
        if($request->hasFile('visite')){
            $completeFileName = $request->file('visite')->getClientOriginalName();
            $fileNameOnly= pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('visite')->getClientOriginalExtension();
            $compPic= str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('visite')->storeAs('public/vehicule/visite',$compPic);
            $vehicule->visite = $compPic;
            $vehicule->save();
        } 
        $vehicule = Vehicule::find($vehicule->id);
        return response($vehicule,201);
    }

    public function updateVehicule($id,Request $request)
    {
        $vehicule=Vehicule::find($id);
        if (is_null($vehicule)) {
            return response()->json(['message'=>"véhicule n'est pas trouvée"],404);
        }
        $vehicule->matricule = $request -> matricule;
        $vehicule->type = $request -> type;
        $vehicule->marque = $request -> marque;
        $vehicule->modele = $request -> modele;
        $vehicule->date_visite = $request -> date_visite;
        $vehicule->date_vidange = $request -> date_vidange;
        $vehicule->vignette = $request -> vignette;
        if($request->hasFile('carte_grise')){
            $completeFileName = $request->file('carte_grise')->getClientOriginalName();
            $fileNameOnly= pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('carte_grise')->getClientOriginalExtension();
            $compPic= str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('carte_grise')->storeAs('public/vehicule/carte_grise',$compPic);
            $vehicule->carte_grise = $compPic;
            $vehicule->save();
        } 
        if($request->hasFile('assurance')){
            $completeFileName = $request->file('assurance')->getClientOriginalName();
            $fileNameOnly= pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('assurance')->getClientOriginalExtension();
            $compPic= str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('assurance')->storeAs('public/vehicule/assurance',$compPic);
            $vehicule->assurance = $compPic;
            $vehicule->save();
        } 
        if($request->hasFile('visite')){
            $completeFileName = $request->file('visite')->getClientOriginalName();
            $fileNameOnly= pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('visite')->getClientOriginalExtension();
            $compPic= str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('visite')->storeAs('public/vehicule/visite',$compPic);
            $vehicule->visite = $compPic;
            $vehicule->save();
        } 
        $vehicule->save();
        return response($vehicule,200);
    }

    public function deleteVehicule(Request $request,$id)
    {
        $vehicule = Vehicule::find($id);
        if (is_null($vehicule)) {
            return response()->json(['message'=>"Véhicule n'est pas trouvée"],404);
        }
        $vehicule->delete();
        return response()->json(null,204);
    }
}
