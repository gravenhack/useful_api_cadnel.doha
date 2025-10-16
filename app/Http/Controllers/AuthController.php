<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Faker\Guesser\Name;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
    public function register(Request $request){

    $registerUserData = $request->validate([

        'name'=>'required|string',
        'email'=>'required|string|email|unique:users',
        'password'=>'required|min:8'
    ]);

    $user = User::create([
        'name' => $registerUserData['name'],
        'email' => $registerUserData['email'],
        'password' => Hash::make($registerUserData['password']),
    ]);

    return response()->json([
    'message' => 'Created',
    'data' => $user
     ], 201);
}

 public function login(Request $request){

        $loginUserData = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|min:8'
        ]);

        $user = User::where('email',$loginUserData['email'])->first();

        if(!$user || !Hash::check($loginUserData['password'],$user->password)){

            return response()->json([],
            
         401);

         
        }

        $token = $user->createToken($user->id.'-AuthToken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user_id'  => $user->id
        ], 200);
    

}

}
