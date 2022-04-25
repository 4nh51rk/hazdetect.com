<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Ships/Index',[
            'ships' => Ship::withCount('devices')->get(),
        ]);
    }
}
