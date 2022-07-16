<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\Facture;

class FactureController extends Controller
{
    public function getFacture($ecole_id)
    {
        $ecole = AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Facture n'est pas trouvée"],404);
        }
        $factures = Facture::where('auto_ecole_id', $ecole_id)->get();
        foreach ($factures as $facture) {
            $facture->candidat;
        }
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
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvé"],404);
        }
        $facture = Facture::create([
                    'auto_ecole_id'=>$ecole_id,
                    'date'=>$request->date,
                    'candidat_id'=>$request->candidat_id,
                    'tva'=>$request->tva,
                    'montant_ttc'=>$request->montant_ttc,
                    'montant_ht'=>$request->montant_ht,
                    'remarque'=>$request->remarque
        ]);
        $facture->save();
        return response($facture,201);
    }

    public function updateFacture($id,Request $request)
    {
        $facture=Facture::find($id);
        if (is_null($facture)) {
            return response()->json(['message'=>"facture n'est pas trouvée"],404);
        }
        $facture->auto_ecole_id = $facture->auto_ecole_id;
        $facture->candidat_id= $request->candidat_id;
        $facture->date = $request->date;
        $facture->tva = $request->tva;
        $facture->montant_ttc = $request->montant_ttc;
        $facture->montant_ht = $request->montant_ht;
        $facture->remarque = $request-> remarque;
        $facture->save();
        return response()->json($facture,200);
    }


    public function deleteFacture(Request $request,$id)
    {
        $facture = Facture::find($id);
        if (is_null($facture)) {
            return response()->json(['message'=>"Facture n'est pas trouvée"],404);
        }
        $facture->delete();
        return response()->json(['message'=>'facture deleted'],204);
    }
}
