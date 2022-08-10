<?php

namespace App\Http\Controllers;

use App\Models\Accountancy;
use Illuminate\Http\Request;

class AccountancyController extends Controller
{
    public function index(Request $request)
    {
        $accountancies = Accountancy::latest()->paginate(25);

        return view('accountancy.index', compact('accountancies'));
    }
}
