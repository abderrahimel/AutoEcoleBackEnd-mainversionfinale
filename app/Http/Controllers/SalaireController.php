<?php

namespace App\Http\Controllers;


use App\Models\Salaire;
use App\Models\AutoEcole;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SalaireController extends Controller
{
    public function getSalaire($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $Salaires = $ecole->salaires;
        return response()->json($Salaires,200);
    }


    public function getSalaireById($id)
    {
        $salaire = Salaire::find($id);
        if(is_null($salaire)){
            return response()->json(['message'=> "salaire n'est pas trouvée"],404);
        }

        $salaire -> employe;
        return response()->json($salaire,200);
    }

    public function addSalaire($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $salaire = new Salaire($request->all()); 
        $ecole -> salaires()->save($salaire);
        $salaire -> employe;
        return response($salaire,201);
    }

    public function updateSalaire($id,Request $request)
    {
        $salaire=Salaire::find($id);
        if (is_null($salaire)) {
            return response()->json(['message'=>"salaire n'est pas trouvée"],404);
        }
        $salaire->auto_ecole_id = $salaire->auto_ecole_id;
        $salaire->employe_id = $request -> employe_id;
        $salaire->date = $request -> date;
        $salaire->montant = $request -> montant;
        $salaire->save();
        $salaire -> employe;
        return response($salaire,200);
    }

    public function deleteSalaire($id)
    {
        $salaire = Salaire::find($id);
        if (is_null($salaire)) {
            return response()->json(['message'=>"salaire n'est pas trouvée"],404);
        }
        $salaire->delete();
        return response()->json(null,204);
    }
}
