<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function getProduit($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $produits = $ecole->produits;
        return response()->json($produits,200);
        
    }

    
    public function getProduitById($id)
    {
        $produit = Produit::find($id);
        if(is_null($produit)){
            return response()->json(['message'=> "Produit n'est pas trouvée"],404);
        }
        $produit->ventes;
        return response()->json($produit,200);
    }


    public function addProduit($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $produit = new Produit($request->all()); 
        $ecole -> produits()->save($produit);
        $produit->ventes;
        return response($produit,201);
    }

    public function updateProduit($id,Request $request)
    {
        $produit=Produit::find($id);
        if (is_null($produit)) {
            return response()->json(['message'=>"Produit n'est pas trouvée"],404);
        }
        $produit->nom = $request -> nom;
        $produit->date = $request -> date;
        $produit->prix = $request -> prix;
        $produit->quantite = $request -> quantite;
        $produit->description = $request -> description;
        $produit->save();
        $produit->ventes;
        return response($produit,200);
    }

    public function deleteProduit($id)
    {
        $produit = Produit::find($id);
        if (is_null($produit)) {
            return response()->json(['message'=>"Produit n'est pas trouvée"],404);
        }
        $produit->delete();
        return response()->json(null,204);
    }

}
