<?php

namespace App\Http\Controllers\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class DashboardController extends Controller
{
	// dashbaord data : AUTHOR (Harsh Chauhan)
    public function dashboard(Request $request)
    {
    	
        return view('agent.dashboard.index');
    }
}