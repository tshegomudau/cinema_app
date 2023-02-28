<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\ShowTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $cinemas = Cinema::all();
        $movie = Movie::all();
        $showTimes = ShowTime::all();
        return view('booking.index', compact('cinemas', 'movie', 'showTimes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cinema' => 'required',
            'movie' => 'required',
            'show_time' => 'required',
            'tickets' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // check if there is available seats
        $cinema = Cinema::find($request->cinema);
        $showTime = ShowTime::find($request->show_time);
        $bookingsCount = Booking::where('show_time_id', $request->show_time)->count();
        $availableSeats = $cinema->max_seats_per_theater - $bookingsCount;

        if ($availableSeats < $request->tickets) {
            $validator->errors()->add('tickets', 'Not enough seats available');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // create booking
        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->cinema_id = $request->cinema;
        $booking->movie_id = $request->movie;
        $booking->show_time_id = $request->show_time;
        $booking->tickets = $request->tickets;
        $booking->booking_ref = 'B' . uniqid();
        $booking->save();

        return redirect()->route('booking.show', $booking->id);
    }

    public function show($id)
    {
        $booking = Booking::find($id);
        if ($booking->user_id != Auth::id()) {
            abort(403);
        }
        return view('booking.show', compact('booking'));
    }

    public function cancel($id)
    {
        $booking = Booking::find($id);
        if ($booking->user_id != Auth::id()) {
            abort(403);
        }
        $booking->delete();
        return redirect()->route('booking.index');
    }
}
