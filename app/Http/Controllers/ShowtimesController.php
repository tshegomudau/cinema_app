<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showtime;

class ShowtimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $showtimes = Showtime::all();

        return view('showtimes.index', compact('showtimes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('showtimes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cinema_id' => 'required|integer',
            'movie_id' => 'required|integer',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
            'max_capacity' => 'required|integer|min:1|max:30',
        ]);

        $showtime = Showtime::create($validatedData);

        return redirect()->route('showtimes.index')
            ->with('success', 'Showtime created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Showtime  $showtime
     * @return \Illuminate\Http\Response
     */
    public function show(Showtime $showtime)
    {
        return view('showtimes.show', compact('showtime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Showtime  $showtime
     * @return \Illuminate\Http\Response
     */
    public function edit(Showtime $showtime)
    {
        return view('showtimes.edit', compact('showtime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Showtime  $showtime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Showtime $showtime)
    {
        $validatedData = $request->validate([
            'cinema_id' => 'required|integer',
            'movie_id' => 'required|integer',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
            'max_capacity' => 'required|integer|min:1|max:30',
        ]);

        $showtime->update($validatedData);

        return redirect()->route('showtimes.index')
            ->with('success', 'Showtime updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Showtime  $showtime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Showtime $showtime)
    {
        $showtime->delete();

        return redirect()->route('showtimes.index')
            ->with('success', 'Showtime deleted successfully.');
    }
}
