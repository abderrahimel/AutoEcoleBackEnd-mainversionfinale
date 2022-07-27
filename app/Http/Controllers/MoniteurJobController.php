<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoniteurJob;

class MoniteurJobController extends Controller
{
    public function getMoniteurJob(){

        $moniteursJob = MoniteurJob::all();
        return response()->json($moniteursJob, 200);
    }
    public function getMoniteurJobById($id){
        $moniteurJob = MoniteurJob::find($id);
        return response()->json($moniteurJob, 200);
    }
    public function addMoniteurJob( Request $request){

        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('MoniteurJob/').$name_image);
        }
       
            $moniteurJob = MoniteurJob::create([
                'nom'=> $request->titre,
                'description'=> $request->description,
                'salaire'=> $request->prix,
                'date'=> $request->date,
                'image'=>$name_image
            ]);
            $moniteurJob->save();
            return response()->json($moniteurJob, 200);
    }
    public function updateMoniteurJob($id, Request $request){

        $moniteurJob = MoniteurJob::find($id);

        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('MoniteurJob/').$name_image);
            $moniteurJob->image  = $name_image;
        }
    
            $moniteurJob->nom = $request->titre;
            $moniteurJob->description  = $request->description;
            $moniteurJob->salaire = $request->prix;
            $moniteurJob->date = $request->date;
            $moniteurJob->save();
            return response()->json($moniteurJob, 200);
            
    }

    public function deleteMoniteurJob($id){

        $moniteurJob = MoniteurJob::find($id);
        $moniteurJob->delete();
        return response()->json(['message'=>'Moniteur Job deleted'], 200);
    }
}