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
        // Dates
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));
        $date = new DateTime();
        $date->setDate($year, $month, 1);

        $previousDate = clone($date);
        $previousDate->modify('-1 month');

        $nextDate = clone($date);
        $nextDate->modify('+1 month');
        
        // Build periods, budgets
        $budgets = $request->user()->budgets()->orderBy('name', 'asc')->orderBy('periodicity', 'asc')->get();
        $periods = [
            'monthly' => [],
            'yearly' => [],
        ];
        foreach ($budgets as $budget) {
            if (!isset($periods[$budget->periodicity])) {
                $periods[$budget->periodicity] = [];
            }
            $budget->setScope($date->format('m'), $date->format('Y'));
            $periods[$budget->periodicity][] = $budget;
        }

        // Calc totals
        foreach ($periods as $period => $budgets) {
            $total = [
                'spent' => 0,
                'target' => 0,
                'progressColour' => '',
                'progress' => 100
            ];
            foreach ($budgets as $budget) {
                $total['spent'] += $budget->spent;
                $total['target'] += $budget->target;
                $total['remaining'] += $budget->remaining;
            }
            $total['progress'] = 100 - round(100 * ($total['spent'] / $total['target']));
            $total['progressColour'] = $total['progress'] <= 24 ? 'danger' : $total['progress'] <= 49 ? 'warning' : 'primary';
            $periods[$period][] = $total;
        }

        
        
        return view('home', compact('periods', 'date', 'previousDate', 'nextDate'));
    }
}
