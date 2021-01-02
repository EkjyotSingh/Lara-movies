@extends('layouts.app')
@section('content')

<div class=" container mx-auto py-14 px-2 lg:px-6">

    <h1 class="uppercase text-xl font-bold text-yellow-500 mb-10 text-center xxs:text-left">Top Rated movies</h1>
    <div class="w-44 mx-auto xxs:mx-0 xxs:w-full grid border-b border-gray-600 grid-cols-1 xxs:grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-x-0 xxs:gap-x-3 xs:gap-x-6 justify-items-center">
        @foreach($topratedmovies as $movie)
            <x-single-movie :movie="$movie" :genres="$genres"/>
        @endforeach
    </div>

    {{--<h1 class="uppercase text-xl font-bold text-yellow-500 my-10 text-center xxs:text-left">popular movies</h1>
    <div class="w-44 mx-auto xxs:mx-0 xxs:w-full grid justify-items-center border-b border-gray-600 grid-cols-1 xxs:grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-x-0 xxs:gap-x-3 xs:gap-x-6">
        @foreach($popularmovies as $movie)
            <x-single-movie :movie="$movie" :genres="$genres"/>
        @endforeach
    </div>



    <h1 class="uppercase text-xl font-bold text-yellow-500 my-10 text-center xxs:text-left">now playing movies</h1>
    <div class="w-44 mx-auto xxs:mx-0 xxs:w-full grid justify-items-center  grid-cols-1 xxs:grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-x-0 xxs:gap-x-3 xs:gap-x-6">
        @foreach($nowplayingmovies as $movie)
            <x-single-movie :movie="$movie" :genres="$genres"/>
        @endforeach
    </div>--}}
</div>
@endsection