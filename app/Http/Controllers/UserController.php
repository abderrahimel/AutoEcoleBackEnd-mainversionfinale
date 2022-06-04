<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AutoEcole;
class UserController extends Controller
{
    public function getUser()
    {
        $user = User::all();
        foreach ($user as $us) {
            $us->autoEcoles;
        }
        return response()->json($user,200);
        
    }


    public function getUserById($id)
    {
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['message'=> "User n'est pas trouvée"],404);
        }
       
        return response()->json($user,200);
    }

    public function addUser(Request $request)
    {
        $user = User::create($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        $user->autoEcoles;
        return response($user,201);

    }


    public function UpdateUser(Request $request,$id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);     
        $user->nombre = $request -> nombre;     
        $user->nombre_autorise = $request -> nombre_autorise;     
        $user->date_debut = $request -> date_debut;     
        $user->date_fin = $request -> date_fin;     
        $user->save();
        $user->autoEcoles;
        return response($user,200);
    }


    public function deleteUser($id)
    {
        $user = User::find($id);
        $autoEcole = AutoEcole::where('user_id', $id);
        if (is_null($user)) {
            return response()->json(['message'=>"User n'est pas trouvée"],404);
        }
        $user->delete();
        $autoEcole->delete();
        return response()->json(['message'=>'user deleted from db '],204);
    }
}
