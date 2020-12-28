@extends('layouts.app')
@section('content')

<div class=" container mx-auto py-14 px-2 lg:px-6 text-gray-200">

    <div class="flex-col md:flex-row flex  space-x-0 md:space-x-32 pb-20  border-b border-gray-600 mx-10 sm:mx-0">
        <img src="{{'https://image.tmdb.org/t/p/w300' .$moviedetails['poster_path'] }}" />
        <div class="flex flex-col md:justify-between">
            <div>
                <h1 class="font-bold text-2xl mt-6 md:mt-0">{{$moviedetails['title']}}</h1>
                <span class="text-sm flex flex-wrap mt-1">
                    <svg class="icon inline-block icon-star-full fill-current text-yellow-400 w-4 h-4 mr-1">
                        <use xlink:href="{{asset('img/sprite.svg#icon-star-full')}}"></use>
                    </svg>
                    {{$moviedetails['vote_average']*10 .'%'}}<span class="mx-1.5">|</span>
                    {{\Carbon\Carbon::parse($moviedetails['release_date'])->format('M d, Y')}}
                    <span class="mx-1.5">|</span>
                    <span class="">
                        @foreach( $moviedetails['genres'] as $gen)
                        {{$gen['name']}}@if(!$loop->last),@endif
                        @endforeach
                    </span>
                </span>
            </div>
            <div class="my-8">
                {{$moviedetails['overview']}}
            </div>
            <div>
                <h1 class="font-bold text-lg my-2">Featured Crew</h1>
                <div class="flex space-x-16">
                    @foreach($moviedetails['credits']['crew'] as $crew)
                        @if($loop->index<2)
                            <div>
                                <h1 class="font-semibold">{{$crew['name']}}</h1>
                                <span class="text-sm">{{$crew['department']}}</span>
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
    <div class="pt-20 border-b border-gray-600  pb-20 mx-10 sm:mx-0">
        <h1 class="font-bold text-2xl mt-6 md:mt-0 mb-6 ">Cast</h1>
        <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-8 ">
            @foreach($moviedetails['credits']['cast'] as $cast)
                @if($loop->index<5)
                    <div class="flex flex-col justify-start">
                        @if($cast['profile_path'])
                            <img src="{{'https://image.tmdb.org/t/p/w200' .$cast['profile_path']}}"/>
                        @else
                            <div class="w-full h-full bg-gray-400"></div>
                        @endif
                        <span class="font-semibold mt-2">{{$cast['original_name']}}</span>
                        <span class="font-extralight text-sm">{{$cast['character']}}</span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="pt-20 pb-20 mx-10 sm:mx-0">
        <h1 class="font-bold text-2xl mt-6 md:mt-0 mb-6">Images</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
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