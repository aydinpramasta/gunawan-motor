<?php

namespace App\Http\Controllers;

use App\Models\Accountancy;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $subweek = Carbon::today()->subWeek()->setTime(hour: 0, minute: 0, second: 0)->format('Y-m-d H:i:s');
        $today = Carbon::today()->setTime(hour: 23, minute: 59, second: 59)->format('Y-m-d H:i:s');

        $accountancies = Accountancy::select('type', 'value')
            ->whereBetween('created_at', [$subweek, $today])
            ->get();

        $income = $accountancies->where('type', Accountancy::INCOME)->sum('value');

        $expense = $accountancies->where('type', Accountancy::EXPENSE)->sum('value');

        return view('dashboard', compact('income', 'expense'));
    }
}
