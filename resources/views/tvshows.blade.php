@extends('layouts.app')
@section('content')

<div class=" container mx-auto py-14 px-2 lg:px-6">

    <h1 class="uppercase text-xl font-bold text-yellow-500 mb-10 text-center xxs:text-left">Top Rated Shows</h1>
    <div class="w-44 mx-auto xxs:mx-0 xxs:w-full grid border-b border-gray-600 grid-cols-1 xxs:grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-x-0 xxs:gap-x-3 xs:gap-x-6 xl:gap-x-12 justify-items-center">
        @foreach($topratedshows as $show)
            <x-single-show :show="$show" :genres="$genres"/>
        @endforeach
    </div>

    <h1 class="uppercase text-xl font-bold text-yellow-500 my-10 text-center xxs:text-left">Popular Shows</h1>
    <div class="w-44 mx-auto xxs:mx-0 xxs:w-full grid justify-items-center border-b border-gray-600 grid-cols-1 xxs:grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-x-0 xxs:gap-x-3 xs:gap-x-6 xl:gap-x-12">
        @foreach($popularshows as $show)
            <x-single-show :show="$show" :genres="$genres"/>
        @endforeach
    </div>



    <h1 class="uppercase text-xl font-bold text-yellow-500 my-10 text-center xxs:text-left">tv shows airing today</h1>
    <div class="w-44 mx-auto xxs:mx-0 xxs:w-full grid justify-items-center  grid-cols-1 xxs:grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-x-0 xxs:gap-x-3 xs:gap-x-6 xl:gap-x-12">
        @foreach($ontheairshows as $show)
            <x-single-show :show="$show" :genres="$genres"/>
        @endforeach
    </div>
</div>
@endsection