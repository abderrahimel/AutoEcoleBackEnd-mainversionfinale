<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationResetPassword;
class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request)
{        
    $validator = Validator::make($request->all(), [
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    if ($validator->fails()) {
        return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
    }

    $user = User::where('email',$request->email);
     if(!$user->exists()){
        return new JsonResponse(['success' => false, 'message' => 'the email doesn\'t exist'], 422);
     }
    $user->update([
        'password'=>Hash::make($request->password)
    ]);

    $token = $user->first()->createToken('myapptoken')->plainTextToken;
    
    Mail::to($request->all()['email'])->send(new NotificationResetPassword());
    return new JsonResponse(
        [
            'success' => true, 
            'message' => "Your password has been reset", 
            'token'=>$token
        ], 
        200
    );
}
public function resetPasswordd(Request $request)
{        
    $validator = Validator::make($request->all(), [
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    if ($validator->fails()) {
        return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
    }

    $user = User::where('email',$request->email);
     if(!$user->exists()){
        return new JsonResponse(['success' => false, 'message' => 'the email doesn\'t exist'], 422);
     }
    $user->update([
        'password'=>Hash::make($request->password)
    ]);

    $token = $user->first()->createToken('myapptoken')->plainTextToken;
    
    Mail::to($request->all()['email'])->send(new NotificationResetPassword());
    return new JsonResponse(
        [
            'success' => true, 
            'message' => "Your password has been reset", 
            'token'=>$token
        ], 
        200
    );
}
}
