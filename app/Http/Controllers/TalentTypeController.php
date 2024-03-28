<?php

namespace App\Http\Controllers;

use App\Http\Requests\TalentTypeFormRequest;
use App\Models\TalentType;
use Illuminate\Http\Request;

class TalentTypeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TalentType::class, 'talent_type');
    }

    public function index()
    {
        $talentTypes = TalentType::all();
        return view('rh.talent-type.index', compact('talentTypes'));
    }

    public function create()
    {
        return view('rh.talent-type.form',
            ['talentType' => new TalentType()]
        );
    }

    public function store(TalentTypeFormRequest $request)
    {
        TalentType::create($request->validated());
        return redirect()->route('rh.talent-type.index');
    }

    public function show(TalentType $talentType)
    {
        return view('rh.talent-type.show', compact('talentType'));
    }

    public function edit(TalentType $talentType)
    {
        return view('rh.talent-type.form', compact('talentType'));
    }

    public function update(TalentTypeFormRequest $request, TalentType $talentType)
    {
        $talentType->update($request->validated());
        return redirect()->route('rh.talent-type.index');
    }

    public function destroy(TalentType $talentType)
    {
        $talentType->delete();
        return redirect()->route('rh.talent-type.index');
    }
}
