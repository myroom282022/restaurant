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
        'card_number',
        'currency',
        'payment_type',
        'brand',
        'receipt_url',
        'status',
    ];
}
