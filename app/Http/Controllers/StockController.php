<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        return view('stock.index');
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
