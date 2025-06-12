<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function login(LoginRequest $request)
    {
         $credentials=$request->only('email','password');

         $token=auth('api')->attempt($credentials);

         if(!$token) {
            return response(["message"=>"Unauthorized access!"],401);
         }
        
         return response()->json([
            "access_token"=>$token,
            "expired_in"=>auth('api')->factory()->getTTL()*60
         ]);
    }

    public function refresh()
    {
      $refreshedToken=Auth('api')->refresh();

      return response()->json([
         "access_token"=>$refreshedToken,
          "expired_in"=>auth('api')->factory()->getTTL()*60
      ],200);
    }

    public function me()
    {
      $user=Auth('api')->user();

      return response()->json($user);
    }

    public function logout()
    {
        Auth('api')->logout();
        return response()->json(["message"=>"logged Out Successfully!"],200);
    }

}
