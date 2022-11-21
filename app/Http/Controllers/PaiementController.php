<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\Paiement;
use App\Models\Employe;
use Illuminate\Support\Facades\Validator;


class PaiementController extends Controller
{
   
    public function getPaiement($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $paiements = $ecole->paiements;
        foreach ($paiements as $paiement) {
            $paiement->employe;
        }
        return response()->json($paiements,200);
    }

    public function getPaiementById($id)
    {
        $paiement = Paiement::find($id);
        if(is_null($paiement)){
            return response()->json(['message'=> "Paiement n'est pas trouvée"],404);
        }
        $paiement->employe;
        return response()->json($paiement,200);
    }

    public function addPaiement($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $paiement = new Paiement($request->all()); 
        $ecole -> paiements()->save($paiement);
        $paiement->employe;
        return response($paiement,201);
    }

    public function deletePaiement($id)
    {
        $paiement = Paiement::find($id);
        if (is_null($paiement)) {
            return response()->json(['message'=>"Paiement n'est pas trouvé"],404);
        }
        $paiement->delete();
        return response()->json(null,204);
    }



}
