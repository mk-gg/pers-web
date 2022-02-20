<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use App\Models\Fcm;
use App\Models\Incident;

class FcmController extends Controller
{
    //
    public function registerToken(Request $request) {
        $fields = $request->validate([
            'unit_name' => 'required',
            'token' => 'required',

        ]);
    
        $user = Fcm::where('token', $fields['token'])->first();
        if (is_null($user)){
            $user = Fcm::update([
                'account_id' => $fields['account_id'],
                'token' => $fields['token'],
            ]);
        }else{
            $user->update($request->all());
        }
        
        $response = [
            'success' => true,
            'fcm' => $user

        ];
        return response($response, 201);
    }


   

}
