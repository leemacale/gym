<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exercise extends Model
{
    //
    protected $fillable = [
        'name',
        'category_id',
        'image'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function equipment(): HasMany
    {
        return $this->hasMany(LinkExercise::class);
    }
}
