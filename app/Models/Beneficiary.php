<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'program_name',
        'location',
        'assistance_value',
        'is_active',
    ];

    protected $casts = [
        'assistance_value' => 'integer',
        'is_active' => 'boolean',
    ];
}
