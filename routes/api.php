<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\ApiAuthMiddleware;
use App\Http\Controllers\Api\DebtController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\ReminderController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\CycleController;

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

    //education
    Route::controller(EducationController::class)->prefix('/education')->group(function (){
        Route::get('/trending', 'trending');
        Route::get('/category', 'allCategory');
        Route::get('/all', 'getAll');
        Route::post('/byCategory', 'getByCategory');
        Route::post('byId', 'getById');
        Route::post('onClick', 'onClick');
    });

    //reminder
    Route::controller(ReminderController::class)->prefix('/reminder')->group(function (){
       Route::get('/all', 'getAll');
       Route::post('/byId', 'getById');
       Route::post('/update', 'update');
    });

    //home
    Route::controller(DashboardController::class)->prefix('/home')->group(function (){
        Route::post('/question', 'question');
        Route::get('/getCycle', 'getCycle');
        Route::get('/getDebt', 'getDebt');
    });

    //Cycle
    Route::controller(CycleController::class)->prefix('/cycle')->group(function (){
        Route::get('all', 'getAll');
        Route::post('beginCycle', 'beginCycle');
        Route::post('continueCycle', 'continueCycle');
        Route::post('endCycle', 'endCycle');
    });
});

