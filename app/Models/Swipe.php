<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Swipe extends Model
{
    protected $fillable = [
        'user_id',
        'target_id',
        'type'
    ];

    /**
     * Swipe performed by user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Swipe target profile
     */
    public function target()
    {
        return $this->belongsTo(User::class, 'target_id');
    }
}
