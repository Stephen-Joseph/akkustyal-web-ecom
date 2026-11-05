<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'section',
        'headline',
        'description',
        'image_path',

        'primary_button_text',
        'primary_button_url',

        'secondary_button_text',
        'secondary_button_url',

        'stat_1_value',
        'stat_1_label',

        'stat_2_value',
        'stat_2_label',

        'stat_3_value',
        'stat_3_label',
    ];
}
