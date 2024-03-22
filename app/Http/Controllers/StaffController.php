<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffFormRequest;
use App\Models\Staff;
use App\Models\Talent;
use App\Models\TalentType;
use App\Models\Team;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::all();
        return view('rh.staff.index', compact('staffs'));
    }

    public function create()
    {
        // les talents de type 'Langues'
        $idLangues = TalentType::where('name', 'Langues')->first()->id;
        $talentsLangues = Talent::where('talent_type_id', $idLangues)->get();
        // les talents de type 'Compétences'
        $idCompetences = TalentType::where('name', 'Compétences')->first()->id;
        $talentsCompetences = Talent::where('talent_type_id', $idCompetences)->get();
        // les talents de type 'Soft Skills'
        $idSoftSkills = TalentType::where('name', 'Soft-skills')->first()->id;
        $talentsSoftSkills = Talent::where('talent_type_id', $idSoftSkills)->get();
        return view('rh.staff.form',
            [
                'staff' => new Staff(),
                'teams' => Team::all(),
                'talentsLangues' => $talentsLangues,
                'talentsCompetences' => $talentsCompetences,
                'talentsSoftSkills' => $talentsSoftSkills
            ]
        );
    }

    public function store(StaffFormRequest $request)
    {
        $staff = Staff::create($request->validated());
        $staff->talents()->sync($request->validated('talents'));
        return redirect()->route('rh.staff.index');
    }
}
