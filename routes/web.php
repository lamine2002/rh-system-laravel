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
    // creer un staff
//    \App\Models\Staff::create([
//        'name' => 'Admin',
//        'email' => 'admin@gmail.com',
//        'phone' => '123456789',
//        'address' => '123 rue de la paix',
//        'job_title' => 'Administrateur',
//        'salary' => 600000,
//        'date_of_birth' => '1990-01-01',
//    ]);
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

    Route::resource('absences', \App\Http\Controllers\AbsenceController::class);
    Route::resource('leave', \App\Http\Controllers\LeaveController::class);
    Route::resource('contracts', \App\Http\Controllers\ContractController::class);
    Route::resource('documents', \App\Http\Controllers\DocumentController::class);
    Route::resource('mail-alerts', \App\Http\Controllers\MailAlertController::class);
    Route::resource('planning', \App\Http\Controllers\PlanningController::class);
    Route::resource('staff', \App\Http\Controllers\StaffController::class);
    Route::resource('talent', \App\Http\Controllers\TalentController::class);
    Route::resource('talent-type', \App\Http\Controllers\TalentTypeController::class);
    Route::resource('team', \App\Http\Controllers\TeamController::class);
});
