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
        'image',
        'status',
        'is_active',
    ];

    protected $casts = [
        'collected' => 'integer',
        'target' => 'integer',
        'deadline' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the donations for the campaign.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Get the updates for the campaign.
     */
    public function updates()
    {
        return $this->hasMany(CampaignUpdate::class);
    }
}
