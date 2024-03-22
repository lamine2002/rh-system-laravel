<?php

namespace App\Http\Controllers;

use App\Http\Requests\AbsenceFormRequest;
use App\Models\Absence;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Absence::class, 'absence');
    }

    public function index()
    {
        $absences = Absence::all()->sortByDesc('created_at');
        return view('rh.absences.index', compact('absences'));
    }

    public function create()
    {
        $staffs = \App\Models\Staff::all();
        return view('rh.absences.form',
            compact('staffs')
        );
    }

    public function store(AbsenceFormRequest $request)
    {
        Absence::create($request->validated());
        return redirect()->route('rh.absences.index')->with('success', 'Absence crée avec succès');
    }

//    public function show(Absence $absence)
//    {
//        return view('absences.show', compact('absence'));
//    }


    public function edit(Absence $absence)
    {
        return view('rh.absences.form', compact('absence'));
    }

    public function update(AbsenceFormRequest $request, Absence $absence)
    {
        $absence->update($request->validated());
        return redirect()->route('rh.absences.index')->with('success', 'Absence modifié avec succès');
    }

    public function destroy(Absence $absence)
    {
        $absence->delete();
        return redirect()->route('rh.absences.index')->with('success', 'Absence supprimé avec succès');
    }


}
