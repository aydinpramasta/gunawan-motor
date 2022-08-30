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

    public function create()
    {
        return view('accountancy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', 'numeric'],
            'value' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        Accountancy::create([
            'type' => $request->type,
            'value' => (int) str_replace('.', '', $request->value),
            'description' => $request->description
        ]);

        return redirect()->route('accountancies.index')->with('success', 'Berhasil menambah akuntansi.');
    }

    public function edit(Accountancy $accountancy)
    {
        return view('accountancy.edit', compact('accountancy'));
    }

    public function update(Request $request, Accountancy $accountancy)
    {
        $request->validate([
            'type' => ['required', 'numeric'],
            'value' => ['required', 'string'],
            'description' => ['string']
        ]);

        $accountancy->update([
            'type' => $request->type,
            'value' => (int) str_replace('.', '', $request->value),
            'description' => $request->description
        ]);

        return redirect()->route('accountancies.index')->with('success', 'Berhasil mengedit akuntansi.');
    }

    public function destroy(Accountancy $accountancy)
    {
        $accountancy->delete();

        return redirect()->route('accountancies.index')->with('success', 'Berhasil menghapus akuntansi.');
    }
}
