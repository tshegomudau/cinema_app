<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Cinema;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
       

       
        $movies = Movie::all();
            $cinemas  = Cinema::all();
            $showTimes = Showtime::all();

            return view('welcome', compact( 'cinemas','showTimes','movies' ) );


        
        //return view('home');
    }

    public function show($id){

        $movies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
        ->json();
        $cinemas = Cinema::all();
        $showTimes  = Showtime::all();
        $movie = Movie::where('tmdb_id',$id)->first();
        
        return view('show', compact( 'movies','cinemas','showTimes','movie' ));
    }
}
