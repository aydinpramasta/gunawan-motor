<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accountancy extends Model
{
    use HasFactory;

    public const INCOME = 1;
    public const EXPENSE = 2;

    protected $fillable = [
        'type',
        'value',
    ];
}
