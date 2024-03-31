<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function absences()
    {
        $absences = Absence::where('staff_id', auth()->user()->staff_id)->orderBy('created_at', 'desc')->paginate(10);
        return view('rh.personal.absences', compact('absences'));
    }
}
