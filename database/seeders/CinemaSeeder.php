<?php

namespace Database\Seeders;

use App\Models\Cinema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CinemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $created_movie = Cinema::create([
            'name' => fake()->name(),
            'theater' => fake()->name(),
        ]);
    }
}
