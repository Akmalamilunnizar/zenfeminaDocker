<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\ApiAuthMiddleware;
use App\Http\Controllers\Api\DebtController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->prefix('/user')->group(function (){
    Route::post('/register', 'register');
    Route::post('/login', 'login');

    Route::middleware(ApiAuthMiddleware::class)->group(function (){
        Route::get('/current', 'getUser');
        Route::post('/update', 'update');
        Route::get('/logOut', 'logOut');
    });
});

Route::middleware(ApiAuthMiddleware::class)->group(function (){
    //debt
    Route::prefix('/debt')->controller(DebtController::class)->group(function (){
        Route::get('/get', 'get');
        Route::post('/add', 'add');
        Route::post('/update', 'update');
    });
});

