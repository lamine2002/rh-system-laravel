<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveFormRequest;
use App\Models\Contract;
use App\Models\Leave;
use App\Models\Staff;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Leave::class, 'leave');
    }

    public function index()
    {
        $leaves = Leave::orderBy('created_at', 'desc')->paginate(10);
        return view('rh.leave.index', compact('leaves'));
    }

    public function create()
    {
        return view('rh.leave.form',
            [
                'leave' => new Leave(),
                'status' => ['En attente', 'Accepté', 'Refusé'],
                'types' => ['Congé payé', 'Congé sans solde', 'Congé maladie', 'Congé maternité', 'Congé paternité'], // Add this line
                'staffs' => Staff::all(),
            ]
        );
    }

    public function store(LeaveFormRequest $request)
    {
        $data = $request->validated();
        $leave = Leave::create($data);
        return redirect()->route('rh.leave.index')->with('success', 'Demande de congé créée avec succès');
    }

    public function show(Leave $leave)
    {
        return view('rh.leave.show', compact('leave'));
    }

    public function edit(Leave $leave)
    {
        return view('rh.leave.form',
            [
                'leave' => $leave,
                'status' => ['En attente', 'Accepté', 'Refusé'],
                'types' => ['Congé payé', 'Congé sans solde', 'Congé maladie', 'Congé maternité', 'Congé paternité'], // Add this line
                'staffs' => Staff::all(),
            ]
        );
    }

    public function update(LeaveFormRequest $request, Leave $leave)
    {
        $data = $request->validated();
        $leave->update($data);
        return redirect()->route('rh.leave.index')->with('success', 'Demande de congé modifiée avec succès');
    }

    public function destroy(Leave $leave)
    {
        $leave->delete();
        return redirect()->route('rh.leave.index')->with('success', 'Demande de congé supprimée avec succès');
    }
}
