<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;   //user Model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        try {
            $credentials = $request->validate([
                "name" => "required|string",
                "email" => "required|string|email",
                "password" => "string|confirmed",
                // "remember" => "boolean"
            ]);
    
            // create a user
            $user = User::create([
            "name" => $credentials["name"],
            "email" => $credentials["email"],
            "password" => bcrypt("password")
            ]);
    
            // create token
            $token = $user->createToken("myapptoken")->plainTextToken;
    
            $response = ([
                "user" => $user,
                "token" => $token,
                "message" => "User created"
            ]);
        

            return response($response, 201);

            
        } catch (\Throwable $th) {
            return $response = ([

                "message" => "Something went wrong",
                "error" => $th->getMessage(),
            ]);
    
            return response($response, 500);
        }
    }

    // Logging in
    public function login(Request $request){
        
        try {
            $credentials = $request->validate([
                "email" => "required|string|email|exists:users,email",
                "password" => "required|string",
                 "remember" => "boolean"
            ]);
    
            // After validating, check if they match
            $remember = $credentials['remember'] ?? false;
            unset($credentials['remember']);
    
            if(!Auth::attempt($credentials, $remember)){
                return response([
                    "error" => "Password is incorrect"
                ], status: 401);
            }

    
            // check email
            $user = User::where("email", $credentials["email"]) -> first();
    
            // check password
            if(!$user || !Hash ::check($credentials["password"], $user->password)){
                return response([
                    "message" => "invalid credentials"
                ], 401);
            }


            // get user
            $user = Auth::user();
    
            // create token
            $token = $user->createToken("myapptoken")->plainTextToken;
    
            $response = [
                "status" => 201,
                "token" => $token
            ];
    
            return response()->json($response, 201);

        } catch (\exception $e) {

            $response = [
                // "status" => 500,
                "message" => "Something went wrong",
                "error" => $e->getMessage()
            ];

            return response()->json($response, 500);
        }
        
    }

    // logging out
    public function logout(Request $request){

        // $user = Auth::user();
        try{

            Auth()->user()->tokens()->delete();

            $response = [

                "message" => "Logged out successfully",
            ];
            
            return response()->json($response, 200);
            
        }

        catch(\Exception $e){

            $response = [

                "message" => $e->getMessage(),
            ];

            return response()->json($response, 500);
        }
    }
}
