<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'meta_title',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'hero_btn_primary_text',
        'hero_btn_primary_url',
        'hero_btn_secondary_text',
        'hero_btn_secondary_url',
        'section_title',
        'section_subtitle',
        'cta_title',
        'cta_description',
        'cta_btn_text',
        'body_content',
        'vision_title',
        'vision_content',
        'mission_title',
        'story_title',
        'story_content',
        'team_section_title',
        'team_section_subtitle',
    ];
}
