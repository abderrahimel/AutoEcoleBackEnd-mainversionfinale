<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DevisController extends Controller
{
    public function addDevis($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvé"],404);
        }
        $devis = Devis::create([
            'auto_ecole_id'=>$ecole_id,
            'candidat_id'=>$request->candidat_id,
            'numero'=>$request->numero,
            'date'=>$request->date,
            'societe'=>$request->societe,
            'remarque'=>$request->remarque
        ]);
        $devis->save();
        $ecole -> devis()->save($devis);
        return response($devis,201);
    }
}
