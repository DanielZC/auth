<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'email:strict', 'unique:users,email'],
                'password' => [
                    'required',
                    'confirmed',
                    Password::min(8)->mixedCase()->numbers()->symbols()
                ]
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            User::create($validator->validate());
            return response()->json(['result' => true], 200);
        } catch (\Throwable $th) {
            return response()->json(["error" => $th->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email:strict', 'exists:users,email'],
                'password' => [
                    'required',
                    Password::min(8)->mixedCase()->numbers()->symbols()
                ]
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $userRequest = $validator->validate();
            $userDb = User::where('email', '=', $userRequest['email'], false)->get()[0];

            if (!Hash::check($userRequest['password'], $userDb->password)) {
                return response()->json(['errors' => 'user or password invalid'], 400);
            }

            $token = $userDb->createToken('authToken')->plainTextToken;
            return response()->json(['user' => $userDb, 'token' => $token]);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        try {

            $request->user()->currentAccessToken()->delete;
            return response()->json(['user' => null, 'token' => null], 200);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()], 500);
        }
    }
}
