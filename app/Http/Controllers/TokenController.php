<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Token;
use App\Models\Incident;

class TokenController extends Controller
{
    //
    public function registerToken(Request $request) {
       $input = $request->all();

       $validator = Validator::make($input, [
        'account_id' => 'required',
        'token' => 'required',
       ]);
       
       if ($validator->fails())
       {
           return $this->sendError($validator->errors());
       }


        $user = Token::where('token', $input['token'])->first();
        
        if (is_null($user))
        {
            $user = Token::create($input);
        }else
        {
            $user->update($request->all());
        }
        
        $response = [
            'success' => true,
            'fcm' => $user

        ];
        return response($response, 201);
    }


   

}