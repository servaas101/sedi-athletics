<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'discipline_id',
        'athlete_id',
        'rank',
        'time',
        'points',
        'recorded_at',
    ];

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }
}
