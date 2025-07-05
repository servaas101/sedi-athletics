<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'name',
        'description',
    ];

    public function school()
    {
        return $this->belongsTo(Tenant::class, 'school_id');
    }

    public function athletes()
    {
        return $this->hasMany(Athlete::class);
    }
}
