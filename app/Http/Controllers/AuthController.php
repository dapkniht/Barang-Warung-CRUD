<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function login(Request $request){
        $validator = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if (Auth::attempt($validator)) {
            $user = User::where("email",$request->input("email"))->get();
            $token = $request->user()->createToken($user[0]->name)->plainTextToken;
            return response()->json([
                "status" => "sukses",
                "data" => $user[0],
                "token" => $token,
            ],200);
        }
        return response()->json([
            "status" => "gagal",
            "message" => "Proses login gagal",
        ],400);

   }

   public function logout(Request $request) {
    $request->validate([
            "email" => "required|email",
            "password" => "required"
    ]);
        Auth::logout();
        $user = User::where("email",$request->input("email"))->get();
        $user[0]->tokens()->delete();
        return response()->json([
            "status" => "sukses",
            "message" => "logout berhasil",
        ],200); 
    }
}
