<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepenseVehicule;
use App\Models\AutoEcole;

use App\Models\CategorieDepence;
class Depense_vehiculeController extends Controller
{
    public function getDepencevehicule($ecole_id)
    {
        $ecole = AutoEcole::find($ecole_id);
        if (is_null($ecole)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $depenceslocals = DepenseVehicule::where('auto_ecole_id', $ecole_id)->get();
        foreach ($depenceslocals as $depenceslocal) {
            $depenceslocal['categorie'] = CategorieDepence::find($depenceslocal->categorie_depence_id);
            $depenceslocal->vehicule;
        }
        return response()->json($depenceslocals,200);
    }

    public function getDepences($ecole_id){
        $ecole = AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Catégorie n'est pas trouvée"],404);
        }

        
    }
    
    public function getDepencevehiculeById($id)
    {
        $depencevehicule = DepenseVehicule::find($id);
        if(is_null($depencevehicule)){
            return response()->json(['message'=> "Dépense n'est pas trouvée"],404);
        }
        return response()->json($depencevehicule,200);
    }
    public function addDepencevehicule($ecole_id,Request $request)
    {
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvé"],404);
        }
        $depence_vehicule = DepenseVehicule::create([
            'auto_ecole_id'=>$ecole_id,
            'categorie_depence_id'=>$request->id_categorie,
            'vehicule_id'=>$request->id_vehicule,
            'date'=>$request->date,
            'montant'=>$request->montant,
            'remarques'=>$request->remarque
        ]);
        $depence_vehicule->save();
        return response($depence_vehicule,201);
    }

    public function updateDepencevehicule($id, Request $request)
    {
        $depencevehicule = DepenseVehicule::find($id);
        if (is_null($depencevehicule)) {
            return response()->json(['message'=>"Depence vehicule n'est pas trouvée"],404);
        }
        $depencevehicule->categorie_depence_id = $request->id_categorie;
        $depencevehicule->vehicule_id = $request->id_vehicule;
        $depencevehicule->date = $request->date;
        $depencevehicule->montant = $request->montant;
        $depencevehicule->remarques = $request->remarque;
        $depencevehicule->save();
        return response($depencevehicule,200);
    }
    public function deleteDepencevehicule($id)
    {
        $depencevehicule = DepenseVehicule::find($id);
        if (is_null($depencevehicule)) {
            return response()->json(['message'=>"depense vehicule n'est pas trouvée"],404);
        }
        $depencevehicule->delete();
        return response()->json(['message'=>"Depense vehicule deleted ..."],200);
    }
}
