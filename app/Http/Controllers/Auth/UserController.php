<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function register(Request $request)
    {

        $validated= $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required'],
        ]);


        $user=new User();
        $user->name=$validated['name'];
        $user->email=$validated['email'];
        $user->password=Hash::make($validated['password']);
        $user->save();

        // $user = User::create([
        //     'name' => $validated['name'],
        //     'email' => $validated['email'],
        //     'password' => Hash::make($validated['password']),
        // ]);

        $token=$user->createToken('auth_token')->plainTextToken;



        return response()->json([
            "message"=>'user registration successfully',
            'access_token'=>$token,
            'token_type'=>'Bearer'
        ],201);




}
public function login(Request $request){

    $crendital=$request->validate([
        'email'=>'required|string|lowercase|email',
        'password'=>'required',
    ]);

    if(Auth::attempt($crendital)){
        $user=Auth::user();
        $token=$user->createToken('API Token')->plainTextToken;

        return response()->json([
            "message"=>'user login successfully',
            'access_token'=>$token,
            'token_type'=>'Bearer'
        ],201);

    }
    return response()->json([
        'message' => 'Invalid credentials'
    ], 401);
}
public function logout(Request $request){
  $request->user()->currentAccessToken()->delete();
      return response()->json(['message' => 'Logged out successfully'], 200);
}



}
