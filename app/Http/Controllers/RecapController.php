<?php

namespace App\Http\Controllers;

use App\Models\Accountancy;
use App\Models\Stock;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class RecapController extends Controller
{
    public function accountancy(Request $request)
    {
        $firstAccountancyMonth = Accountancy::select('created_at')
            ->oldest()
            ->first()
            ->created_at
            ->startOfMonth();

        foreach (CarbonPeriod::create($firstAccountancyMonth, '1 month', today('Asia/Jakarta')->startOfMonth()) as $month) {
            $months[$month->format('Y-m')] = $month->format('F Y');
        }
        $months = array_reverse($months);

        $accountancies = Accountancy::query();

        $accountancies->when(!empty($request->date), function ($query) use ($request) {
            $date = explode('-', $request->date);

            $query->whereYear('created_at', $date[0])
                ->whereMonth('created_at', $date[1]);
        }, function ($query) {
            $today = today('Asia/Jakarta');

            $query->whereYear('created_at', $today->year)
                ->whereMonth('created_at', $today->month);
        });

        $accountancies = $accountancies->latest()->get();

        return view('recap.accountancy', compact('months', 'accountancies'));
    }

    public function stock()
    {
        $stocks = Stock::latest()->get();

        return view('recap.stock', compact('stocks'));
    }
}
