<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\AutoEcole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RecetteController extends Controller
{
    public function getRecette($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Catégorie n'est pas trouvée"],404);
        }
        $recettes = $ecole-> recettes;
        return response()->json($recettes,200);
        
    }
    

    public function getRecetteById($id)
    {
        $recettes = Recette::find($id);
        if(is_null($recettes)){
            return response()->json(['message'=> "Recette n'est pas trouvée"],404);
        }
        return response()->json($recettes,200);
    }


    public function addRecette($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $recette = new Recette($request->all()); 
        $ecole -> recettes()->save($recette);
        return response($recette,201);
    }


    public function updateRecette($id,Request $request)
    {
        $recette =Recette::find($id);
        if (is_null($recette)) {
            return response()->json(['message'=>"Categorie n'est pas trouvée"],404);
        }
        $recette ->auto_ecole_id = $recette->auto_ecole_id;
        $recette ->type = $request -> type;
        $recette ->montant = $request -> montant;
        $recette ->date = $request -> date;
        $recette ->remarques = $request -> remarques;
        $recette ->save();
        return response($recette,200);
    }

    public function deleteRecette($id)
    {
        $recette = Recette::find($id);
        if (is_null($recette)) {
            return response()->json(['message'=>"Catégorie n'est pas trouvée"],404);
        }
        $recette->delete();
        return response()->json(null,204);
    }
}
