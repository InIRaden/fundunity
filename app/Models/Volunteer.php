<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'category',
        'is_verified',
        'registered_at',
        'is_active',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'registered_at' => 'date',
        'is_active' => 'boolean',
    ];
}
