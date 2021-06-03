<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Hash;

class AuthController extends Controller
{
    public function registro(Request $request){
        $data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'rol'=>'required|string',
            'password'=>'required|min:8'
        ]);
    
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'rol' => $data['rol'],
            'password' => Hash::make($data['password']),
        ]);
    
        Auth::attempt(request()->only('email', 'password'));       
        $token = Auth::user()->createToken('authToken')->plainTextToken;
    
        $response = [
            'status'=> true,
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['message'=>'credenciales incorrectas'], 401);
        }

        Auth::attempt(request()->only('email', 'password'));

        $token = $user->createToken('authToken')->plainTextToken;
        
        return response()->json([
            'status'=> true,
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(){
        
        if (Auth::user()) {
            Auth::user()->tokens()->delete();
        }

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user() {
        $user = Auth::user();
        if(!is_null($user)) { 
            return response()->json(["status" => "success", "data" => $user]);
        } else {
            return response()->json(["status" => "failed", "message" => "Whoops! no user found"]);
        }        
    }
}