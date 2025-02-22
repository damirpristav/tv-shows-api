<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TvShow extends Model
{
    protected $fillable = [
        'title',
        'cast',
    ];

    protected $casts = [
        'cast' => 'array',
    ];
}
