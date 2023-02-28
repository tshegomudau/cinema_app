<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    /**
     * Show the list of cinemas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cinemas = Cinema::all();

        return view('cinemas.index', compact('cinemas'));
    }

    /**
     * Show the list of theaters for a specific cinema.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cinema $cinema
     * @return \Illuminate\View\View
     */
    public function showTheaters(Request $request, Cinema $cinema)
    {
        $theaters = $cinema->theaters;

        return view('cinemas.showTheaters', compact('cinema', 'theaters'));
    }
}
