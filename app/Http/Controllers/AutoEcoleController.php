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
        $ecole = AutoEcole::all();
        return response()->json($ecole,200);
        
    }
   public function  getAutoEcoleById($id)
   {
       $autoEcole = DB::table('auto_ecoles')->where('id', '=', $id)->get();
       if(is_null($autoEcole)){
        $autoEcole = DB::table('auto_ecoles')->where('id', '=', $id)->whereNotNull('deleted_at')->get();
        // $autoEcole = AutoEcole::where()::where('deleted_at', '!=', null)->get();
         }

         return response()->json($autoEcole,200);
   }
}
