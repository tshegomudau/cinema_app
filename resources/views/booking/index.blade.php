@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Cinema</th>
                                    <th>Movie</th>
                                    <th>Show Time</th>
                                    <th>Tickets</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Auth::user()->bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->cinema->name }}</td>
                                        <td>{{ $booking->movie->name }}</td>
                                        <td>{{ $booking->showTime->time }}</td>
                                        <td>{{ $booking->tickets }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>
                                            <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-sm btn-primary">View</a>
                                            <a href="{{ route('booking.cancel', $booking->id) }}" class="btn btn-sm btn-danger">Cancel</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection