<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'event_name',
        'location',
        'start_date',
        'end_date',
        'organizer_name',
        'description',
        'event_booth_map',
    ];

    public function booths()
    {
        return $this->hasMany(Booth::class);
    }
}
