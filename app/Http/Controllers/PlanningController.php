<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanningFormRequest;
use App\Models\Planning;
use App\Models\Staff;
use App\Models\Team;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Planning::class, 'planning');
    }

    public function index()
    {
        $plannings = Planning::orderBy('date', 'desc')->paginate(10);
        return view('rh.planning.index', compact('plannings'));
    }

    public function create()
    {
        return view('rh.planning.form',
            [
                'planning' => new Planning(),
                'staffs' => Staff::all(),
                'teams' => Team::all(),
                'types' => ['Réunion', 'Tâche', 'Formation'],
                'priorities' => ['Normal', 'Urgent', 'Très urgent'],
                'statuses' => ['En attente', 'Incompletée', 'Complétée']
            ]
        );
    }

    public function store(PlanningFormRequest $request)
    {
        $data = $request->validated();
        Planning::create($data);
//        route('rh.planning.index')
        return redirect()->back()->with('success', 'Le planning a bien été créé');
    }

    public function edit(Planning $planning)
    {
        return view('rh.planning.form',
            [
                'planning' => $planning,
                'staffs' => Staff::all(),
                'teams' => Team::all(),
                'types' => ['Réunion', 'Tâche', 'Formation'],
                'priorities' => ['Normal', 'Urgent', 'Très urgent'],
                'statuses' => ['En attente', 'Incompletée', 'Complétée']
            ]
        );
    }

    public function show(Planning $planning)
    {
        return view('rh.planning.show', compact('planning'));
    }

    public function update(PlanningFormRequest $request, Planning $planning)
    {
        $data = $request->validated();
        $planning->update($data);
        return redirect()->route('rh.planning.index')->with('success', 'Le planning a bien été modifié');
    }

    public function destroy(Planning $planning)
    {
        $planning->delete();
        return back()->with('success', 'Le planning a bien été supprimé');
    }

    public function complete(Planning $planning)
    {
        $planning->update(['status' => 'Complétée']);
        return back()->with('success', 'Le planning a bien été complété');
    }

    public function incomplete(Planning $planning)
    {
        $planning->update(['status' => 'Incompletée']);
        return back()->with('success', 'Le planning a bien été marqué comme incomplet');
    }
}
