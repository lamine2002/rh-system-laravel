<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffFormRequest;
use App\Models\Staff;
use App\Models\Talent;
use App\Models\TalentType;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Staff::class, 'staff');
    }

    private function extractData (Staff $staff, StaffFormRequest $request) {
        $data = $request->validated();
        $image = $request->validated('image');
        if ($image === null || $image->getError()) {
            return $data;
        }
        if ($staff->image !== null) {
            Storage::disk('public')->delete($staff->image);
        }
        $data['image'] = $image->store('users', 'public');
        return $data;
    }
    public function index()
    {
        $staffs = Staff::orderBy('created_at', 'desc')->paginate(10);
        return view('rh.staff.index', compact('staffs'));
    }

    public function create()
    {
        // les talents de type 'Langues'
        $idLangues = TalentType::all()->where('name', 'Langues')->first()->id;
//        dd($idLangues);
        $talentsLangues = Talent::where('talent_type_id', $idLangues)->get();
        // les talents de type 'Compétences'
        $idCompetences = TalentType::where('name', 'Compétences')->first()->id;
        $talentsCompetences = Talent::where('talent_type_id', $idCompetences)->get();
        // les talents de type 'Soft Skills'
        $idSoftSkills = TalentType::where('name', 'Soft-skills')->first()->id;
        $talentsSoftSkills = Talent::where('talent_type_id', $idSoftSkills)->get();
        $chiefs = Staff::all();
        return view('rh.staff.form',
            [
                'staff' => new Staff(),
                'teams' => Team::all(),
                'talentsLangues' => $talentsLangues,
                'talentsCompetences' => $talentsCompetences,
                'talentsSoftSkills' => $talentsSoftSkills,
                'chiefs' => $chiefs
            ]
        );
    }

    public function store(StaffFormRequest $request)
    {
        $staff = Staff::create($this->extractData(new Staff(), $request));
        $staff->talents()->sync($request->validated('talents'));
        return redirect()->route('rh.staff.index')->with('success', 'Membre du personnel ajouté avec succès.');
    }

    public function show(Staff $staff)
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
        return view('rh.staff.show',
            [
                'staff' => $staff,
                'teams' => Team::all(),
                'talentsLangues' => $talentsLangues,
                'talentsCompetences' => $talentsCompetences,
                'talentsSoftSkills' => $talentsSoftSkills
            ]
        );
    }

    public function edit(Staff $staff)
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
                'staff' => $staff,
                'teams' => Team::all(),
                'talentsLangues' => $talentsLangues,
                'talentsCompetences' => $talentsCompetences,
                'talentsSoftSkills' => $talentsSoftSkills
            ]
        );
    }

    public function update(StaffFormRequest $request, Staff $staff)
    {
        $staff->update($this->extractData($staff, $request));
        $staff->talents()->sync($request->validated('talents'));
        return redirect()->route('rh.staff.index')->with('success', 'Membre du personnel modifié avec succès.');
    }


}
