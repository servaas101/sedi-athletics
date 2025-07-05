<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meet extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'code',
        'name',
        'start_date',
        'end_date',
        'location',
        'description',
        'status',
    ];

    public function school()
    {
        return $this->belongsTo(Tenant::class, 'school_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
