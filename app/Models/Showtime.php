<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'cinema_id',
        'start_time',
        'end_time',
        'max_capacity'
    ];

    public function cinemas()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function movies()
    {
        return $this->belongsTo(Movie::class);
    }
}
