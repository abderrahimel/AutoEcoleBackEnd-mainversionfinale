<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depense_local;
use App\Models\AutoEcole;
use App\Models\CategorieDepence;
use Illuminate\Support\Facades\Validator;

class Depense_localController extends Controller
{
    public function getDepencelocal($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $depenceslocals = Depense_local::where('auto_ecole_id', $ecole_id)->get();

        foreach ($depenceslocals as $depenceslocal) {
            $depenceslocal['categorie']= CategorieDepence::find($depenceslocal->categorie_depence_id);
        }
        return response()->json($depenceslocals,200);
        
    }
    public function getDepencelocalbyMonth($ecole_id, $id){
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $depenceslocals = Depense_local::where('auto_ecole_id', $ecole_id)->get();
    }
    public function getDepencelocalById($id)
    {
        $depencelocal = Depense_local::find($id);
        if(is_null($depencelocal)){
            return response()->json(['message'=> "Dépense n'est pas trouvée"],404);
        }
        
        return response()->json($depencelocal,200);
    }
    public function addDepencelocal($ecole_id,Request $request)
    {
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvé"],404);
        }
        $validator = Validator::make($request->all(), [
            'id_categorie' =>'required',
            'date' => 'required',
            'montant' => 'required',
            'remarque' => 'required',
        ]);
       
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        $depence_local = Depense_local::create([
            'auto_ecole_id'=>$ecole_id,
            'categorie_depence_id'=>$request->id_categorie,
            'date'=>$request->date,
            'montant'=>$request->montant,
            'remarques'=>$request->remarque
        ]);
        $depence_local->save();
        return response($depence_local,201);
    }
    
    public function updateDepencelocal($id,Request $request)
    {
        $depencelocal = Depense_local::find($id);
        if (is_null($depencelocal)) {
            return response()->json(['message'=>"Depence local n'est pas trouvée"],404);
        }
        $validator = Validator::make($request->all(), [
            'id_categorie' =>'required',
            'date' => 'required',
            'montant' => 'required',
            'remarque' => 'required',
        ]);
       
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        $depencelocal->categorie_depence_id = $request->id_categorie;
        $depencelocal->date = $request->date;
        $depencelocal->montant = $request->montant;
        $depencelocal->remarques = $request->remarque;
        $depencelocal->save();
        return response($depencelocal,200);
    }

    public function deleteDepencelocal($id)
    {
        $depenselocal = Depense_local::find($id);
        if (is_null($depenselocal)) {
            return response()->json(['message'=>"Catégorie n'est pas trouvée"],404);
        }
        $depenselocal->delete();
        return response()->json(['message'=>"Depense deleted ..."],200);
    }

}
