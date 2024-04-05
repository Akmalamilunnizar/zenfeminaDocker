<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;

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

Route::controller(AuthController::class)->middleware('guest')->group(function() {
    Route::get('/login', 'index')->name('login');
    Route::post('/store', 'store');
});

Route::middleware(['auth', 'role:admin'])->group(function (){
    //dashboard
    Route::get('/dashboard', function (){
        return view('pages.dashboard', [
            'title' => 'Dashboard'
        ]);
    })->name('dashboard');

    Route::resource('dashboard', DashboardController::class)
        ->only('index');

    //user
    Route::resource('users', UserController::class)
        ->except('show');

    //education
//    Route::resource('educations', EducationController::class)
//        ->except('show');
//    Route::controller(EducationController::class)->prefix('educations')->name('educations.')->group(function (){
//        Route::get('search', 'search')->name('search');
//        Route::get('education', 'education')->name('education');
//    });

    Route::prefix('educations')->name('educations.')->controller(EducationController::class)->group(function () {
//        Route::post('store', 'store')->name('store');
//        Route::match(['PUT', 'PATCH'], '{item}/update', 'update')->name('update');
//
//        Route::get('datatables', 'datatables')->name('datatables');
//        Route::get('{item}', 'show')->name('show');
//
        Route::delete('{education}', 'destroy')->name('destroy');

        Route::get('/', 'index')->name('index');
        Route::get('search', 'search')->name('search');
        Route::get('education', 'education')->name('education');
    });
});
