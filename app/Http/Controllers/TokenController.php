<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        

        if (Token::where('token', $input['token'] )->exists()) {
            $user->account_id = $input['account_id'];
            $user->save();
        }else{
            $user = Token::create($input);
        }

        // if (is_null($user))
        // {
        //     $user = Token::create($input);
        // }else
        // {
        //     if (Token::where('token', $input['token'] )->exists()) {
        //         $user->account_id = $input['account_id'];
        //         $user->save();
        //     }

        //     // $users = User::where('email', '=', $request->input('email'))->first();
        //     // Token::find($input['token'])->update(['account_id' => $input['token']]);
        //     // // $user->account_id = $input['account_id'];
        //     // $user->token = $input['token'];

          
        // }
        
        $response = [
            'success' => true,
            'fcm' => $user,
            'result' => is_null($user),
            'input' => $input
        ];
        return response($response, 201);
    }


   

}
