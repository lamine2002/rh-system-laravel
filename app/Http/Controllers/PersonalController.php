<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Document;
use App\Models\Leave;
use App\Models\Planning;
use App\Models\Staff;
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
}
