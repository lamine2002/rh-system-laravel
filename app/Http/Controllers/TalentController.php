<?php

namespace App\Http\Controllers;

use App\Http\Requests\TalentFormRequest;
use App\Models\Talent;
use App\Models\TalentType;
use Illuminate\Http\Request;

class TalentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Talent::class, 'talent');
    }

    public function index()
    {
        $talents = Talent::orderBy('created_at', 'desc')->paginate(10);
        return view('rh.talent.index', compact('talents'));
    }

    public function create()
    {
        return view('rh.talent.form',
            [
                'talent' => new Talent(),
                'talentTypes' => TalentType::all()
            ]
        );
    }

    public function store(TalentFormRequest $request)
    {
        $data = $request->validated();
        Talent::create($data);
        return redirect()->route('rh.talent.index');
    }

    public function edit(Talent $talent)
    {
        return view('rh.talent.form',
            [
                'talent' => $talent,
                'talentTypes' => TalentType::all()
            ]
        );
    }

    public function update(TalentFormRequest $request, Talent $talent)
    {
        $data = $request->validated();
        $talent->update($data);
        return redirect()->route('rh.talent.index');
    }

    public function destroy(Talent $talent)
    {
        $talent->delete();
        return redirect()->route('rh.talent.index');
    }
}
