<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booth extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'event_id',
        'booth_code',
        'type',
        'size',
        'price',
        'status',
        'available_start_date',
        'available_end_date',
        'description',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
