<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoniteurJob;
use Illuminate\Support\Facades\Validator;


class MoniteurJobController extends Controller
{
    public function getMoniteurJob(){

        $moniteursJobs = MoniteurJob::all();
        foreach($moniteursJobs as $key => $moniteursJob) {
            if($moniteursJob->image){
                $img = $moniteursJob->image;
                $moniteursJob->image = 'http://' . request()->getHttpHost() . '/' . 'MoniteurJob/' .  $moniteursJob->image; 
            }
        }
        return response()->json($moniteursJobs, 200);
    }
    public function getMoniteurJobById($id){ 
        $moniteurJob = MoniteurJob::find($id);
        if($moniteurJob->image){
            $img = $moniteurJob->image;
            $moniteurJob->image = 'http://' . request()->getHttpHost() . '/' . 'MoniteurJob/' .  $moniteurJob->image; 
        }
        return response()->json($moniteurJob, 200);
    }
    public function addMoniteurJob( Request $request){ 
        $name_image = '';
        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('MoniteurJob/').$name_image);
        }
       
            $moniteurJob = MoniteurJob::create([
                'nom'=> $request->nom,
                'description'=> $request->description,
                'salaire'=> $request->salaire,
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
    
            $moniteurJob->nom = $request->nom;
            $moniteurJob->description  = $request->description;
            $moniteurJob->salaire = $request->salaire;
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