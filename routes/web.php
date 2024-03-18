<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'index')->name('login');
    Route::post('/store', 'store');
});

Route::middleware(['auth', 'role:admin'])->group(function (){
    //dashboard
    Route::get('/dashboard', function (){
        return view('pages.dashboard', [
            'title' => 'Dashboard'
        ]);
    });

    //user
    Route::resource('users', UserController::class);
});
