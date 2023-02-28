<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ShowTime;
use App\Models\Movie;
use App\Models\Cinema;
use Carbon\Carbon;


class ShowtimeSeeder extends Seeder
{
    public function run()
    {
        $movies = Movie::all();
        $cinemas = Cinema::all();

        foreach ($movies as $movie) {
            foreach ($cinemas as $cinema) {
                $startTime = Carbon::today()->addHours(9); // first show starts at 9am
                $endTime = $startTime->copy()->addMinutes($movie->duration);

                while ($endTime->lte(Carbon::today()->addHours(23))) { // last show starts at 11pm
                    ShowTime::create([
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'movie_id' => $movie->id,
                        'cinema_id' => $cinema->id,
                    ]);
                    $startTime = $endTime->copy()->addMinutes(30); // 30 minutes gap between shows
                    $endTime = $startTime->copy()->addMinutes($movie->duration);
                }
            }
        }
    }
}

