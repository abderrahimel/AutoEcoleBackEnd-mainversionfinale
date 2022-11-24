<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\CategorieDepence;
use App\Models\Depence;
use App\Models\Employe;
use App\Models\Depense_local;
use Illuminate\Support\Facades\Validator;


class DepenceController extends Controller
{
    public function getDepence($ecole_id)
    {
        $ecole = AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $depences = Depence::where('auto_ecole_id', $ecole_id)->get();
        foreach ($depences as $depence) {
            $depence['categorie'] = CategorieDepence::find($depence->categorie_depence_id);
            $depence->employe;
        }
        return response()->json($depences,200);
        
    }

    public function getDepenceById($id)
    {
        $depence = Depence::find($id);
        if(is_null($depence)){
            return response()->json(['message'=> "Dépense n'est pas trouvée"],404);
        }
        $depence->categorie = CategorieDepence::find($depence->categorie_depence_id);
        return response()->json($depence,200);
    }

    public function addDepence($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvé"],404);
        }
        
        $validator = Validator::make($request->all(), [
            'id_categorie' =>'required',
            'id_employe' =>'required',
            'date' =>'required',
            'montant' =>'required',
            'remarque' =>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }

        $depence = Depence::create([
            'auto_ecole_id'=>$ecole_id,
            'categorie_depence_id'=>$request->id_categorie,
            'employe_id'=>$request->id_employe,
            'date'=>$request->date,
            'montant'=>$request->montant,
            'remarques'=>$request->remarque
        ]);
        $depence->save();
        return response($depence,201);
    }


    public function updateDepence($id,Request $request)
    {
        $depence = Depence::find($id);
        if (is_null($depence)) {
            return response()->json(['message'=>"Depence n'est pas trouvée"],404);
        }
        $validator = Validator::make($request->all(), [
            'id_categorie' =>'required',
            'id_employe' =>'required',
            'date' =>'required',
            'montant' =>'required',
            'remarque' =>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        $depence->categorie_depence_id = $request->id_categorie;
        $depence->employe_id = $request->id_employe;
        $depence->date = $request-> date;
        $depence->montant = $request->montant;
        $depence->remarques = $request ->remarque;
        $depence->save();
        return response($depence,200);
    }

    public function deleteDepence($id)
    {
        $depense = Depence::find($id);
        if (is_null($depense)) {
            return response()->json(['message'=>"depense personnel n'est pas trouvée"],404);
        }
        $depense->delete();
        return response()->json(['message'=>"Depense deleted ..."],200);
    }

}
