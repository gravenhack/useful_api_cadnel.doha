<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Faker\Guesser\Name;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
    public function register (Request $request){

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string','min:8'],
        ]);


        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json($user);

    }    

}


