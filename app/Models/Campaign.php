<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'title',
        'description',
        'collected',
        'target',
        'deadline',
        'category',
        'status',
        'is_active',
    ];

    protected $casts = [
        'collected' => 'integer',
        'target' => 'integer',
        'deadline' => 'date',
        'is_active' => 'boolean',
    ];
}
