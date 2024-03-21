<?php

use Illuminate\Support\Facades\Route;

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
    // creer un utilisateur avec un role admin
//    \App\Models\User::create([
//        'name' => 'admin',
//        'email' => 'admin@gmail.com',
//        'password' => \Illuminate\Support\Facades\Hash::make('passer'),
//        'role' => 'admin'
//        ]);
    return view('welcome');

});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'doLogin']);
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware('auth')->name('dashboard');

Route::prefix('rh')->name('rh.')->middleware('auth')->group(function (){
    Route::get('/home', function () {
        return view('rh.home');
    })->name('home');
});
