<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\CategorieDepence;
use App\Models\Depence;
use App\Models\Employe;

class DepenceController extends Controller
{
    public function getDepence($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $depences = $ecole->depences;
        return response()->json($depences,200);
        
    }

    public function getDepenceById($id)
    {
        $depence = Depence::find($id);
        if(is_null($depence)){
            return response()->json(['message'=> "Dépense n'est pas trouvée"],404);
        }
        $depence->categorie = CategorieDepence::find($depence->categorie_depence_id);
        $depence->employe;
        return response()->json($depence,200);
    }

    public function addDepence($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $depence = new Depence($request->all()); 
        $ecole -> depences()->save($depence);
        $categorie = CategorieDepence::find($depence->categorie_depence_id);
        $depence->employe;
        $categorie -> depences()->save($depence);
        $depence->categorie = $categorie;
        return response($depence,201);
    }


    public function updateDepence($id,Request $request)
    {
        $depence=Depence::find($id);
        if (is_null($depence)) {
            return response()->json(['message'=>"Depence n'est pas trouvée"],404);
        }
        $depence->categorie_depence_id = $request -> categorie_depence_id;
        $depence->employe_id = $request -> employe_id;
        $depence->date = $request -> date;
        $depence->montant = $request -> montant;
        $depence->remarques = $request -> remarques;
        $depence->save();
        $depence->categorie = CategorieDepence::find($depence->categorie_depence_id);
        $depence->employe;
        $depence->categorie;
        return response($depence,200);
    }

    public function deleteDepence($id)
    {
        $categorie = Depence::find($id);
        if (is_null($categorie)) {
            return response()->json(['message'=>"Catégorie n'est pas trouvée"],404);
        }
        $categorie->delete();
        return response()->json(null,204);
    }

}
