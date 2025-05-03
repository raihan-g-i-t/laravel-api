<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request): JsonResponse{

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                "message" => "Login failed",
                "success" => false
            ]);
        }else{
            $token = $user->createToken('app')->plainTextToken;
            return response()->json([
                "message" => "Login Success",
                "token" => $token,
                "success" => true
            ]);
        }
    }

    public function Signup(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('app')->plainTextToken;

        return response()->json([
            'message' => "Reg Success",
            'token' => $token,
            'data' => $user,
        ]);
    }
}
