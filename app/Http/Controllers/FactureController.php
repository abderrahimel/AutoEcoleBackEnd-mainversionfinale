<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\Facture;

class FactureController extends Controller
{
    public function getFacture($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Facture n'est pas trouvée"],404);
        }
        $factures = $ecole-> factures;
        return response()->json($factures,200);
        
    }

    public function getFactureById($id)
    {
        $factures = Facture::find($id);
        if(is_null($factures)){
            return response()->json(['message'=> "Facture n'est pas trouvée"],404);
        }
        return response()->json($factures,200);
    }

    public function addFacture($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $facture = new Facture($request->all()); 
        $ecole -> factures()->save($facture);
        $facture = Facture::find($facture->id);
        $facture -> candidat;
        return response($facture,201);
    }

    public function updateFacture($id,Request $request)
    {
        $facture=Facture::find($id);
        if (is_null($facture)) {
            return response()->json(['message'=>"facture n'est pas trouvée"],404);
        }
        $facture->auto_ecole_id = $facture->auto_ecole_id;
        $facture->candidat_id= $request -> candidat_id;
        $facture->montant = $request -> montant;
        $facture->date = $request -> date;
        $facture->societe = $request -> societe;
        $facture->remarques = $request -> remarques;
        $facture->save();
        $facture->candidat;
        return response($facture,200);
    }


    public function deleteFacture(Request $request,$id)
    {
        $facture = Facture::find($id);
        if (is_null($facture)) {
            return response()->json(['message'=>"Catégorie n'est pas trouvée"],404);
        }
        $facture->delete();
        return response()->json(null,204);
    }
}
