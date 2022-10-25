<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\CategorieDepence;

class CategorieDepenceController extends Controller
{
    public function getCategorieDepence($ecole_id)
    {
        $ecole = AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Catégorie n'est pas trouvée"],404);
        }
        $categories = CategorieDepence::where('auto_ecole_id', $ecole_id)->get();
        if (is_null($categories)) {
            return response()->json(['message'=>"Catégorie Depence n'est pas trouvée"],404);
        }
        return response()->json($categories,200);
        
    }
    public function getCategorieDepenceVehicule($ecole_id)
    {
        $ecole = AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"auto ecole n'est pas trouvée"],404);
        }
        $categories = CategorieDepence::where('auto_ecole_id', $ecole_id)->where('type', 'vehicule')->get();
        if (is_null($categories)) {
            return response()->json(['message'=>"Catégorie Depence n'est pas trouvée"],404);
        }
        return response()->json($categories,200);
        
    }
    public function getCategorieDepencePersonnel($ecole_id)
    {
        $ecole = AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"auto ecole n'est pas trouvée"],404);
        }
        $categories = CategorieDepence::where('auto_ecole_id', $ecole_id)->where('type', 'personnel')->get();
        if (is_null($categories)) {
            return response()->json(['message'=>"Catégorie Depence n'est pas trouvée"],404);
        }
        return response()->json($categories,200);
        
    }
    public function getCategorieDepenceLocal($ecole_id)
    {
        $ecole = AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"auto ecole n'est pas trouvée"],404);
        }
        $categories = CategorieDepence::where('auto_ecole_id', $ecole_id)->where('type', 'local')->get();
        if (is_null($categories)) {
            return response()->json(['message'=>"Catégorie Depence n'est pas trouvée"],404);
        }
        return response()->json($categories,200);
        
    }
    public function getCategorieDepenceById($id)
    {
        $categories = CategorieDepence::find($id);
        if(is_null($categories)){
            return response()->json(['message'=> "Catégorie n'est pas trouvée"],404);
        }
        return response()->json($categories,200);
    }


    public function addCategorieDepence($ecole_id,Request $request)
    {
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvé"],404);
        }
        $categorie = CategorieDepence::create([
            'auto_ecole_id'=>$ecole_id,
            'categorie'=>$request->categorie,
            'type'=>$request->type
        ]);
        $categorie->save();
        return response()->json($categorie,200);
    }

    public function updateCategorieDepence($id,Request $request)
    {
        $categorie=CategorieDepence::find($id);
        if (is_null($categorie)) {
            return response()->json(['message'=>"Categorie n'est pas trouvée"],404);
        }
        $categorie->categorie = $request -> categorie;
        $categorie->save();
        return response()->json($categorie,200);
    }

    public function deleteCategorieDepence  (Request $request,$id)
    {
        $categorie = CategorieDepence::find($id);
        if (is_null($categorie)) {
            return response()->json(['message'=>"Catégorie n'est pas trouvée"],404);
        }
        $categorie->delete();
        return response()->json(null,204);
    }
}
