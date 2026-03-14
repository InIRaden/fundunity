<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'title',
        'short_description',
        'full_description',
        'image',
        'icon',
        'category',
        'target_audience',
        'location',
        'sort_order',
        'is_active',
    ];
}
