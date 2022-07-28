<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoniteurJob;

class MoniteurJobController extends Controller
{
    public function getMoniteurJob(){

        $moniteursJobs = MoniteurJob::all();
        foreach($moniteursJobs as $key => $moniteursJob) {
            $img = $moniteursJob->image;
            $path = 'MoniteurJob/' . $img;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $moniteursJob->image = $base64;    
        }
        return response()->json($moniteursJobs, 200);
    }
    public function getMoniteurJobById($id){ 
        $moniteurJob = MoniteurJob::find($id);
        $img = $moniteurJob->image;
        $path = 'MoniteurJob/' . $img;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $moniteurJob->image = $base64;    
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