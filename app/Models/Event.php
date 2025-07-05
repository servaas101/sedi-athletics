<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'meet_id',
        'gender',
        'category',
        'distance',
        'round',
        'heat_number',
        'scheduled_time',
    ];

    public function meet()
    {
        return $this->belongsTo(Meet::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
