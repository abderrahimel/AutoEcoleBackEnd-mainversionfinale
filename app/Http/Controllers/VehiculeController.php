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
        $ecole = AutoEcole::findOrFail($ecole_id);
        $vehicules = Vehicule::where('auto_ecole_id', $ecole_id)->get();
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
        if($request->vignette != ''){
            $name_vignette = time().'.' . explode('/', explode(':', substr($request->vignette, 0, strpos($request->vignette, ';')))[1])[1];
            \Image::make($request->vignette)->save(public_path('vignette/').$name_vignette);
        }
        $vehicule = Vehicule::create([
            'auto_ecole_id'=>$ecole_id,
            'matricule'=>$request->matricule,
            'type'=>$request->type,
            'marque'=>$request->marque,
            'fourniseur'=>$request->fourniseur,
            'date_assurance'=>$request->date_assurance,
            'modele'=>$request->modele,
            'categorie'=>$request->categorie,
            'date_prochain_vidange'=>$request->date_prochain_vidange,
            'date_expiration_assurance'=>$request->date_expiration_assurance,
            'date_visite'=>$request->date_visite,
            'date_prochain_visite'=>$request->date_prochain_visite,
            'date_vidange'=>$request->date_vidange,
            'carte_grise'=>$name_carte_grise,
            'vignette'=>$name_vignette,
            'assurance'=>$name_assurance,
            'visite'=> $name_visite,
        ]);
        $vehicule->save();
        return response($vehicule,201);
    }

    public function updateVehicule($id,Request $request)
    {
        $vehicule=Vehicule::find($id);
        if (is_null($vehicule)) {
            return response()->json(['message'=>"véhicule n'est pas trouvée"],404);
        }

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
        if($request->vignette != ''){
            $name_vignette = time().'.' . explode('/', explode(':', substr($request->vignette, 0, strpos($request->vignette, ';')))[1])[1];
            \Image::make($request->vignette)->save(public_path('vignette/').$name_vignette);
        }
        $request->matricule = $request->matricule;
        $request->type = $request->type;
        $request->marque = $request->marque;
        $request->fourniseur = $request->fourniseur;
        $request->modele = $request->modele;
        $request->date_visite = $request->date_visite;
        $request->date_vidange = $request->date_vidange;
        $request->carte_grise = $name_carte_grise;
        $request->vignette = $name_vignette;
        $request->assurance = $name_assurance;
        $request->visite = $name_visite;
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
