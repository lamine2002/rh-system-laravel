<?php

namespace App\Http\Controllers;

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


}
