<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Document;
use App\Models\Leave;
use App\Models\Planning;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function absences()
    {
        $absences = Absence::where('staff_id', auth()->user()->staff_id)->orderBy('created_at', 'desc')->paginate(10);
        return view('rh.personal.absences', compact('absences'));
    }

    public function leave()
    {
        $leaves = Leave::where('staff_id', auth()->user()->staff_id)->orderBy('created_at', 'desc')->paginate(10);
        return view('rh.personal.leave', compact('leaves'));
    }

    public function documents()
    {
        $documents = Document::where('staff_id', auth()->user()->staff_id)->orderBy('created_at', 'desc')->paginate(10);
        $documentTypeToCssClass = [
            'Pièce d\'identité' => 'bg-red-500',
            'Curriculum vitae' => 'bg-blue-500',
            'Diplôme' => 'bg-green-500',
            'Contrat de travail' => 'bg-yellow-500',
            'Facture' => 'bg-indigo-500',
            'Bon de commande' => 'bg-purple-500',
            'Devis' => 'bg-pink-500',
            'Contrat commercial' => 'bg-orange-500',
            'Relevé bancaire' => 'bg-teal-500',
            'Rapport d\'activité' => 'bg-cyan-500',
            'Compte-rendu de réunion' => 'bg-gray-500',
            'Procès-verbal d\'assemblée générale' => 'bg-red-600',
            'Statuts de l\'entreprise' => 'bg-blue-600',
            'Document de présentation' => 'bg-green-600',
            'Document technique' => 'bg-yellow-600',
            'Correspondance' => 'bg-indigo-600',
        ];
        return view('rh.personal.documents',
            [
                'documents' => $documents,
                'documentTypeToCssClass' => $documentTypeToCssClass
            ]
        );
    }

    public function teamPlanning()
    {
        $team = auth()->user()->staff()->first()->team()->first();
//        dd($team);
        // verifier si l'utilisateur a une equipe
        if (!$team) {
            return view('rh.personal.team-planning');
        }
        $plannings = $team->planning()->orderBy('date', 'desc')->get();
//        dd($plannings);
/*        je veux recuperer les plannings de l'equipe de l'utilisateur connecté
        sous cette forme:
        [
        {
            title: 'All Day Event',
                    start: '2023-01-01'
                },
        {
            title: 'Long Event',
                    start: '2023-01-07',
                    end: '2023-01-10'
                },
        ]*/
        $plannings = $plannings->map(function ($planning) {
            return [
                'title' => $planning->task.' - '.$planning->type.' - '.$planning->status,
                'start' => $planning->date/*.'T'.$planning->start_time*/,
                'end' => $planning->end_date/*.'T'.$planning->end_time*/,
                // priorité de la tache
                'backgroundColor' => match ($planning->priority) {
                    'Normal' => '#057A55',
                    'Urgent' => '#ffc107',
                    'Très urgent' => '#dc3545',
                    default => '#28a745',
                },
                // url du show de la tache
                'url' => route('rh.planning.show', $planning->id)
            ];
        });
//        dd($plannings);




        return view('rh.personal.team-planning',
            [
                'plannings' => $plannings,
                'team' => $team,
                'planning' => new Planning(),
                'types' => ['Réunion', 'Tâche', 'Formation'],
                'priorities' => ['Normal', 'Urgent', 'Très urgent'],
                'statuses' => ['En attente', 'Incompletée', 'Complétée']
            ]
        );
    }

    public function planning()
    {
//        $plannings = Planning::where('staff_id', auth()->user()->staff_id)->orderBy('date', 'desc')->paginate(10);
        /*
         * trier selon la date de la tache d'abord ceux d'aujourd'hui puis ceux de demain et enfin ceux de la semaine
         * Apres trier sur le statut et plus precisement sur le statut 'En attente' en premier
         * Ensuite sur la priorité de la tache et plus precisement sur la priorité 'Très urgent', 'Urgent' et 'Normal'
         * enfin paginer par 10
         * */
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        $endOfWeek = Carbon::today()->endOfWeek(); // permet de recuperer la date de fin de la semaine actuelle

        $plannings = auth()->user()->staff->planning()
           /* ->whereDate('date', '>=', $today)
            ->whereDate('date', '<=', $endOfWeek)*/
            ->orderByRaw("CASE
        WHEN date = '$today' THEN 1
        WHEN date = '$tomorrow' THEN 2
        ELSE 3 END")
            ->orderByRaw("CASE
        WHEN status = 'En attente' THEN 1
        WHEN status = 'Incompletée' THEN 2
        ELSE 3 END")
            ->orderByRaw("CASE
        WHEN priority = 'Très urgent' THEN 1
        WHEN priority = 'Urgent' THEN 2
        ELSE 3 END")->paginate(5);
        return view('rh.personal.planning', compact('plannings'));
    }

    public function team()
    {
        $team = auth()->user()->staff->team()->first();
//        dd($team);
        // les plannings completes de l'equipe
        $completedTeamPlannings = $team->planning()->where('status', 'Complétée')->get();
//        dd($completedTeamPlannings);
        // les plannings incompletes de l'equipe
        $incompletedTeamPlannings = $team->planning()->where('status', 'Incomplétée')->get();
//        dd($incompletedTeamPlannings);
        // les membres de l'equipe sans le leader et le superviseur
        $members = $team->staff()->where('id', '!=', $team->leader_id)->where('id', '!=', $team->supervisor_id)->get();
//        dd($members);
        return view('rh.personal.my-team',
            [
                'team' => $team,
                'completedTeamPlannings' => $completedTeamPlannings,
                'incompletedTeamPlannings' => $incompletedTeamPlannings,
                'members' => $members,
                'types' => ['Réunion', 'Tâche', 'Formation'],
                'priorities' => ['Normal', 'Urgent', 'Très urgent'],
                'statuses' => ['En attente', 'Incompletée', 'Complétée'],
                'planning' => new Planning(),
                'staffs' => $members
            ]
        );
    }
}
