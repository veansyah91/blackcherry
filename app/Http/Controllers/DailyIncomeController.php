<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyIncomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('daily-income.index');
    }
}
