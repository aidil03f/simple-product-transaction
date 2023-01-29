<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required|min:3'
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ]);
        return response()->json(['status' => 200,'message' => "you're registered"]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('username',$request->username)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'username' => ['The credentials are incorrect'],
            ]);
        }
        $user->tokens()->delete();
        $token = $user->createToken('web-token')->plainTextToken;
        $data = (object)[
            'name' => $user->name,
            'username' => $user->username,
        ];
        return response()->json(['status' => 200,'user' => $data,'token' => $token]);
    }
    public function logout(Request $request)
    {
        request()->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
        return response()->json(['status' => 200,'message' => "you're logout"]);
    }
}
