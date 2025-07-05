<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_id',
        'gender',
        'category',
        'distance',
        'round',
        'heat_number',
        'scheduled_time',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
