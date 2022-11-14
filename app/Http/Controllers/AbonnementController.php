<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Abonnement;
use App\Models\AutoEcole;

class AbonnementController extends Controller
{
    public function getAbonnements(){

        $abonnements = Abonnement::whereNotNull('date_debut')->get();
        foreach($abonnements as $key => $abonnement) {
             $autoecole = AutoEcole::find($abonnement->auto_ecole_id);
             $abonnement['autoEcole'] = $autoecole;
             $abonnement['nom_auto_ecole'] = $autoecole->nom_auto_ecole;
        }
        $items = array();
        foreach($abonnements as $key =>$abonnement) {
         $items[] = $abonnement->auto_ecole_id;
        }
        
        $auto_ecoles = array();
        foreach($items as $key =>$id) {
            $autoEcole = AutoEcole::find($id);
            $autoEcole->image = 'http://' . request()->getHttpHost() . '/' . 'images/' .  $autoEcole->image; 
            $auto_ecoles[] = $autoEcole;
           }
         return response()->json($abonnements, 200);
    }

    public function getabonnementByIdAUtoEcole($id){
        $abonnement = Abonnement::where('auto_ecole_id', $id)->get();
        if(is_null($abonnement)){
            return response()->json(['message'=>'Abonnement does not exist'], 404);
        }
        return response()->json($abonnement, 200);
    }
    public function getIdabonnement($auto_id){
        $abonnement = Abonnement::where('auto_ecole_id', $auto_id)->get(); 
        if(is_null($abonnement)){
            return response()->json(['message'=>'Abonnement does not exist'], 404);
        }
        
        return response()->json($abonnement, 200);
    }


    public function getAbonnementById($id){
        $abonnement = Abonnement::find($id); 
        if(is_null($abonnement)){
            return response()->json(['message'=>'Abonnement does not exist'], 404);
        }
        
        return response()->json($abonnement, 200);
    }

   public function getAbonnementAutoEcolesById($id)
   {
        $abonnement = Abonnement::find($id); 
        if(is_null($abonnement)){
            return response()->json(['message'=>'Abonnement does not exist'], 404);
        }
        
        return response()->json($abonnement, 200);
   }

    public function newAbonnement($auto_id, request $request){
        $autoEcole = AutoEcole::find($auto_id);
        if(is_null($auto_id)){
            return response()->json(['message'=>'auto ecole does not exist'],404);
        }

        $abonnement = Abonnement::create([
            'auto_ecole_id'=>$autoEcole_id,
            'prix'=>$request->prix,
            'date_fin'=>$request->date_fin,
            'date_debut'=>$request->date_debut 
         ]);
         $abonnement->save();
         return response()->json($abonnement, 200);
    }

    public function updateAbonnementAutoEcole($id, request $request){
         
        $abonnement = Abonnement::find($id);
        if(is_null($abonnement)){
            return reponse()->json(['message'=>'abonnement does not exist in db'], 404);
        }
        $abonnement->prix = $request->prix;
        $abonnement->date_fin = $request->date_fin;
        $abonnement->date_debut = $request->date_debut; 
        $abonnement->save();
          return response()->json($abonnement, 200);        
    }
    
    public function deletAbonnement($id)
    {
        $abonnement = Abonnement::find($id);
        if(is_null($abonnement)){
            return response()->json(['message'=>'abonnement does not exist in db'], 404);
        }
        $abonnement->delete();
        return response()->json(['message'=>'abonnement deleted from db'], 200);
    }
}
