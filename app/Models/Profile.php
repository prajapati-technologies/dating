<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'gender',
        'age',
        'city',
        'bio',
        'profile_photo',

        'relationship_status',
        'looking_for',
        'sexual_orientation',
        'height',
        'weight',

        'interests',
        'drink',
        'smoke',
        'education',
        'profession',

        'religion',
        'caste',

        'marital_status',
        'children',

        'min_age_pref',
        'max_age_pref',
        'preferred_city',
        'preferred_gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
