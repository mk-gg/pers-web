<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class TestController extends Controller
{
    //
    public function testfunc(Request $request) {

        

        $response = [
            'success' => true,
            'fcm' => 'bitches',
            'result' => 'test',
        ];
        return response($response, 201);
    }


}
