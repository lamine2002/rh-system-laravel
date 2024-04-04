<?php

use Carbon\Carbon;
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
////     creer un utilisateur avec un role admin
//    \App\Models\User::create([
//        'name' => 'admin',
//        'email' => 'admin@gmail.com',
//        'password' => \Illuminate\Support\Facades\Hash::make('passer'),
//        'role' => 'admin',
//        'staff_id' => 1
//        ]);
    //// creer un staff
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
        // Get the Staff record for the authenticated user
        $staff = auth()->user()->staff;

        // Check if the Staff record exists
        if (!$staff) {
            // Handle the case where the Staff record doesn't exist
            // For example, you could return an error message
            return redirect()->back()->with('error', 'No staff record found for the authenticated user.');
        }

        // Get the Team record for the Staff
        $team = $staff->team()->first();

        // Check if the Team record exists
        if (!$team) {
            // Handle the case where the Team record doesn't exist
            // For example, you could return an error message
            return redirect()->route('rh.my-absences')->with('error', 'No team record found for the staff.');
        }

        // Now you can safely call the planning() method
        $completedTeamPlannings = $team->planning()->where('status', 'Complétée')->count();
        $approvedAbsences = $staff->absences()->where('status', 'Approuvée')->count();
        $completedPersonalPlannings = $staff->planning()->where('status', 'Complétée')->count();
        $incompletedPersonalPlannings = $staff->planning()->where('status', 'Incomplétée')->count();
        /*
         * Liste des taches personnelles completees de chaque jour de chaque semaine pour mon graphique
         * sous cette forme: [2, 0, 2, 4, 1, 7, 3],
         * cet forme signifie que j'ai 2 taches completees le lundi, 0 le mardi, 2 le mercredi, 4 le jeudi, 1 le vendredi, 7 le samedi et 3 le dimanche de la semaine actuelle
         * */
        $completedPersonalPlanningsByWeek = auth()->user()->staff()->first()->planning()->where('status', 'Complétée')->get()->groupBy(function ($planning) {
            return Carbon::parse($planning->date)->format('w');
        })->map->count();

// je veux que les jours de la semaine soient en ordre
        $completedPersonalPlanningsByWeek = collect([
            $completedPersonalPlanningsByWeek[1] ?? 0,
            $completedPersonalPlanningsByWeek[2] ?? 0,
            $completedPersonalPlanningsByWeek[3] ?? 0,
            $completedPersonalPlanningsByWeek[4] ?? 0,
            $completedPersonalPlanningsByWeek[5] ?? 0,
            $completedPersonalPlanningsByWeek[6] ?? 0,
            $completedPersonalPlanningsByWeek[0] ?? 0,
        ]);

        /*
         * Liste des taches personnelles incompletees de chaque jour de chaque semaine pour mon graphique
         * sous cette forme: [2, 0, 2, 4, 1, 7, 3],
         * cet forme signifie que j'ai 2 taches incompletees le lundi, 0 le mardi, 2 le mercredi, 4 le jeudi, 1 le vendredi, 7 le samedi et 3 le dimanche de la semaine actuelle
         * */
        $incompletedPersonalPlanningsByWeek = auth()->user()->staff()->first()->planning()->where('status', 'Incomplétée')->get()->groupBy(function ($planning) {
            return Carbon::parse($planning->date)->format('w');
        })->map->count();

// je veux que les jours de la semaine soient en ordre
        $incompletedPersonalPlanningsByWeek = collect([
            $incompletedPersonalPlanningsByWeek[1] ?? 0,
            $incompletedPersonalPlanningsByWeek[2] ?? 0,
            $incompletedPersonalPlanningsByWeek[3] ?? 0,
            $incompletedPersonalPlanningsByWeek[4] ?? 0,
            $incompletedPersonalPlanningsByWeek[5] ?? 0,
            $incompletedPersonalPlanningsByWeek[6] ?? 0,
            $incompletedPersonalPlanningsByWeek[0] ?? 0,
        ]);

        /*liste de tous les jours de la semaine actuelle ou je veux afficher mes taches et ou l'on se trouve
         * sous cette forme: ['01 Feb', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb', '07 Feb']
         * */
        $days = collect([
            Carbon::now()->startOfWeek()->translatedFormat('jS F '),
            Carbon::now()->startOfWeek()->addDay()->translatedFormat('jS F '),
            Carbon::now()->startOfWeek()->addDays(2)->translatedFormat('jS F '),
            Carbon::now()->startOfWeek()->addDays(3)->translatedFormat('jS F '),
            Carbon::now()->startOfWeek()->addDays(4)->translatedFormat('jS F '),
            Carbon::now()->startOfWeek()->addDays(5)->translatedFormat('jS F '),
            Carbon::now()->endOfWeek()->translatedFormat('jS F '),
        ]);


        return view('rh.home',
            [
                'completedTeamPlannings' => $completedTeamPlannings,
                'approvedAbsences' => $approvedAbsences,
                'completedPersonalPlannings' => $completedPersonalPlannings,
                'incompletedPersonalPlannings' => $incompletedPersonalPlannings,
                'completedPersonalPlanningsByWeek' => $completedPersonalPlanningsByWeek,
                'incompletedPersonalPlanningsByWeek' => $incompletedPersonalPlanningsByWeek,
                'days' => $days

            ]
        );
    })->name('home');

    Route::get('my-absences', [\App\Http\Controllers\PersonalController::class, 'absences'])
        ->name('my-absences');
    Route::get('my-leave', [\App\Http\Controllers\PersonalController::class, 'leave'])
        ->name('my-leave');

    Route::get('my-documents', [\App\Http\Controllers\PersonalController::class, 'documents'])
        ->name('my-documents');

    Route::get('team-planning', [\App\Http\Controllers\PersonalController::class, 'teamPlanning'])
        ->name('team-planning');

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

    Route::put('/absences/{absence}/approve', [\App\Http\Controllers\AbsenceController::class, 'approve'])
        ->name('absences.approve');
    Route::put('/absences/{absence}/reject', [\App\Http\Controllers\AbsenceController::class, 'reject'])
        ->name('absences.reject');

    Route::put('/leave/{leave}/approve', [\App\Http\Controllers\LeaveController::class, 'approve'])
        ->name('leave.approve');
    Route::put('/leave/{leave}/reject', [\App\Http\Controllers\LeaveController::class, 'reject'])
        ->name('leave.reject');

    Route::put('planning/{planning}/complete', [\App\Http\Controllers\PlanningController::class, 'complete'])
        ->name('complete-team-planning');
    Route::put('planning/{planning}/incomplete', [\App\Http\Controllers\PlanningController::class, 'incomplete'])
        ->name('incomplete-team-planning');
});



Route::get('/rh/documents/{document}/download', [\App\Http\Controllers\DocumentController::class, 'download'])
    ->name('rh.documents.download')
    ->middleware('auth');

Route::get('/rh/documents/{document}/preview', [\App\Http\Controllers\DocumentController::class, 'preview'])
    ->name('rh.documents.preview')
    ->middleware('auth');
