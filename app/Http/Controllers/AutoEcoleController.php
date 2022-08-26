<?php

namespace App\Http\Controllers;
use App\Models\AutoEcole;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AutoEcoleController extends Controller
{
    public function getAutoEcoles()
    {
        $ecoles = AutoEcole::all();
        foreach($ecoles as $key => $ecole) {
            $ecole->abonnement;
        }
        return response()->json($ecoles,200);
        
    }
     public function updateAutoEcole($id, Request $request)
     {
        $autoEcole = AutoEcole::find($id);
        if(is_null($autoEcole)){
            return response()->json(['message'=>'auto ecole does not exist'], 404);
        }
        
        $autoEcole->nom_auto_ecole = $request->nom_auto_ecole;
        $autoEcole->telephone = $request->telephone;
        $autoEcole->pays = $request->pays;
        $autoEcole->ville = $request->ville;
        $autoEcole->fax = $request->fax;
        $autoEcole->site_web = $request->site_web;
        $autoEcole->adresse = $request->adresse;
        $autoEcole->n_cnss = $request->n_cnss;
        $autoEcole->ice = $request->ice;
        $autoEcole->tva = $request->tva;
         $autoEcole->n_register_de_commerce = $request->n_register_de_commerce;
        $autoEcole->n_compte_bancaire = $request->n_compte_bancaire;
         $autoEcole->n_agrement = $request->n_agrement;
        $autoEcole->n_patente = $request->n_patente;
        $autoEcole->date_autorisation = $request->date_autorisation;
        $autoEcole->date_ouverture = $request->date_ouverture;
        $autoEcole->identification_fiscale = $request->identification_fiscale;
        $autoEcole->cin_responsable = $request->cin_responsable;
        $autoEcole->nom_responsable = $request->nom_responsable;
        $autoEcole->prenom_responsable = $request->prenom_responsable;
        $autoEcole->tel_responsable = $request->tel_responsable;
        $autoEcole->adresse_responsable = $request->adresse_responsable;
        $autoEcole->save();

       return response()->json($autoEcole,200);
     }
    public function getAutoEcolesApprouve(){
        $autoEcolesApprouves = AutoEcole::where('etat', "approuve")->get();
        foreach($autoEcolesApprouves as $key => $autoEcolesApprouve) {
            $autoEcolesApprouve->abonnement;
        }
        return response()->json($autoEcolesApprouves,200);
    }

    public function getAutoEcoleByIdUser($id)
    {
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['message'=>'user does not exist'], 404);
        }
        $autoEcole = $user->autoEcoles;
        foreach($autoEcole as $key => $ecole) {
            $img = $ecole->image;
            $path = 'images/' . $img;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $ecole->image = $base64;    
        }
        return response()->json($autoEcole, 200);
    }



   public function  getAutoEcoleById($id)
   {
       $autoEcole = AutoEcole::findOrFail($id);

       if(is_null($autoEcole)){
        return response()->json(['message'=>'auto ecole does not exist'], 404);
         }

            // logo auto ecole
            $img = $autoEcole->image;
            $path = 'images/' . $img;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $autoEcole->image = $base64;   
            // image rc
            $img = $autoEcole->image_rc;
            $path = 'image_rc/' . $img;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $autoEcole->image_rc = $base64;  
            // //  image_cin
            $img = $autoEcole->image_cin;
            $path = 'image_cin/' . $img;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $autoEcole->image_cin = $base64;  
            // // image_agrement
            $img = $autoEcole->image_agrement;
            $path = 'image_agrement/' . $img;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $autoEcole->image_agrement = $base64;  
       
         return response()->json($autoEcole,200);
   }

   public function getAutoEcoleByIdDeleted($id){ 

    $autoEcole = DB::table('auto_ecoles')->whereNotNull('deleted_at')->get();

    if(is_null($autoEcole)){
     return response()->json(['message'=>'auto ecole does not exist'], 404);
      }
         // logo auto ecole
         $img = $autoEcole->image;
         $path = 'images/' . $img;
         $type = pathinfo($path, PATHINFO_EXTENSION);
         $data = file_get_contents($path);
         $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
         $autoEcole->image = $base64;   
         // image rc
         $img = $autoEcole->image_rc;
         $path = 'image_rc/' . $img;
         $type = pathinfo($path, PATHINFO_EXTENSION);
         $data = file_get_contents($path);
         $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
         $autoEcole->image_rc = $base64;  
         //  image_cin
         $img = $autoEcole->image_cin;
         $path = 'image_cin/' . $img;
         $type = pathinfo($path, PATHINFO_EXTENSION);
         $data = file_get_contents($path);
         $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
         $autoEcole->image_cin = $base64;  
         // image_agrement
         $img = $autoEcole->image_agrement;
         $path = 'image_agrement/' . $img;
         $type = pathinfo($path, PATHINFO_EXTENSION);
         $data = file_get_contents($path);
         $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
         $autoEcole->image_agrement = $base64;  
    
      return response()->json($autoEcole,200);
   }
}
