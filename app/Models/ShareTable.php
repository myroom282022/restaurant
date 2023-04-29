<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'share_with_other',
        'club_name',
        'performer',
        'share_table_date',
        'drink_preferences',
        'desired_company',
        'currency',
        'age_limite',
        'additional_info',
        'covide19_check_pvr_test',
        'covide19_check_vaccination_prof',
    ];
}
