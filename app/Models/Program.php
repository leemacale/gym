<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    //
    protected $fillable = [
        'name',
        'user_id',


    ];

    public function exercises(): HasMany
    {
        return $this->hasMany(programExercise::class);
    }
}
