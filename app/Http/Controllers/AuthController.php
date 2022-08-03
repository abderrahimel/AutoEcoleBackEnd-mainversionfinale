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
use Validator;
use Intervention\Image\Facades\Image;

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
       //var_dump($request->all());
         $data = request()->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
         ]);
         // create user inside table users
        $user = User::create([
            'login' => strstr($request->email,'@',true),
            'email' => $request->email,
            'password' => Hash::make($request->password),
             'name' => $request->nom_responsable
        ]);
        //image
        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('images/').$name_image);
        }
        //  image rc 
         if($request->image_rc != ''){
            $name_image_rc = time().'.' . explode('/', explode(':', substr($request->image_rc, 0, strpos($request->image_rc, ';')))[1])[1];
            \Image::make($request->image_rc)->save(public_path('image_rc/').$name_image_rc);
         }
        //   image agrement
         if($request->image_agrement != ''){
            $name_image_agrement = time().'.' . explode('/', explode(':', substr($request->image_agrement, 0, strpos($request->image_agrement, ';')))[1])[1];
            \Image::make($request->image_agrement)->save(public_path('image_agrement/').$name_image_agrement);
         }
        //  image cin
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
         ]);
         $abonnement->save();
          
        return response()->json(['message' => 'user added', 'user' => $request->all()], 200);
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
        if(!$token = Auth::attempt($request->only('email', 'password'))) {
            return response([
                'error' => 'This information does not match our records.'
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        $user = User::where('email', $request['email'])->firstOrFail();
        // $token = $user->createToken('token')->plainTextToken;
        return $this->respondWithToken($token);
    }

    public function logged()
    {
       return Auth::user();
    }

    public function logout(Request $request)
    {   $user = User::find($request->id);
        $user->tokens()->delete();
        return response()->json([
            'message' => 'Success'
        ]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    

}
