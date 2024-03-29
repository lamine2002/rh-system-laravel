<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamFormRequest;
use App\Models\Staff;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Team::class, 'team');
    }

    public function index()
    {
        $teams = Team::orderBy('created_at', 'desc')->paginate(10);
        return view('rh.team.index', compact('teams'));
    }

    public function create()
    {
        return view('rh.team.form',
            [
                'team' => new Team(),
                'staffs' => Staff::all(),
            ]
        );
    }

    public function store(TeamFormRequest $request)
    {
        $data = $request->validated();
        $team = Team::create([
            'name'=> $data['name'],
            'description'=> $data['description'],
            'leader_id'=> $data['leader_id'],
            'supervisor_id'=> $data['supervisor_id'],
        ]);
        return redirect()->route('rh.team.index')->with('success', 'Team created successfully');
    }

    public function show(Team $team)
    {
        return view('rh.team.show', compact('team'));
    }

    public function edit(Team $team)
    {
        return view('rh.team.form',
            [
                'team' => $team,
                'staffs' => Staff::all(),
            ]
        );
    }

    public function update(TeamFormRequest $request, Team $team)
    {
        $data = $request->validated();
        $team->update([
            'name'=> $data['name'],
            'description'=> $data['description'],
            'leader_id'=> $data['leader_id'],
            'supervisor_id'=> $data['supervisor_id'],
        ]);
        return redirect()->route('rh.team.index')->with('success', 'Team updated successfully');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('rh.team.index')->with('success', 'Team deleted successfully');
    }
}
