<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/upcoming');

        if ($popularMovies->successful()) {
            $newMovie = $popularMovies->json()['results'];
            $popularMoviesCollection = collect($newMovie);

            foreach($popularMoviesCollection->take(5) as $movie){
                $runtime = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/'.$movie['id'].'?runtime')
                ->json();
                $created_movie = Movie::create([
                   
                    'tmdb_id' => $movie['id'],
                    'title' => $movie['title'],
                    'rating' => $movie['vote_average'],
                    'release_date' => $movie['release_date'],
                    'overview' => $movie['overview'],
                    'duration' => $runtime['runtime'],
                    'poster_path' => $movie['poster_path'],
                ]);

                
                
            }
            

           
        }
    }
}
