<?php

namespace App\Http\Controllers;

use App\Models\DailyOutcome;
use Illuminate\Http\Request;
use App\Models\MonthlyOutcome;

class MonthlyOutcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('monthly-outcome.index');
    }
}
