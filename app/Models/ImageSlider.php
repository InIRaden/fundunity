<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageSlider extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}