<?php

namespace App\Http\Controllers;

use App\Models\Planning;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        /*
         * Liste des planning completees de chaque jour de chaque semaine pour mon graphique
         * sous cette forme: [
                    { x: "Lun", y: 2 },
                    { x: "Mar", y: 0 },
                    { x: "Mer", y: 2 },
                    { x: "Jeu", y: 4 },
                    { x: "Ven", y: 7 },
                    { x: "Sam", y: 2 },
                    { x: "Dim", y: 9 },
                ],
         * cette forme signifie que j'ai 2 taches completees le lundi, 0 le mardi, 2 le mercredi, 4 le jeudi, 7 le vendredi, 2 le samedi et 9 le dimanche de la semaine actuelle
         * */
//        $planning = Planning::all();
        $completedTasks = Planning::where('status', 'Complétée')
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->date)->format('D'); // grouping by day of week
            });

        $daysOfWeek = ['Mon' => 'Lun', 'Tue' => 'Mar', 'Wed' => 'Mer', 'Thu' => 'Jeu', 'Fri' => 'Ven', 'Sat' => 'Sam', 'Sun' => 'Dim'];

        $planningCompleted = [];

        foreach ($daysOfWeek as $key => $value) {
            $planningCompleted[] = [
                'x' => $value,
                'y' => isset($completedTasks[$key]) ? $completedTasks[$key]->count() : 0,
            ];
        }
//        dd($planningCompleted);

        /*
         * Liste des planning incompletees de chaque jour de chaque semaine pour mon graphique
         * sous cette forme: [
                    { x: "Lun", y: 2 },
                    { x: "Mar", y: 0 },
                    { x: "Mer", y: 2 },
                    { x: "Jeu", y: 4 },
                    { x: "Ven", y: 7 },
                    { x: "Sam", y: 2 },
                    { x: "Dim", y: 9 },
                ],
         * cette forme signifie que j'ai 2 taches incompletees le lundi, 0 le mardi, 2 le mercredi, 4 le jeudi, 7 le vendredi, 2 le samedi et 9 le dimanche de la semaine actuelle
         * */
        $incompletedTasks = Planning::where('status', 'Incomplétée')
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->date)->format('D'); // grouping by day of week
            });

        $planningIncompleted = [];

        foreach ($daysOfWeek as $key => $value) {
            $planningIncompleted[] = [
                'x' => $value,
                'y' => isset($incompletedTasks[$key]) ? $incompletedTasks[$key]->count() : 0,
            ];
        }
//        dd($planningIncompleted);

        // nombre de team
        $teams = Team::all()->count();

        // nombre de planning de la semaine
        $plannings = Planning::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $planningsCount = $plannings->count();

        // taux de completion des plannings de la semaine
        $planningsCompleted = $plannings->where('status', 'Complétée')->count();
        $planningsIncompleted = $plannings->where('status', 'Incomplétée')->count();
        $planningsCompletedRate = $planningsCount > 0 ? ($planningsCompleted / $planningsCount) * 100 : 0;

        // les 4 staffs avec le plus de taches completees de ce mois
        $topStaffs = Planning::where('status', 'Complétée')
            ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->where('team_id', null)
            ->get()
            ->groupBy('staff_id')
            ->map(function ($plannings) {
                return [
                    'staff' => $plannings->first()->staff,
                    'count' => $plannings->count(),
                ];
            })
            ->sortByDesc('count')
            ->take(4);

//        dd($topStaffs);

        $topTeams = Planning::where('status', 'Complétée')
            ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            /* et quand le staff aussi est a null*/
            ->where('staff_id', null)
            ->get()
            ->groupBy('team_id')
            ->map(function ($plannings) {
                return [
                    'team' => $plannings->first()->team,
                    'count' => $plannings->count(),
                ];
            })
            ->sortByDesc('count')
            ->take(4);

        return view('rh.statistiques',
            [
                'planningCompleted' => $planningCompleted,
                'planningIncompleted' => $planningIncompleted,
                'teams' => $teams,
                'planningsCount' => $planningsCount,
                'planningsCompletedRate' => $planningsCompletedRate,
                'topStaffs' => $topStaffs,
                'topTeams' => $topTeams,
            ]
        );
    }
}
