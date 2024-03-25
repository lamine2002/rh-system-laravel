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
            $data['image'] = $staff->image;
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
        return view('rh.staff.form',
            [
                'staff' => new Staff(),
                'teams' => Team::all(),
                'talents' => Talent::all(),
                'talentTypes' => TalentType::all(),
                'chiefs' => Staff::all(),
                'roles' => ['admin', 'staff', 'manager']
            ]
        );
    }

    public function store(StaffFormRequest $request)
    {
        $data = $this->extractData(new Staff(), $request);
//        dd($data);
        $staff = Staff::create([
            'name'=> $data['name'],
            'email'=> $data['email'],
            'date_of_birth'=> $data['date_of_birth'],
            'phone'=> $data['phone'],
            'address'=> $data['address'],
            'job_title'=> $data['job_title'],
            'salary'=> $data['salary'],
            'team_id'=> $data['team_id'],
            'chef_id'=> $data['chef_id'],
            'status'=> $data['status'],
            'image'=> $data['image'],
        ]);
        $staff->talents()->sync($request->validated('talents'));
        return redirect()->route('rh.staff.index')->with('success', 'Membre du personnel ajouté avec succès.');
    }

    public function show(Staff $staff)
    {

        return view('rh.staff.show',
            [
                'staff' => $staff,
                'teams' => Team::all(),
                'talents' => Talent::all(),
                'talentTypes' => TalentType::all(),
                'chiefs' => Staff::all(),
                'roles' => ['admin', 'staff', 'manager']
        ]);
    }

    public function edit(Staff $staff)
    {
        return view('rh.staff.form',
            [
                'staff' => $staff,
                'teams' => Team::all(),
                'talents' => Talent::all(),
                'talentTypes' => TalentType::all(),
                'chiefs' => Staff::all(),
                'roles' => ['admin', 'staff', 'manager']
            ]
        );
    }

    public function update(StaffFormRequest $request, Staff $staff)
    {
        $data = $this->extractData($staff, $request);
//        dd($data);
        $staff->update(
            [
                'name'=> $data['name'],
                'email'=> $data['email'],
                'date_of_birth'=> $data['date_of_birth'],
                'phone'=> $data['phone'],
                'address'=> $data['address'],
                'job_title'=> $data['job_title'],
                'salary'=> $data['salary'],
                'team_id'=> $data['team_id'],
                'chef_id'=> $data['chef_id'],
                'status'=> $data['status'],
                'image'=> $data['image'],
            ]
        );
//        if ($data['image'] !== null) {
//            $staff->update(['image' => $data['image']]);
//        }

        $staff->talents()->sync($request->validated('talents'));
        return redirect()->route('rh.staff.index')->with('success', 'Membre du personnel modifié avec succès.');
    }


}
