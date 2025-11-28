<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name', 'tagline', 'logo', 'favicon',
        'primary_color', 'secondary_color',
        'email', 'phone', 'address', 'footer_text',
        'facebook', 'instagram', 'twitter', 'youtube'
    ];
}
