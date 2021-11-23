<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use App\Models\Account;
use App\Models\Incident;

class AuthController extends Controller
{
    //
    public function register(Request $request) {
        $fields = $request->validate([
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|string|unique:users,email',
            'sex' => 'required',
            'account_type' => ['required', Rule::in(['reporter'])],
            'birthday' => 'required|date|before:-13 years',
            'address' => 'required|string|max:30',
            'mobile_no' => 'required',
            'password' => 'required|string|confirmed'
        ]);

        $user = Account::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'email' => $fields['email'],
            'sex' => $fields['sex'],
            'account_type' => $fields['account_type'],
            'birthday' => $fields['birthday'],
            'address'=> $fields['address'],
            'mobile_no' => $fields['mobile_no'],
            'password' => Hash::make($fields['password']),

        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        
        // Check email
        $user = Account::where('email', $fields['email'])->first();

        // Check Password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'The password doesnt match'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


}
