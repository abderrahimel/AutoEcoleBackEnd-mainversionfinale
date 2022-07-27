<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\autoEcole_Vendre;

class AutoEcoleVendreController extends Controller
{
    public function getAutoEcoleVendres(){
        $autoEcole_Vendre = autoEcole_Vendre::all();
        return response()->json($autoEcole_Vendre, 200);
    }
    public function getAutoEcoleVendreById($id){
        $autoEcole_Vendre = autoEcole_Vendre::find($id);
        return response()->json($autoEcole_Vendre, 200);
    }
    public function addAutoEcoleVendre(Request $request){

        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('autoEcoleVendre/').$name_image);
        }
        $autoEcole_Vendre = autoEcole_Vendre::create([
            'titre' =>$request->titre,
            'description' =>$request->description,
            'prix' =>$request->prix,
            'date' =>$request->date,
            'image' => $name_image,
        ]);
        $autoEcole_Vendre->save();

        return response()->json($autoEcole_Vendre, 200);
    }
    public function updateAutoEcoleVendre($id, Request $request){

        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('autoEcoleVendre/').$name_image);
            $autoEcole_Vendre->image = $name_image;
        }
        $autoEcole_Vendre = autoEcole_Vendre::find($id);
        $autoEcole_Vendre->titre = $request->titre;
        $autoEcole_Vendre->description = $request->description;
        $autoEcole_Vendre->prix = $request->prix;
        $autoEcole_Vendre->date = $request->date;
      
        $autoEcole_Vendre->save();

        return response()->json($autoEcole_Vendre, 200);
    }

    public function  deleteAutoEcoleVendre($id){
        $autoEcole_Vendre = autoEcole_Vendre::find($id);
        $autoEcole_Vendre->delete();
        return response()->json(['message'=>'autoEcole Vendre deleted'], 200);
    }
}
