<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'total_donation',
        'last_donation',
        'is_active',
    ];

    protected $casts = [
        'total_donation' => 'integer',
        'last_donation' => 'date',
        'is_active' => 'boolean',
    ];
}
