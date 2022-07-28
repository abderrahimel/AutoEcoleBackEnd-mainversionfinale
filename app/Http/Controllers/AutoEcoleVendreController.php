<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\autoEcole_Vendre;

class AutoEcoleVendreController extends Controller
{     
    public function getAutoecoleVendre(){
        $autoEcole_Vendres = autoEcole_Vendre::all();
        foreach($autoEcole_Vendres as $key => $autoEcole_Vendre) {
            $img = $autoEcole_Vendre->image;
            $path = 'autoEcoleVendre/' . $img;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $autoEcole_Vendre->image = $base64;    
        }
        return response()->json($autoEcole_Vendres, 200);
    }
    public function getAutoecoleVendreById($id){
        $autoEcole_Vendre = autoEcole_Vendre::find($id);
        $img = $autoEcole_Vendre->image;
        $path = 'autoEcoleVendre/' . $img;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $autoEcole_Vendre->image = $base64;   
        return response()->json($autoEcole_Vendre, 200);
    }
    public function addAutoecoleVendre(Request $request){

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
    public function updateAutoecoleVendre($id, Request $request){
        $autoEcole_Vendre = autoEcole_Vendre::find($id);
        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('autoEcoleVendre/').$name_image);
            $autoEcole_Vendre->image = $name_image;
        }
        
        $autoEcole_Vendre->titre = $request->titre;
        $autoEcole_Vendre->description = $request->description;
        $autoEcole_Vendre->prix = $request->prix;
        $autoEcole_Vendre->date = $request->date;
      
        $autoEcole_Vendre->save();

        return response()->json($autoEcole_Vendre, 200);
    }

    public function  deleteAutoecoleVendre($id){
        $autoEcole_Vendre = autoEcole_Vendre::find($id);
        $autoEcole_Vendre->delete();
        return response()->json(['message'=>'autoEcole Vendre deleted'], 200);
    }
}
