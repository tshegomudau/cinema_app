<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'Movie_id',
        'show_time_id',
        'cinema_id',
        'num_of_tickets',
        'booking_ref',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function showTime()
    {
        return $this->belongsTo(ShowTime::class);
    }
    public function cinemas()
    {
        return $this->belongsTo(Cinema::class);
    }
}
