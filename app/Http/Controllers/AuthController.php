<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\User;


class AuthController extends Controller
{
    public function _construct(){
        $this->middleware('auth:api', ['except'=>['register', 'login']]);
    }

    //Register
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
           
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }
      //Login
    public function Login(Request $request){
        $validator=Validator::make(
            $request->all(), [
                'email'=>'required|string|email',
                'password'=>'required|string|min:6'
            ]
            );
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 422);
             }
             if(!$token=auth()->attempt($validator->validated())){
                return response()->json(['error'=>'unauthorized'], 401);
             }
           return $this->createNewToken($token);
    }
        
    //Logout
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }
 
    //refresh
    public function refresh() {

        return $this->createNewToken(auth()->refresh());
    }

    //userprofile
    public function userProfile() {
        return response()->json(auth()->user());
    }
    
    public function createNewToken($token){
        $details=[
            'token'=>$token
           ];
           $user=auth()->user();
           Mail::to($user->email)->send(new TestMail($details));
                
           return response()->json([
               'access_token'=>$token,
               'token-type'=>'bearer',
               'expires_in'=>auth()->factory()->getTTL()*60,
               'user'=>auth()->user(),
               'message'=>'mail sent'

               ]);
              
                      
           

    }
   
//  public function payload()
//  {
//      return auth->payload();
//  }

  

}
