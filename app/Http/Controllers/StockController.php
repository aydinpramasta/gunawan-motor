<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $stocks = Stock::query();

        $stocks->when(!empty($request->search), function ($query) use ($request) {
            $query->where('name', 'LIKE', "{$request->search}%");
        });

        $stocks = $stocks->latest()->paginate(9);

        return view('stock.index', compact('stocks'));
    }

    public function show()
    {
    }

    public function create()
    {
        return view('stock.create');
    }

    public function store()
    {
    }

    public function edit()
    {
        return view('stock.edit');
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
