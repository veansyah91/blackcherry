<?php

namespace App\Http\Controllers;

use App\Models\DailyOutcome;
use Illuminate\Http\Request;

class DailyOutcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){ 
        return view('daily-outcome.index');
    }

    public function detail(){

        return view('daily-outcome.detail');

    }
}
