<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'api_token',
        'status',
    ];

    public function teams()
    {
        return $this->hasMany(Team::class, 'school_id');
    }

    public function athletes()
    {
        return $this->hasMany(Athlete::class, 'school_id');
    }

    public function competitions()
    {
        return $this->hasMany(Competition::class, 'school_id');
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class, 'school_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'school_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'school_id');
    }
}
