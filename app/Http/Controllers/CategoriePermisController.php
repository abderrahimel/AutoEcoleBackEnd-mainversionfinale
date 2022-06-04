<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\CategoriePermis;

class CategoriePermisController extends Controller
{
    public function getCategoriePermis($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $categories = $ecole->categoriePermis;
        return response()->json($categories,200);
    }

    public function getCategoriePermisById($id)
    {
        $categories = CategoriePermis::find($id);
        if(is_null($categories)){
            return response()->json(['message'=> "Catégorie n'est pas trouvée"],404);
        }
        return response()->json($categories,200);
    }

    public function addCategoriePermis($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $categorie = new CategoriePermis($request->all()); 
        $ecole -> CategoriePermis()->save($categorie);
        $categorie = CategoriePermis::find($categorie->id);
        return response($categorie,201);
    }

    public function updateCategoriePermis($id,Request $request)
    {
        $categorie=CategoriePermis::find($id);
        if (is_null($categorie)) {
            return response()->json(['message'=>"Categorie n'est pas trouvée"],404);
        }
        $categorie->categorie = $request -> categorie;
        $categorie->description = $request -> description;
        $categorie->save();
        return response($categorie,200);
    }

    public function deleteCategoriePermis($id)
    {
        $categorie = CategoriePermis::find($id);
        if (is_null($categorie)) {
            return response()->json(['message'=>"Catégorie n'est pas trouvée"],404);
        }
        $categorie->delete();
        return response()->json(null,204);
    }


}
