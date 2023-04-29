<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'translation_id',
        'amount',
        'number',
        'exp_month',
        'exp_year',
        'cvc',
        'status',
    ];
}
