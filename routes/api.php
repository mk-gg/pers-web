<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\IncidentController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\AuthController;

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


//Public Routes
//Route::resource('accounts', AccountController::class);

//Route::resource('incidents', IncidentController::class);
// Route::get('/accounts', [AccountController::class, 'index']);
Route::resource('users', UserController::class);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::resource('incidents', IncidentController::class);
//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    
    Route::resource('accounts', AccountController::class);
   
    Route::resource('locations', LocationController::class);
        
    
    //Route::resource('incidents', IncidentController::class);
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