<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\AutoEcole;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class VehiculeController extends Controller
{
    public function getVehicule($ecole_id)
    {   
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvée"],404);
        }
        $vehicules = Vehicule::where('auto_ecole_id', $ecole_id)->get();
        if(is_null($vehicules)){
            return response()->json(['message'=> "vehicule n'est pas trouvée"],404);
        }
        foreach($vehicules as $key => $vehicule) {
            if($vehicule->carte_grise){
                $vehicule->carte_grise = 'http://' . request()->getHttpHost() . '/' . 'carte_grise/' .  $vehicule->carte_grise; 
            }
            if($vehicule->vignette){
                $vehicule->vignette = 'http://' . request()->getHttpHost() . '/' . 'vignette/' .  $vehicule->vignette; 
            }
            if($vehicule->assurance){
                $vehicule->assurance = 'http://' . request()->getHttpHost() . '/' . 'assurance/' .  $vehicule->assurance;  
            }
            if($vehicule->visite){
                $vehicule->visite  = 'http://' . request()->getHttpHost() . '/' . 'visite/' .  $vehicule->visite; 
            }
            }
        return response()->json($vehicules, 200);
    }

      public function getNumber($ecole_id){
         $count =  Vehicule::where('deleted_at','=', null)->count();
         return response()->json($count, 200);
      }
      public function getVisiteTechnique($ecole_id)
      {
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvée"],404);
        }
        $today = date("Y/m/d");
        $vehiculespasencore = Vehicule::where('auto_ecole_id', $ecole_id)->whereDate('date_prochain_visite','>=', $today)->get();
        $vehiculesurgent= Vehicule::where('auto_ecole_id', $ecole_id)->whereDate('date_visite','>=', $today)->get();
        $vehiculedata = array();
        foreach ($vehiculesurgent as $vehicule) {
           $vehiculedata[] = $vehicule;
        }
        foreach ($vehiculespasencore as $vehicule) {
            if(!in_array($vehicule, $vehiculedata)){
                $vehiculedata[] = $vehicule;
            }
   
        }
        if($vehiculedata){
            return response()->json($vehiculedata, 200);
        }
        return response()->json(null, 200);
      }

      public function getVidange($ecole_id)
      {
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvée"],404);
        }
        $today = date("Y/m/d");
        $vehiculespasencore = Vehicule::where('auto_ecole_id', $ecole_id)->whereDate('date_prochain_vidange','>=', $today)->get();
        $vehiculesurgent= Vehicule::where('auto_ecole_id', $ecole_id)->whereDate('date_vidange','>=', $today)->get();
        $vehiculedata = array();
        foreach ($vehiculesurgent as $vehicule) {
            $vehiculedata[] = $vehicule;
        }
        foreach ($vehiculespasencore as $vehicule) {
           $vehiculedata[] = $vehicule;
        }
        return response()->json($vehiculedata, 200);
      }

      public function getAssurance($ecole_id)
      {
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvée"],404);
        }
        $today = date("Y/m/d");
        $vehiculespasencore = Vehicule::where('auto_ecole_id', $ecole_id)->whereDate('date_expiration_assurance','>=', $today)->get();
        $vehiculesurgent= Vehicule::where('auto_ecole_id', $ecole_id)->whereDate('date_assurance','>=', $today)->get();
        $vehiculedata = array();
        foreach ($vehiculesurgent as $vehicule) {
           $vehiculedata[] = $vehicule;
        }
        foreach ($vehiculespasencore as $vehicule) {
            if(!in_array($vehicule, $vehiculedata)){
                $vehiculedata[] = $vehicule;
            }
   
        }
        return response()->json($vehiculedata, 200);
      }

    public function getVehiculeById($id)
    {
        $vehicule = Vehicule::find($id);
        if(is_null($vehicule)){
            return response()->json(['message'=> "Véhicule n'est pas trouvée"],404);
        }
        if($vehicule->carte_grise){
            $vehicule->carte_grise = 'http://' . request()->getHttpHost() . '/' . 'carte_grise/' .  $vehicule->carte_grise; 
        }
        if($vehicule->vignette){
            $vehicule->vignette = 'http://' . request()->getHttpHost() . '/' . 'vignette/' .  $vehicule->vignette; 
        }
        if($vehicule->assurance){
            $vehicule->assurance = 'http://' . request()->getHttpHost() . '/' . 'assurance/' .  $vehicule->assurance;  
        }
        if($vehicule->visite){
            $vehicule->visite  = 'http://' . request()->getHttpHost() . '/' . 'visite/' .  $vehicule->visite; 
        }
          // base 64 carte visite
        //   $img = $vehicule->visite;
        //   $path = 'visite/' . $img;
        //   $type = pathinfo($path, PATHINFO_EXTENSION);
        //   $data = file_get_contents($path);
        //   $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        //   $vehicule->visite = $base64; 

        return response()->json($vehicule,200);
    }

    public function addVehicule($ecole_id,Request $request)
    {  
        $ecole=AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvée"],404);
        }
        $validator = Validator::make($request->all(), [
            'carte_grise'=>'required',
            'assurance'=>'required',
            'visite'=>'required',
            'vignette'=>'required',
            'matricule'=>'required',
            'type'=>'required',
            'marque'=>'required',
            'fourniseur'=>'required',
            'date_assurance'=>'required',
            'modele'=>'required',
            'categorie'=>'required',
            'date_prochain_vidange'=>'required',
            'date_expiration_assurance'=>'required',
            'date_visite'=>'required',
            'date_prochain_visite'=>'required',
            'date_vidange'=>'required',
        ]);
       
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
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
        $validator = Validator::make($request->all(), [
            'matricule'=>'required',
            'type'=>'required',
            'marque'=>'required',
            'fourniseur'=>'required',
            'date_assurance'=>'required',
            'modele'=>'required',
            'categorie'=>'required',
            'date_prochain_vidange'=>'required',
            'date_expiration_assurance'=>'required',
            'date_visite'=>'required',
            'date_prochain_visite'=>'required',
            'date_vidange'=>'required',
        ]);
       
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        if($request->carte_grise != ''){
            $name_carte_grise = time().'.' . explode('/', explode(':', substr($request->carte_grise, 0, strpos($request->carte_grise, ';')))[1])[1];
            \Image::make($request->carte_grise)->save(public_path('carte_grise/').$name_carte_grise);
            $vehicule->carte_grise = $name_carte_grise;
        }
        // 
        if($request->assurance != ''){
            $name_assurance = time().'.' . explode('/', explode(':', substr($request->assurance, 0, strpos($request->assurance, ';')))[1])[1];
            \Image::make($request->assurance)->save(public_path('assurance/').$name_assurance);
            $vehicule->assurance = $name_assurance;
        }
        // 
        if($request->visite != ''){
            $name_visite = time().'.' . explode('/', explode(':', substr($request->visite, 0, strpos($request->visite, ';')))[1])[1];
            \Image::make($request->visite)->save(public_path('visite/').$name_visite);
            $vehicule->visite = $name_visite;
        }
        if($request->vignette != ''){
            $name_vignette = time().'.' . explode('/', explode(':', substr($request->vignette, 0, strpos($request->vignette, ';')))[1])[1];
            \Image::make($request->vignette)->save(public_path('vignette/').$name_vignette);
            $vehicule->vignette = $name_vignette;
        }
        $vehicule->matricule = $request->matricule;
        $vehicule->type = $request->type;
        $vehicule->marque = $request->marque;
        $vehicule->fourniseur = $request->fourniseur;
        $vehicule->modele = $request->modele;
        $vehicule->date_visite = $request->date_visite;
        $vehicule->date_vidange = $request->date_vidange;
        $vehicule->date_expiration_assurance = $request->date_expiration_assurance;
        $vehicule->date_prochain_vidange = $request->date_prochain_vidange;
        $vehicule->date_expiration_assurance = $request->date_expiration_assurance;
        $vehicule->date_visite = $request->date_visite;
        $vehicule->date_prochain_visite = $request->date_prochain_visite;
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
