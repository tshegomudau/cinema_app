
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModal">Booking Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form action="{{ route('booking.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="cinema">Cinema</label>
                        <select name="cinema" id="cinema" class="form-control" required>
                            <option value="">Select cinema</option>
                            @foreach($cinemas as $cinema)
                                <option value="{{ $cinema->id }}">{{ $cinema->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="movie">Movie Name</label>
                        <input type="text" name="name" id="name" value="{{ $movies['title'] }}"  class="form-control" required disabled>
                        <input type="text" name="movie" id="movie" value="{{ $movies['id'] }}"  class="form-control" required hidden>
                    </div>
                
                    <div class="form-group">
                        <label for="show_time">Show Time</label>
                        <select name="show_time" id="show_time" class="form-control" required :movie="$movie">
                            <option value="">Select show time</option>
                            @foreach($showTimes->where('Movie_id', $movie->id) as $showTime)
                                <option value="{{ $showTime->id }}">{{ $showTime->start_time }} - {{ $showTime->end_time }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tickets">Tickets</label>
                        <input type="number" name="tickets" id="tickets" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')


