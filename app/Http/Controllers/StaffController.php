<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Talent;
use App\Models\Team;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::all();
        return view('rh.staff.index', compact('staffs'));
    }

    public function create()
    {
        // les talents
        return view('rh.staff.form',
            [
                'staff' => new Staff(),
                'teams' => Team::all(),
                'talents' => Talent::all(),
            ]
        );
    }
}
