<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'tmdb_id',
        'title',
        'release_date',
        'rating',
        'overview',
        'poster_path',
    ];

    public function showTimes()
    {
        return $this->hasMany(ShowTime::class);
    }
}
