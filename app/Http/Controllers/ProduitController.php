<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function getProduit($ecole_id)
    {
        $ecole = AutoEcole::find($ecole_id);
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
        $ecole = AutoEcole::find($ecole_id);
        $produit = Produit::create([
            'auto_ecole_id'=>$ecole_id,
            'fournisseur'=>$request->fournisseur,
            'telephone'=>$request->telephone,
            'libelle'=>$request->libelle,
            'prix'=>$request->prix,
            'quantite'=>$request->quantite,
            'description'=>$request->description,
        ]);
        $produit->save();
        return response($produit,201);
    }

    public function updateProduit($id,Request $request)
    {
        $produit = Produit::find($id);
        if (is_null($produit)) {
            return response()->json(['message'=>"Produit n'est pas trouvée"],404);
        }
        $produit->fournisseur = $request->fournisseur;
        $produit->telephone = $request->telephone;
        $produit->libelle = $request->libelle;
        $produit->prix = $request->prix;
        $produit->quantite = $request->quantite;
        $produit->description = $request->description;
        $produit->save();
        return response()->json($produit,200);
    }

    public function deleteProduit($id)
    {
        $produit = Produit::find($id);
        if (is_null($produit)) {
            return response()->json(['message'=>"Produit n'est pas trouvée"],404);
        }
        $produit->delete();
        return response()->json(['message'=>'deleted this produit from database'],200);
    }

}
