<?php

namespace App\Http\Controllers;

use App\Models\Accountancy;
use Illuminate\Http\Request;

class AccountancyController extends Controller
{
    public function index()
    {
        $accountancies = Accountancy::paginate(15);

        return view('accountancy.index', compact('accountancies'));
    }
}
