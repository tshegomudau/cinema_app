<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'theater',
    ];

    public function showTime()
    {
        return $this->hasMany(ShowTime::class);
    }
}
