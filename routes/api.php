<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/test-api', function ()
// {
//     $user = User::create([
//         'email' => 'test1@pers.com',
//         'password' => Hash::make('1234'),
//         'remember_token' => Str::random(10),
//     ]);
// });




// Route::get('/test', function(Request $request){
//     return 'Authenticated';
// });

Route::resource('account', AccountController::class);

Route::resource('users', UserController::class);