<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\AutoEcole;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class VehiculeController extends Controller
{
    public function getVehicule($ecole_id)
    {   
        $ecole=AutoEcole::findOrFail($ecole_id);
        // $vehicule = Vehicule::where('auto_ecole_id', $ecole_id);
        $vehicules = $ecole->vehicules;
        //$datavehicule = DB::table('vehicules')->get();
        return response()->json($vehicules, 200);
        
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
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvée"],404);
        }
        // carte grise
        if($request->carte_grise != ''){
            $name_carte_grise = time().'.' . explode('/', explode(':', substr($request->carte_grise, 0, strpos($request->carte_grise, ';')))[1])[1];
            \Image::make($request->carte_grise)->save(public_path('carte_grise/').$name_carte_grise);
        }
        // 
        if($request->assurance != ''){
            $name_assurance = time().'.' . explode('/', explode(':', substr($request->assurance, 0, strpos($request->assurance, ';')))[1])[1];
            \Image::make($request->assurance)->save(public_path('assurance/').$name_assurance);
        }
        // 
        if($request->visite != ''){
            $name_visite = time().'.' . explode('/', explode(':', substr($request->visite, 0, strpos($request->visite, ';')))[1])[1];
            \Image::make($request->visite)->save(public_path('visite/').$name_visite);
        }
        $vehicule = Vehicule::create([
            'auto_ecole_id'=>$ecole_id,
            'matricule'=>$request->matricule,
            'type'=>$request->type,
            'marque'=>$request->marque,
            'fourniseur'=>$request->fourniseur,
            'modele'=>$request->modele,
            'date_visite'=>$request->date_visite,
            'date_vidange'=>$request->date_vidange,
            'carte_grise'=>$name_carte_grise,
            'vignette'=>$request->vignette,
            'assurance'=>$name_assurance,
            'visite'=> $name_visite,
        ]);
        $vehicule->save();
        // $vehicule = Vehicule::find($vehicule->id);
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

    public function deleteVehicule($id)
    {
        $vehicule = Vehicule::find($id);
        if (is_null($vehicule)) {
            return response()->json(['message'=>"Véhicule n'est pas trouvée"],404);
        }
        $vehicule->delete();
        return response()->json(['message'=>"delete vehicule"],200);
    }
}
