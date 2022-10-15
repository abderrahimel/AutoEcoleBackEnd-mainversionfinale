<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit_admin_auto_ecole; 

class ProduitAdminController extends Controller
{   
    public function getProduitAdminById($id)
    {
        $produit = Produit_admin_auto_ecole::find($id);
        if(!is_null($produit->image)){
            $produit->image = 'http://' . request()->getHttpHost() . '/' . 'produitsAdmin/' .  $produit->image;     
        }
        if (is_null($produit)) {
            return response()->json(['message'=>"produit Admin n'est pas trouvée"],404);
        }
        return response()->json($produit, 200);
    }

    public function getboutique()
    {
        $produits = Produit_admin_auto_ecole::where('categorie', '!=', 'vehicule occasion')->get();
        foreach($produits as $key => $produit) {
            if($produit->image){
                $produit->image = 'http://' . request()->getHttpHost() . '/' . 'produitsAdmin/' .  $produit->image;     
            }
        }
        
        return response()->json($produits, 200);
    }

    public function getvehiculeOccassion()
    {
        $produits = Produit_admin_auto_ecole::where('categorie', 'vehicule occasion')->get();
        foreach($produits as $key => $produit) {
            if($produit->image){
                $img = $produit->image;
                $produit->image = 'http://' . request()->getHttpHost() . '/' . 'produitsAdmin/' .  $produit->image;     
            }
        }

        return response()->json($produits, 200);
    }
    public function getAllProduitAdmin()
    {
        $produits = Produit_admin_auto_ecole::all();
        foreach($produits as $key => $produit) {
            if($produit->image){
                $img = $produit->image;
                $path = 'produitsAdmin/' . $img;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                $produit->image = $base64;      
            }
        }

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
        
        $produit->nomCategorie = $request->categorie;
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
         $name_image = '';
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
    public function deleteProduit($id)
    {
        $produitAdmin = Produit_admin_auto_ecole::find($id);
        if(is_null($produitAdmin)){
            return response()->json(['message'=>'produit admin does not exist'], 404);
        }
        $produitAdmin->delete();
        return  response()->json(['message'=>'produit admin deleted from db'], 200);

    }
}

