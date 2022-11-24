<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ResetEmailController extends Controller
{
    public function resetemail(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'newEmail' => ['required', 'string', 'email', 'max:255'],
        ]);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
    
        $user = User::where('email',$request->email);
         if(!$user->exists()){
            return response()->json(['success' => false, 'message' => 'the email doesn\'t exist'], 422);
         }
        $user->update([
            'email'=>$request->newEmail
        ]);
    
        
        return response()->json(
            [
                'success' => true, 
                'message' => "Your email has been reset", 
            ], 
            200
        );
    }
}
