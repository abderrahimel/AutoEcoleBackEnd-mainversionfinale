<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit_admin_auto_ecole; 

class ProduitAdminController extends Controller
{   public function getProduitAdminById($id)
    {
        $produit = Produit_admin_auto_ecole::find($id);
        if (is_null($produit)) {
            return response()->json(['message'=>"produit Admin n'est pas trouvée"],404);
        }
        return response()->json($produit, 200);
    }
    public function getAllProduitAdmin()
    {
        $produits = Produit_admin_auto_ecole::all();
        return response()->json($produits, 200);
    }
    
    public function updateProduitAdmin($id, Request $request)
    {
        $produit = Produit_admin_auto_ecole::find($id);
        if (is_null($produit)) {
            return response()->json(['message'=>"produit Admin n'est pas trouvée"],404);
        }
        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('produitsAdmin/').$name_image);
        }

        $produit->nomCategorie = $request->nomCategorie;
        $produit->titre = $request->titre;
        $produit->prix = $request->prix;
        $produit->marque = $request->marque;
        $produit->modele = $request->modele;
        $produit->carburant = $request->carburant;
        $produit->kilometrage = $request->kilometrage;
        $produit->prixPromotion = $request->prixPromotion;
        $produit->description = $request->description;
        $produit->image = $name_image;
        $produit->save();
        return response()->json($produit, 200);
    }
    public function newProduit(Request $request)
    {
        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('produitsAdmin/').$name_image);
        }

        $produit = Produit_admin_auto_ecole::create([
            'nomCategorie'=> $request->categorie,
            'titre' => $request->titre,
            'prix' => $request->prix,
            'prixPromotion' => $request->prixPromotion,
            'description' => $request->description,
            'marque' => $request->marque,
            'modele' => $request->model,
            'carburant' => $request->carburant,
            'kilometrage' => $request->kilometrage,
            'image' => $name_image
        ]);
        $produit->save();
        return response()->json($produit, 200);
    }
}

