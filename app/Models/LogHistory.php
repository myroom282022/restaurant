<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'keyword', 'description', 'tone','signature','device_type','hash_tag_name','title','word_size',
    ];
}
