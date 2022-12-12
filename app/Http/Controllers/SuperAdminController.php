<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\User;
use App\Models\Vehicule;
use App\Models\MoniteurTheorique;
use App\Models\MoniteurPratique;
use App\Models\CategorieDepence;
use App\Models\Note;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
   public function getdataSuper()
   {
    $totalAutoecoles = AutoEcole::where('deleted_at','=', null)->count();
    $totalAutoecolesapprouve = AutoEcole::where('etat','=', 'approuve')->count();
    $totalAutoecolesen_attente = AutoEcole::where('etat','=', 'en_attente')->count();
    $totalAutoecolesarchive = AutoEcole::onlyTrashed()->count();
    return response()->json(['totalAE'=>$totalAutoecoles, 'totalAEA'=>$totalAutoecolesapprouve, 'totalAE_Attente'=>$totalAutoecolesen_attente, 'totalAECOLEarchive'=>$totalAutoecolesarchive], 200);
   }
   public function getautoecolesEnattente(){
      $autoEcolesApprouves = AutoEcole::where('etat','=',"en_attente")->get();
      foreach($autoEcolesApprouves as $key => $autoEcolesApprouve) {
          $autoEcolesApprouve->abonnement;
          $autoEcolesApprouve['gmail'] = User::find($autoEcolesApprouve->user_id)['email'];
      }
      return response()->json($autoEcolesApprouves, 200);

   }

   public function configuration($ecole_id){
       $cvehicules = Vehicule::where('auto_ecole_id', $ecole_id)->where('deleted_at','=', null)->count();
       $countMoniteurT =  MoniteurTheorique::where('auto_ecole_id', $ecole_id)->where('deleted_at','=', null)->count();
       $countMoniteurP =  MoniteurPratique::where('auto_ecole_id', $ecole_id)->where('deleted_at','=', null)->count();
       $countPersonnel = CategorieDepence::where('auto_ecole_id',$ecole_id)->where('type', 'personnel')->where('deleted_at', null)->count();
       $countVehicule = CategorieDepence::where('auto_ecole_id', $ecole_id)->where('type', 'vehicule')->where('deleted_at', null)->count();
       $countLocal = CategorieDepence::where('auto_ecole_id',$ecole_id)->where('type', 'local')->where('deleted_at', null)->count();
       $countNotesCategories = Note::where('auto_ecole_id', $ecole_id)->where('deleted_at', null)->count();
       $var = $cvehicules * $countMoniteurT * $countMoniteurP * $countPersonnel * $countVehicule * $countLocal * $countNotesCategories;
       if($var != 0 ){
         return response()->json(['c'=>true, [$cvehicules, $countMoniteurT ,$countMoniteurP , $countPersonnel ,$countVehicule , $countLocal , $countNotesCategories]], 200);
       }else{
         return response()->json(['c'=>false, [$cvehicules, $countMoniteurT ,$countMoniteurP , $countPersonnel ,$countVehicule , $countLocal , $countNotesCategories]], 200);
       }
   }
  
}

/**
           
 */