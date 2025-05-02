<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class workout extends Model
{
    //

    protected $fillable = [
        'exercise_id',
        'reps',
        'date',
        'user_id',
    ];


    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
