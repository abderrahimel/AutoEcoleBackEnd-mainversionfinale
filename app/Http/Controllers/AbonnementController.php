<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Abonnement;
use App\Models\AutoEcole;

class AbonnementController extends Controller
{
    public function getAbonnements(){
        $abonnement = Abonnement::all();
         return response()->json($abonnement, 200);
    }
 
    public function getAbonnementById($id){
        $abonnement = Abonnement::find($id); 
        if(is_null($abonnement)){
            return response()->json(['message'=>'Abonnement does not exist'], 404);
        }
        
        return response()->json($abonnement, 200);
    }

   public function getAbonnementAutoEcoles($auto_id)
   {
    $auto_ecole = AutoEcole::find($auto_id); 
    if(is_null($auto_ecole)){
        return response()->json(['message'=>'Abonnement does not exist'], 404);
    }
     $abonnement = Abonnement::where('auto_ecole_id', $auto_id)->get();
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

    public function updateAbonnementAutoEcole(request $request, $auto_id){
        $abonn = Abonnement::where('auto_ecole_id', $auto_id);
        // $abonnement = Abonnement::find($abonn->id);
        // if(is_null($abonnement)){
        //     return reponse()->json(['message'=>'abonnement does not exist in db'], 404);
        // }
        // $abonnement->prix = $request->prix;
        // $abonnement->date_fin = $request->date_fin;
        // $abonnement->date_debut = $request->date_debut; 
        // $abonnement->save();
         response()->json($abonn, 200);        
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
