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
        $ventes = $ecole->ventes;
        foreach ($ventes as $vente) {
            $vente->candidat;
        }
        return response()->json($ventes,200);
        
    }


    public function getVenteById($id)
    {
        $vente = Vente::find($id);
        if(is_null($vente)){
            return response()->json(['message'=> "Vente n'est pas trouvée"],404);
        }

        $vente -> employe;
        return response()->json($vente,200);
    }

    public function addVente($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $vente = new Vente($request->all()); 
        $ecole -> ventes()->save($vente);
        $vente -> candidat;
        return response($vente,201);
    }

    public function updateVente($id,Request $request)
    {
        $vente=Vente::find($id);
        if (is_null($vente)) {
            return response()->json(['message'=>"Depence n'est pas trouvée"],404);
        }
        $vente->candidat_id = $request -> candidat_id;
        $vente->date_vente = $request -> date_vente;
        $vente->produit = $request -> produit;
        $vente->prix = $request -> prix;
        $vente->quantite = $request -> quantite;
        $vente->description = $request -> description;
        $vente->save();
        $vente->candidat;
        return response($vente,200);
    }

    public function deleteVente($id)
    {
        $vente = Vente::find($id);
        if (is_null($vente)) {
            return response()->json(['message'=>"Vente n'est pas trouvée"],404);
        }
        $vente->delete();
        return response()->json(null,204);
    }
}
