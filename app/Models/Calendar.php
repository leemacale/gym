<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    //
    protected $fillable = [
        'comment',
        'start_date',
        'end_date',
        'user_id',
    ];
}
