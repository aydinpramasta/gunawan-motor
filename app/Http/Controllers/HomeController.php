<?php

namespace App\Http\Controllers;

use App\Models\Accountancy;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $subweek = Carbon::today()->subWeek()->format('Y-m-d') . ' 00:00:00';
        $today = Carbon::today()->format('Y-m-d') . ' 23:59:59';

        $income = Accountancy::select('value', 'created_at')
            ->where('type', Accountancy::INCOME)
            ->whereBetween('created_at', [$subweek, $today])
            ->get();

        $expense = Accountancy::select('value', 'created_at')
            ->where('type', Accountancy::EXPENSE)
            ->whereBetween('created_at', [$subweek, $today])
            ->get();

        return view('dashboard', compact('income', 'expense'));
    }
}
