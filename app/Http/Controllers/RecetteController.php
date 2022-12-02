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
    public function getrecettegeneral($ecole_id)
    {
                // // this.dataService.getProduitCandidats(action.idAutoEcole)  // produit candidat
                    $ecole=AutoEcole::find($ecole_id);
                    if (is_null($ecole_id)) {
                        return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
                    }
                    $ventes = Vente::where('auto_ecole_id', $ecole_id)->get();
                    foreach ($ventes as $vente) {
                        $vente->candidat;
                        $vente->produit;
                    }
                    return response()->json($ventes,200);
                // // this.dataService.getPaiementCandidats(action.idAutoEcole) // cours supplementaire + permis 
                    $paiments = PaimentCandidat::where('auto_ecole_id', $ecole_id)->get();
                    if (is_null($paiments)) {
                       return response()->json(['message'=>"paiment candidats n'est pas trouvée"],404);
                   }
                    foreach($paiments as $paiment){
                        $paiment->candidat;
                        }
                        return response()->json($paiments,200);
                // // {
                //     this.coursupplementaire = this.coursupplementaire.filter(cs=>cs.candidat?.type_formation === 'supplementaire');
                //     this.coursbasic = this.coursbasic.filter(cs=>cs.candidat?.type_formation === 'basic');
                // // }
                // permis:  action.basic,
                // coursSupplementaire:action.supplementaire


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
