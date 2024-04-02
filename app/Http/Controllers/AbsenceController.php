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
        $absences = Absence::orderBy('created_at', 'desc')->paginate(10);
        return view('rh.absences.index',
            [
                'absences' => $absences
            ]
        );
    }

    public function create()
    {
        $staffs = \App\Models\Staff::all();
        return view('rh.absences.form',
            [
                'absence' => new Absence(),
                'staffs' => $staffs,
//                'statuses' => ['pending', 'approved', 'rejected']
            ]
        );
    }

    public function store(AbsenceFormRequest $request)
    {
//        dd($request->validated());
        Absence::create($request->validated());
        if (auth()->user()->role === 'admin'|| auth()->user()->role === 'manager'){
            return redirect()->route('rh.absences.index')->with('success', 'Absence crée avec succès');
        }
        return redirect()->route('rh.my-absences')->with('success', 'Absence crée avec succès');
    }

//    public function show(Absence $absence)
//    {
//        return view('absences.show', compact('absence'));
//    }


    public function edit(Absence $absence)
    {
        return view('rh.absences.form',
            [
                'absence' => $absence,
                'staffs' => \App\Models\Staff::all(),
            //                'statuses' => ['pending', 'approved', 'rejected']
            ]
        );
    }

    public function update(AbsenceFormRequest $request, Absence $absence)
    {
        $absence->update($request->validated());
        return redirect()->route('rh.absences.index')->with('success', 'Absence modifié avec succès');
    }

    public function destroy(Absence $absence)
    {
        $absence->delete();
        // retourner vers la page précédente
        return redirect()->route('rh.absences.index')->with('success', 'Absence supprimé avec succès');
    }

    public function approve(Absence $absence)
    {
        $absence->update(['status' => 'Approuvée']);
        return redirect()->route('rh.absences.index')->with('success', 'Absence approuvé avec succès');
    }

    public function reject(Absence $absence)
    {
        $absence->update(['status' => 'Rejetée']);
        return redirect()->route('rh.absences.index')->with('success', 'Absence rejetée avec succès');
    }

}
