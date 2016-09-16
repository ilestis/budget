<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $budgets = $request->user()->budgets()->orderBy('name', 'asc')->orderBy('periodicity', 'asc')->get();
        $periodicites = [];
        foreach ($budgets as $budget) {
            if (!isset($periodicites[$budget->periodicity])) {
                $periodicites[$budget->periodicity] = [];
            }
            $periodicites[$budget->periodicity][] = $budget;
        }

        // Dates
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));
        $date = new DateTime();
        $date->setDate($year, $month, 1);
        
        $previousDate = clone($date);
        $previousDate->modify('-1 month');
        
        $nextDate = clone($date);
        $nextDate->modify('+1 month');
        
        return view('home', compact('periodicites', 'date', 'previousDate', 'nextDate'));
    }
}
