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
}
