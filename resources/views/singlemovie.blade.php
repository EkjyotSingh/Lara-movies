@extends('layouts.app')
@section('content')

<div class=" container mx-auto py-14 px-2 lg:px-6 text-gray-200">

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-0 sm:gap-x-6 pb-20 lg:px-4  border-b border-gray-600 mx-0 xxs:mx-10 sm:mx-0">
        <img src="{{'https://image.tmdb.org/t/p/w342' .$moviedetails['poster_path'] }}" class="h-60 sm:h-auto justify-self-center"/>
        <div class="flex flex-col md:justify-between sm:col-span-2">
            <div class="text-center sm:text-left">
                <h1 class="font-bold text-lg xxs:text-xl sm:text-2xl mt-6 sm:mt-0">{{$moviedetails['title']}}</h1>
                <div class="text-xs sm:text-sm flex flex-wrap justify-center sm:justify-start mt-1">
                    <svg class="icon inline-block icon-star-full fill-current text-yellow-400 mr-1 w-3 h-3 sm:w-4 sm:h-4">
                        <use xlink:href="{{asset('img/sprite.svg#icon-star-full')}}"></use>
                    </svg>
                    <span>{{$moviedetails['vote_average']*10 .'%'}}</span>
                    <span class="mx-1.5">|</span>
                    <span>{{\Carbon\Carbon::parse($moviedetails['release_date'])->format('M d, Y')}}</span>
                    <span class="mx-1.5">|</span>
                    <span class="">
                        @foreach( $moviedetails['genres'] as $gen)
                        {{$gen['name']}}@if(!$loop->last),@endif
                        @endforeach
                    </span>
                </div>
            </div>
            <div class="text-sm sm:text-base my-8 font-normal">
                {{$moviedetails['overview']}}
            </div>
            <div>
                <h1 class="font-bold text-lg my-2">Featured Crew</h1>
                <div class="flex space-x-16">
                    @foreach($moviedetails['credits']['crew'] as $crew)
                        @if($loop->index<2)
                            <div>
                                <h1 class="text-sm sm:text-base font-semibold">{{$crew['name']}}</h1>
                                <span class="text-xs sm:text-sm">{{$crew['department']}}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @foreach($moviedetails['videos']['results'] as $video)
                @if($video['type']=='Trailer')
                    <a href="https://youtu.be/{{$video['key']}}" target='_blank' class="mt-8  rounded-sm w-40 text-black text-lg px-3 py-3 bg-yellow-600 flex items-center justify-center inline hover:bg-yellow-700">
                        <svg class="icon icon-play fill-current text-black h-6 w-6 mr-3">
                            <use xlink:href="{{asset('img/sprite.svg#icon-play')}}"></use>
                        </svg>
                        <span class="font-semibold">Play Trailer</span>
                    </a>
                <?php break;?>
                @endif
            @endforeach
        </div>
    </div>
    <div class="pt-20 border-b border-gray-600  pb-20 mx-0 xxs:mx-10 sm:mx-0">
        <h1 class="font-bold text-2xl mt-6 md:mt-0 mb-6 lg:px-4 ">Cast</h1>
        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-8 w-full">
            @foreach($moviedetails['credits']['cast'] as $cast)
                @if($loop->index<5)
                    <div class="flex flex-col align-center w-full lg:px-4">
                        <a href="w-full">
                            @if($cast['profile_path'])
                                <img src="{{'https://image.tmdb.org/t/p/w185' .$cast['profile_path']}}" class="w-full h-40 xxs:h-44 sm:h-52 xl:h-64"/>
                            @else
                                <img src="{{asset('img/no-img.jpg')}}" class="h-40 xxs:h-44 sm:h-52 xl:h-64"/>
                            @endif
                        </a>
                        <span class="font-semibold mt-2">{{$cast['original_name']}}</span>
                        <span class="font-extralight text-sm">{{$cast['character']}}</span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="pt-20 pb-20 mx-0 xxs:mx-10 sm:mx-0">
        <h1 class="font-bold text-2xl mt-6 md:mt-0 mb-6 lg:px-4 ">Images</h1>
        <div class="grid grid-cols-2 place-items-center sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($moviedetails['images']['backdrops'] as $image)
                @if($loop->index<10)
                    <div class="flex flex-col justify-start">
                        <img src="{{'https://image.tmdb.org/t/p/w200' .$image['file_path']}}"/>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection