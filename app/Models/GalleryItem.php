<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = [
        'title',
        'type',
        'url',
        'thumbnail',
        'caption',
        'category',
        'activity_date',
        'sort_order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];
}
