<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProf extends Model
{
    //

    protected $fillable = [
        'age',
        'gender',
        'height',
        'weight',
        'activity',
        'goal',
        'date',
        'user_id',
        'tdee',
    ];
}
