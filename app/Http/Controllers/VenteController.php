<?php

namespace App\Http\Controllers;

use App\Models\AutoEcole;
use App\Models\Vente;
use App\Models\Candidat;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    public function getVente($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $ventes = Vente::where('auto_ecole_id', $ecole_id)->get();
        
        return response()->json($ventes,200);
        
    }


    public function getVenteById($id)
    {
        $vente = Vente::find($id);
        if(is_null($vente)){
            return response()->json(['message'=> "Vente n'est pas trouvée"],404);
        }

        return response()->json($vente,200);
    }

    public function addVente($ecole_id,Request $request)
    {
        $ecole = AutoEcole::find($ecole_id);
        if (is_null($ecole)) {
            return response()->json(['message'=>"auto ecole n'est pas trouvée"],404);
        }
        $vente = Vente::create([
            'auto_ecole_id' => $ecole_id,
            'produit_id'  => $request->produit_id,
            'candidat_id'  => $request->candidat_id,
            'prixUnitaire' => $request->prixUnitaire,
            'prixTotale' => $request->prixTotale,
            'quantiteDisponible' => $request->quantiteDisponible,
            'quantite' => $request->quantite,
            'date' => $request->date
        ]); 
        $vente->save();
        return response($vente,201);
    }

    public function updateVente($id,Request $request)
    { 
        $vente=Vente::find($id);
        if (is_null($vente)) {
            return response()->json(['message'=>"Vente n'est pas trouvée"],404);
        }
     
        $vente->candidat_id = $request->candidat_id;
        $vente->date = $request->date;
        $vente->produit_id = $request->produit_id;
        $vente->prixUnitaire = $request->prixUnitaire;
        $vente->prixTotale = $request->prixTotale;
        $vente->quantiteDisponible = $request->quantiteDisponible;
        $vente->quantite = $request->quantite;
        $vente->save();
        return response($vente,200);
    }

    public function deleteVente($id)
    {
        $vente = Vente::find($id);
        if (is_null($vente)) {
            return response()->json(['message'=>"Vente n'est pas trouvée"],404);
        }
        $vente->delete();
        return response()->json(['message'=>'vente deleted from db'],204);
    }
}
