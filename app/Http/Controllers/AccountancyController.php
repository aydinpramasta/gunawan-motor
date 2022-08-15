<?php

namespace App\Http\Controllers;

use App\Models\Accountancy;
use Illuminate\Http\Request;

class AccountancyController extends Controller
{
    public function index(Request $request)
    {
        $accountancies = Accountancy::query();

        $accountancies->when($request->type === 'income', function ($query) {
            $query->where('type', Accountancy::INCOME);
        });

        $accountancies->when($request->type === 'expense', function ($query) {
            $query->where('type', Accountancy::EXPENSE);
        });

        $accountancies->when($request->date === 'weekly', function ($query) {
            $subWeek = now('Asia/Jakarta')->subWeek()->setTime(hour: 0, minute: 0, second: 0)->format('Y-m-d H:i:s');
            $now = now('Asia/Jakarta')->setTime(hour: 23, minute: 59, second: 59)->format('Y-m-d H:i:s');

            $query->whereBetween('created_at', [$subWeek, $now]);
        });

        $accountancies->when($request->date === 'monthly', function ($query) {
            $subMonth = now('Asia/Jakarta')->subMonth()->setTime(hour: 0, minute: 0, second: 0)->format('Y-m-d H:i:s');
            $now = now('Asia/Jakarta')->setTime(hour: 23, minute: 59, second: 59)->format('Y-m-d H:i:s');

            $query->whereBetween('created_at', [$subMonth, $now]);
        });

        $accountancies = $accountancies->latest()->paginate(25);

        return view('accountancy.index', compact('accountancies'));
    }
}
