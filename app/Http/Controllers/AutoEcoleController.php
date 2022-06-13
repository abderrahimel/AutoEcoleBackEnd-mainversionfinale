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
   public function  getAutoEcoleById($id)
   {
       $autoEcole = DB::table('auto_ecoles')->where('id', '=', $id)->get();
      
       if(is_null($autoEcole)){
        $autoEcole = DB::table('auto_ecoles')->where('id', '=', $id)->whereNotNull('deleted_at')->get();
        // $autoEcole = AutoEcole::where()::where('deleted_at', '!=', null)->get();
         }
         foreach($autoEcole as $key => $ecole) {
            $img = $ecole->image;
            $path = 'images/' . $img;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $ecole->image = $base64;    
        }
         return response()->json($autoEcole,200);
   }
}
