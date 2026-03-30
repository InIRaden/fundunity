<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FocusArea extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'icon',
        'color',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
