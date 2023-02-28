@extends('layouts.app')

@section('content')

    <div class="tv-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                @if($movies['poster_path'])
                    <img src="{{'https://image.tmdb.org/t/p/w400/'.$movies['poster_path']}}" alt="actor1" class="w-64 lg:w-96">
                @else
                    <img src="https://via.placeholder.com/400x500" alt="actor1" class="w-64 lg:w-96">
                @endif
            </div>

            <div class="md:ml-24">
                <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $movies['title'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                    <span class="ml-1">{{ $movies['vote_average'] * 10 .'%' }}</span>
                    <span class="mx-2">|</span>
                    <span>{{\Carbon\Carbon::parse($movies['release_date'])->format('M d, Y')}}</span>
                    <span class="mx-2">|</span>
                    <span>
                    @foreach($movies['genres'] as $genre)
                    
                    {{$genre['name']}}@if(!$loop->last); @endif
                    
                    @endforeach
                    </span>
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $movies['overview'] }}
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">
                        Featured Crew
                    </h4>
                    <div class="flex mt-4">
                        @foreach($movies['credits']['crew'] as $crew)
                            @if($loop->index < 2)
                                <div class="mr-8">
                                    <div> {{$crew['name']}}</div>
                                    <div class="text-sm text-gray-400">
                                        {{$crew['job']}}
                                    </div>
                                </div>
                            @else
                                @break
                            @endif
                        @endforeach

                    </div>
                </div>
                <div class="mt-12">
                    @if(Auth::check())
                        <a class="nav-link" style="cursor: pointer" data-toggle="modal" data-target="#bookingModal">
                            <button class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                            <span class="ml-2">Reserve movies</span>
                            </button>
                        </a>
                    @else
                        <!-- Display content for non-logged in user -->
                        <button class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150" data-toggle="modal" data-target="#loginModal">Log in to book</button>
                    @endif
                    
                </div>
                

            </div>
        </div>
    </div> <!-- end tv-info -->

    <div class="tv-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($movies['credits']['cast'] as $cast)
                    @if($loop->index < 5)
                    <div class="mt-8">
                        <a href="#">
                            @if($cast['profile_path'])
                            <img src="{{'https://image.tmdb.org/t/p/w300/'.$cast['profile_path']}}" alt="actor1" class="hover:opacity-75 transition ease-in-out duration-150">
                            @else
                            <img src="https://via.placeholder.com/300x450" alt="actor1" class="hover:opacity-75 transition ease-in-out duration-150">
                            @endif
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg mt-2 hover:text-gray:300">{{ $cast['name'] }}</a>
                            <div class="text-sm text-gray-400">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>
                    @else
                        @break
                    @endif
                @endforeach
            </div>
        </div>
    </div> <!-- end tv-cast -->

    
@endsection
@auth
    @include('partials.make-booking')
@endauth
