<?php

namespace App\Http\Controllers;

use App\Models\Accountancy;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class RecapController extends Controller
{
    public function accountancy(Request $request)
    {
        $firstAccountancyDate = Accountancy::select('created_at')->oldest()->first()->created_at;

        foreach (CarbonPeriod::create($firstAccountancyDate, '1 month', now('Asia/Jakarta')) as $month) {
            $months[$month->format('Y-m')] = $month->format('F Y');
        }
        array_reverse($months);

        $accountancies = Accountancy::query();

        $accountancies->when(!empty($request->date), function ($query) use ($request) {
            $date = explode('-', $request->date);

            $query->whereYear('created_at', $date[0])
                ->whereMonth('created_at', $date[1]);
        }, function ($query) {
            $today = today();

            $query->whereYear('created_at', $today->year)
                ->whereMonth('created_at', $today->month);
        });

        $accountancies = $accountancies->latest()->get();

        return view('recap.accountancy', compact('months', 'accountancies'));
    }
}
