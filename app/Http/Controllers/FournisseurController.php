<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Validator;


class FournisseurController extends Controller
{
    public function getFournisseur($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $fournisseur = $ecole->fournisseurs;
        return response()->json($fournisseur,200);
    }

    public function getFournisseurById($id)
    {
        $fournisseur = Fournisseur::find($id);
        if(is_null($fournisseur)){
            return response()->json(['message'=> "Facture n'est pas trouvée"],404);
        }
        return response()->json($fournisseur,200);
    }

    public function addFournisseur($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $fournisseur = new Fournisseur($request->all()); 
        $ecole -> factures()->save($fournisseur);
        $fournisseur = Fournisseur::find($fournisseur->id);
        $fournisseur -> candidat;
        return response($fournisseur,201);
    }

    public function updateFournisseur($id,Request $request)
    {
        $fournisseur=Fournisseur::find($id);
        if (is_null($fournisseur)) {
            return response()->json(['message'=>"facture n'est pas trouvée"],404);
        }
        $fournisseur->raison_social= $request -> raison_social;
        $fournisseur->type = $request -> type;
        $fournisseur->telephone = $request -> telephone;
        $fournisseur->ville = $request -> ville;
        $fournisseur->pays = $request -> pays;
        $fournisseur->email = $request -> email;
        $fournisseur->adresse = $request -> adresse;
        $fournisseur->save();
        $fournisseur->candidat;
        return response($fournisseur,200);
    }

    public function deleteFournisseur($id)
    {
        $paiement = Fournisseur::find($id);
        if (is_null($paiement)) {
            return response()->json(['message'=>"Paiement n'est pas trouvé"],404);
        }
        $paiement->delete();
        return response()->json(null,204);
    }

    
}
