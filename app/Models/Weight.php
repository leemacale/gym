<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    //
    protected $fillable = [
        
        'date',
        'user_id',
        'weight',
        'remarks',
    ];
}
