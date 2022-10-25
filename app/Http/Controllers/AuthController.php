<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Abonnement;
use App\Models\AutoEcole as ModelsAutoEcole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\Facades\Image;
use App\Mail\VerifyEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
//
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DateTime;
use DateInterval;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
    }


    public function register(Request $request)
    {     
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    
        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }
         // create user inside table users
        $user = User::create([
            'login' => strstr($request->email,'@',true),
            'email' => $request->email,
            'password' => Hash::make($request->password),
             'name' => $request->nom_responsable
        ]);
        //image
        $name_image = '';
        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('images/').$name_image);
        }
        //  image rc 
        $name_image_rc = '';
         if($request->image_rc != ''){
            $name_image_rc = time().'.' . explode('/', explode(':', substr($request->image_rc, 0, strpos($request->image_rc, ';')))[1])[1];
            \Image::make($request->image_rc)->save(public_path('image_rc/').$name_image_rc);
         }
        //   image agrement
        $name_image_agrement = '';
         if($request->image_agrement != ''){
            $name_image_agrement = time().'.' . explode('/', explode(':', substr($request->image_agrement, 0, strpos($request->image_agrement, ';')))[1])[1];
            \Image::make($request->image_agrement)->save(public_path('image_agrement/').$name_image_agrement);
         }
        //  image cin
        $name_image_cin = '';
         if($request->image_cin != ''){
            $name_image_cin = time().'.' . explode('/', explode(':', substr($request->image_cin, 0, strpos($request->image_cin, ';')))[1])[1];
            \Image::make($request->image_cin)->save(public_path('image_cin/').$name_image_cin);
         }
         
        
        
       
        // get the id of this user 
        $user= User::find($user->id);
   
        // create auto ecole
        $ecole = ModelsAutoEcole::create([
             'user_id' => $user->id,
            'nom_auto_ecole' => $request->nom_auto_ecole,
            'telephone' => $request->telephone,
            'pays' => $request->pays,
            'ville' => $request->ville,
            'fax' => $request->fax,
            'site_web' => $request->site_web,
            'adresse' => $request->adresse,
            'image' => $name_image,
            'image_rc' => $name_image_rc,
            'image_cin' => $name_image_cin,
            'image_agrement' =>  $name_image_agrement,
            'n_cnss' => $request->n_cnss,
            'ice' => $request->ice,
            'tva' => $request->tva,
            'n_register_de_commerce' => $request->n_register_de_commerce,
            'n_compte_bancaire' => $request->n_compte_bancaire,
            'n_agrement' => $request->n_agrement,
            'n_patente' => $request->n_patente,
            'date_autorisation' => $request->date_autorisation,
            'date_ouverture' => $request->date_ouverture,
            'identification_fiscale' => $request->identification_fiscale,
            'cin_responsable' => $request->cin_responsable,
            'nom_responsable' => $request->nom_responsable,
            'prenom_responsable' => $request->prenom_responsable,
            'tel_responsable' => $request->tel_responsable,
            'adresse_responsable' => $request->adresse_responsable,
        ]);
        $ecole->save();
        // creat abonnement
        $abonnement = Abonnement::create([
            'auto_ecole_id'=>$ecole->id,
            'user_id'=>$user->id,
         ]);
         $abonnement->save();
        // send email to new user with the url verification
        $url =  URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]
        );
        Mail::to($request->email)->send(new VerifyEmail($url));
        $token = $user->createToken('myapptoken')->plainTextToken;
         return new JsonResponse(
        [
            'success' => true, 
            'message' => 'Successful created user. Please check your email to verify your email.', 
            'token' => $token
        ], 
        201
    );
    }
    public function resendPin(Request $request)
   {
    $validator = Validator::make($request->all(), [
        'email' => ['required', 'string', 'email', 'max:255'],
    ]);

    if ($validator->fails()) {
        return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
    }

    $verify =  DB::table('password_resets')->where([
        ['email', $request->all()['email']]
    ]);

    if ($verify->exists()) {
        $verify->delete();
    }

    $token = random_int(100000, 999999);
    $password_reset = DB::table('password_resets')->insert([
        'email' => $request->all()['email'],
        'token' =>  $token,
        'created_at' => Carbon::now()
    ]);

    if ($password_reset) {
        Mail::to($request->all()['email'])->send(new VerifyEmail($token));

        return new JsonResponse(
            [
                'success' => true, 
                'message' => "A verification mail has been resent"
            ], 
            200
        );
    }
   }

    public function verifyEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => ['required'],
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->with(['message' => $validator->errors()]);
        }
        $select = DB::table('password_resets')
            ->where('email', Auth::user()->email)
            ->where('token', $request->token);
    
        if ($select->get()->isEmpty()) {
            return new JsonResponse(['success' => false, 'message' => "Invalid PIN"], 400);
        }
    
        $select = DB::table('password_resets')
            ->where('email', Auth::user()->email)
            ->where('token', $request->token)
            ->delete();
    
        $user = User::find(Auth::user()->id);
        $user->email_verified_at = date("Y-m-d H:i:s");  // laravel not accept this format Carbon::now()->getTimestamp();
        $user->save();
    
        return new JsonResponse(['success' => true, 'message' => "Email is verified"], 200);
    }
    
    public function setlogo($id, Request $request)
    {      
            $autoEcole = ModelsAutoEcole::find($id);
            if (is_null($autoEcole)) {
                return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
            }
            if($request->logo != ''){
                $name_image = time().'.' . explode('/', explode(':', substr($request->logo, 0, strpos($request->logo, ';')))[1])[1];
                \Image::make($request->logo)->save(public_path('images/').$name_image);
            }
            $autoEcole->image = $name_image;
            $autoEcole->save();
            return response()->json($autoEcole, 200);

    }
     public function  setpass($id, Request $request)
     {
           $user = User::find($id);
           if (is_null($user)) {
            return response()->json(['message'=>"User n'est pas trouvée"],404);
            }
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json($user, 200);
     }
     public function  setemail($id, Request $request)
     {  
        $user = User::find($id);
        if (is_null($user)) {
         return response()->json(['message'=>"User n'est pas trouvée"],404);
        }
        $user->login = strstr($request->email,'@',true);
        $user->email = $request->email;
        $user->save();
        return response()->json($user, 200);
     }

     public function getLogo($auto_id)
     {
        $autoEcole = ModelsAutoEcole::find($auto_id);
        if (is_null($autoEcole)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $nameLogo =  "images/" . $autoEcole->image;
        return response()->json($nameLogo, 200);
     }

     public function login(Request $request)
     {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
         
        try {
            if (!$token = JWTAuth::attempt($validator->validated())) {
                return response()->json(['message'=>'invalid login credentials'], 422);
            }
            $user = User::where('email', $request->email)->first();
            $abonnement = Abonnement::where('user_id', $user['id'])->first();
            if (!$abonnement->date_fin) {
                return response()->json(['response'=>false, 'message' => 'you need abonnement'], 500);
            }
            $paymentDate       = new DateTime('now');
           
            $contractDateEnd   = new DateTime($abonnement->date_fin);
            $verify = $this->dateIsInBetween($contractDateEnd, $paymentDate);
            if (!$verify) {
                return response()->json(['response'=>false, 'message' => 'abonnement expired'], 500);
            }
        } catch (JWTException $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }
        

         return  $this->respondWithToken($token);
     }

     function dateIsInBetween(\DateTime $to, \DateTime $subject)
      {
        return $subject->getTimestamp()  <= $to->getTimestamp()  ? true : false;
      }

     public function logout(Request $request)
    {  
        auth()->logout();

        return response()->json(['message' => 'User successfully logged out.']);
    }
     

    public function logged()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return $this->sendError([], "user not found", 403);
            } 
        } catch (JWTException $e) {
            return response()->json($e->getMessage(), 500);        
        }
        return response()->json([
            'user' => $user
        ]);
    }
    public function currentAutoEcole(){
        $logged = $this->logged();
        if($logged->original == 'The token could not be parsed from the request'){
            return response()->json($logged, 500);   
        }
        $id = data_get($logged, 'original.user.id');
        // $user = $logged->original;

        $autoEcole = ModelsAutoEcole::where('user_id', $id)->get();
        $idAuto = data_get($autoEcole, 'id');
        return response()->json($autoEcole[0]['id'], 200);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token, 
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 * 60 * 24 * 7 , // 1 week
        ]);
    }
    

}
