<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialIndicator extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'code',
        'unit',
        'value',
        'date',
        'time',
        'origin'
    ];
}
