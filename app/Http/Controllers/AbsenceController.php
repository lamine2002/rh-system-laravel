<?php

namespace App\Http\Controllers;

use App\Http\Requests\AbsenceFormRequest;
use App\Models\Absence;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Absence::class);
    }

    public function index()
    {
        $absences = Absence::all();
        return view('absences.index', compact('absences'));
    }

    public function create()
    {
        return view('absences.create');
    }

    public function store(AbsenceFormRequest $request)
    {
        Absence::create($request->validated());
        return redirect()->route('absences.index');
    }

//    public function show(Absence $absence)
//    {
//        return view('absences.show', compact('absence'));
//    }


    public function edit(Absence $absence)
    {
        return view('absences.edit', compact('absence'));
    }

    public function update(AbsenceFormRequest $request, Absence $absence)
    {
        $absence->update($request->validated());
        return redirect()->route('absences.index');
    }

    public function destroy(Absence $absence)
    {
        $absence->delete();
        return redirect()->route('absences.index');
    }


}
