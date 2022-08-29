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

    public function create()
    {
        return view('stock.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'image' => ['mimes:png,jpg,svg,webp', 'max:2048'],
            'price' => ['required', 'string'],
            'quantity' => ['required', 'numeric']
        ]);

        $filePath = null;
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('stocks');
        }

        Stock::create([
            'name' => $request->name,
            'image' => $filePath,
            'price' => (int) str_replace('.', '', $request->price),
            'quantity' => $request->quantity
        ]);

        return redirect()->route('stocks.index')->with('success', 'Berhasil menambah stok.');
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
