<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'first_name',
        'last_name',
        'gender',
        'dob',
        'photo_url',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function school()
    {
        return $this->hasOneThrough(Tenant::class, Team::class, 'id', 'id', 'team_id', 'school_id');
    }
}
