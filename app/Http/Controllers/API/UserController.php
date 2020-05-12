<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $token =  $user->createToken('LazyOwl')-> accessToken; 
            $user['wallet_amount'] = $user->wallet->amount;
            unset($user['wallet']); 
            
            return response()->json([
                'status' => 200,
                'message' => 'User logged in successfully!',
                'token' => $token,
                'user'=> $user
            ], 200); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised', 'status' => 400], 400); 
        } 
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'role' => 'required|integer'
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);
        $user->save();
        $user['wallet_amount'] = 0;
        unset($user['wallet']); 
        $token =  $user->createToken('LazyOwl')-> accessToken; 
        
        return response()->json([
            'status' => 200,
            'message' => 'User logged in successfully!',
            'token' => $token,
            'user' => $user
        ], 200); 
    }

    public function logout(Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        
        return response()->json([
            'message' => 'Successfully logged out',
            'status'  => 200
        ]);
    }
}
