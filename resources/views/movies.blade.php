@extends('layouts.app')
@section('content')

<div class=" container mx-auto py-14 px-2 lg:px-6">

    <h1 class="uppercase text-xl font-bold text-yellow-500 mb-10">Top Rated movies</h1>
    <div class="grid justify-items-center border-b border-gray-600 grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-6">
        @foreach($topratedmovies as $movie)
            <x-single-movie :movie="$movie" :genres="$genres"/>
        @endforeach
    </div>

    <h1 class="uppercase text-xl font-bold text-yellow-500 my-10">popular movies</h1>
    <div class="grid justify-items-center border-b border-gray-600 grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-6">
        @foreach($popularmovies as $movie)
            <x-single-movie :movie="$movie" :genres="$genres"/>
        @endforeach
    </div>



    <h1 class="uppercase text-xl font-bold text-yellow-500 my-10">now playing movies</h1>
    <div class="grid justify-items-center  grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-6">
        @foreach($nowplayingmovies as $movie)
            <x-single-movie :movie="$movie" :genres="$genres"/>
        @endforeach
    </div>
</div>
@endsection