<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'profile_image',
        'user_id',
        'birthday',
        'gender',
        'drink',
        'bio',
        'job_tittle',
        'company_name',
        'facebook_id',
        'instagram',
        'name'
    ];
}
