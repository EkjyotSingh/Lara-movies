@extends('layouts.app')
@section('content')

<div class=" container mx-auto py-14 px-2 lg:px-6 text-gray-200">

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-0 sm:gap-x-6 pb-10 sm:pb-20  border-b border-gray-600 mx-0  sm:mx-0">
        <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" src="{{'https://image.tmdb.org/t/p/w342' .$moviedetails['poster_path'] }}" class="my-auto rounded-md shadow-lg w-40 xs:w-60 h-60 xs:h-80 sm:h-auto sm:w-auto justify-self-center"/>
        <div class="flex flex-col md:justify-between sm:col-span-2 my-auto">
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

            @if(isset($moviedetails['runtime']) && $moviedetails['runtime']!='')
                <span class="flex items-center pt-3 text-xs sm:text-sm text-gray-400 mx-auto sm:mx-0">
                    <svg class="icon icon-clock fill-current text-gray-400 h-3 w-3 mr-2 inline-block  sm:mb-0.5"><use xlink:href="{{asset('img/sprite.svg#icon-clock')}}"></use></svg>
                    <span>
                        @if(intdiv($moviedetails['runtime'], 60)!=0)
                            {{intdiv($moviedetails['runtime'], 60).'h '}}
                        @endif
                        @if($moviedetails['runtime'] % 60!=0)
                            {{$moviedetails['runtime'] % 60 .'m'}}
                        @endif
                    </span>
                </span>
            @endif

            @if(isset($moviedetails['tagline']) && $moviedetails['tagline']!='')
                <i class="text-sm font-extralight text-gray-400 pt-6 sm-pt-8">
                    {{$moviedetails['tagline']}}
                </i>
            @endif
            <div class="text-gray-300 text-sm mt-4 mb-8">
                {{$moviedetails['overview']}}
            </div>
            <div>
                <h2 class="font-bold text-lg my-2">Featured Crew</h2>
                <div class="flex space-x-16">
                    @foreach($moviedetails['credits']['crew'] as $crew)
                        @if($loop->index<2)
                            <div>
                                <h2 class="text-sm sm:text-base font-semibold">{{$crew['name']}}</h2>
                                <span class="text-xs sm:text-sm">{{$crew['department']}}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="mt-8 xxs:flex items-center justify-between">
                @foreach($moviedetails['videos']['results'] as $video)
                    @if($video['type']=='Trailer')
                        <a href="https://youtu.be/{{$video['key']}}" target='_blank' class=" rounded-sm font-semibold text-black px-3 py-3 bg-yellow-600 flex items-center justify-center text-sm hover:bg-yellow-700" style="width:118.66px;">
                            <svg class="icon icon-play fill-current text-black h-4 w-4 mr-2">
                                <use xlink:href="{{asset('img/sprite.svg#icon-play')}}"></use>
                            </svg>
                            <span class="">Play Trailer</span>
                        </a>
                    <?php break;?>
                    @endif
                @endforeach

                <div class="flex items-center justify-start space-x-4 pt-6 pb-8">
                    @if(isset($moviedetails['external_ids']['facebook_id']))
                        <a href="https://www.facebook.com/{{$moviedetails['external_ids']['facebook_id']}}/" target="_blank">
                            <svg class="icon icon-facebook fill-current text-white w-5 h-5"><use xlink:href="{{asset('img/sprite.svg#icon-facebook')}}"></use></svg>
                        </a>
                    @endif
                    @if(isset($moviedetails['external_ids']['instagram_id']))
                        <a href="https://www.instagram.com/{{$moviedetails['external_ids']['instagram_id']}}" target="_blank">
                            <svg class="icon icon-instagram fill-current text-white w-5 h-5"><use xlink:href="{{asset('img/sprite.svg#icon-instagram')}}"></use></svg>
                        </a>
                    @endif
                    @if(isset($moviedetails['external_ids']['twitter_id']))
                        <a href="https://www.twitter.com/{{$moviedetails['external_ids']['twitter_id']}}" target="_blank">
                            <svg class="icon icon-twitter fill-current text-white w-5 h-5"><use xlink:href="{{asset('img/sprite.svg#icon-twitter')}}"></use></svg>
                        </a>
                    @endif

                    @if(isset($moviedetails['homepage']))
                        @if(isset($moviedetails['external_ids']['facebook_id']) || isset($moviedetails['external_ids']['instagram_id']) || isset($moviedetails['external_ids']['twitter_id']))
                            <span class="mx-1 text-gray-500 font-extralight text-3xl">|</span>
                        @endif
                        <a href="{{$moviedetails['homepage']}}" target="_blank">
                            <svg class="icon icon-link fill-current text-white w-5 h-5"><use xlink:href="{{asset('img/sprite.svg#icon-link')}}"></use></svg>
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <div class="py-10 sm:py-20 border-b border-gray-600">
        <h2 class="font-semibold text-2xl mt-6 md:mt-0 mb-6">Cast</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-y-6 gap-x-12 xxs:gap-x-8 xs:gap-x-14 sm:gap-x-8 lg:gap-x-12 xl:gap-x-14 w-full">
            @foreach($moviedetails['credits']['cast'] as $cast)
                @if($loop->index<5)
                    <div class="flex flex-col align-center w-full">
                        <a href="{{route('people.show',$cast['id'])}}">
                            @if($cast['profile_path'])
                                <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" src="{{'https://image.tmdb.org/t/p/w185' .$cast['profile_path']}}" class="w-full h-40 xxs:h-44 sm:h-44 lg:h-48 xl:h-60"/>
                            @else
                                <img src="{{asset('img/no-img.jpg')}}" class="h-40 xxs:h-44 sm:h-44 lg:h-48 xl:h-60"/>
                            @endif
                        </a>
                        <a href="{{route('people.show',$cast['id'])}}"><h1 class="font-bold mt-2">{{$cast['original_name']}}</h1></a>
                        <span class="font-extralight text-xs">{{$cast['character']}}</span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="py-10 sm:py-20 border-b border-gray-600">
        <h2 class="font-semibold text-2xl mt-6 md:mt-0 mb-6">Images</h2>
        <div class="grid grid-cols-1 xs:grid-cols-2 place-items-center sm:grid-cols-3 xl:grid-cols-4 gap-x-0 gap-y-4 xxs:gap-4 md:gap-4 lg:gap-12 xl:gap-8">
            @foreach($moviedetails['images']['backdrops'] as $image)
                @if($loop->index<10)
                    <div class="w-full">
                        <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" src="{{'https://image.tmdb.org/t/p/w780' .$image['file_path']}}" class="w-full"/>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="py-10 sm:py-20 border-b border-gray-600">
        <h2 class="font-semibold text-2xl mt-6 md:mt-0 mb-6">Details</h2>
        <div class="grid grid-cols-1 xxs:grid-cols-2 md:grid-cols-4 justify-items-start">
            @if(isset($moviedetails['budget']) && $moviedetails['budget']!='')
                <div>
                    <h3 class="text-gray-300 font-semibold text-sm mt-4">Budget</h3>
                    <span class="text-gray-400 font-light text-sm">{{number_format($moviedetails['budget'],2)}}</span>
                </div>
            @endif
            @if(isset($moviedetails['revenue']) && $moviedetails['revenue']!='')
                <div>
                    <h3 class="text-gray-300 font-semibold text-sm mt-4">Revenue</h3>
                    <span class="text-gray-400 font-light text-sm">{{number_format($moviedetails['revenue'],2)}}</span>
                </div>
            @endif
            @if(isset($moviedetails['status']) && $moviedetails['status']!='')
                <div>
                    <h3 class="text-gray-300 font-semibold text-sm mt-4">Status</h3>
                    <span class="text-gray-400 font-light text-sm">{{$moviedetails['status']}}</span>
                </div>
            @endif
            @if(isset($moviedetails['original_language']) && $moviedetails['original_language']!='')
                <div>
                    <h3 class="text-gray-300 font-semibold text-sm mt-4">Original Language</h3>
                    <span class="text-gray-400 font-light text-sm">{{$language['english_name']}}</span>
                </div>
            @endif
        </div>
    </div>

    <div class="py-10 sm:py-20 border-b border-gray-600">
        <h2 class="font-semibold text-2xl mt-6 md:mt-0 mb-6">Recommendtions</h2>
        <div class="overflow-auto w-full">
            <div class="flex flex-nowrap space-x-4">
                @foreach($moviedetails['recommendations']['results'] as $recommendation)
                    <div class="">
                        <a href="{{route('movie.show',$recommendation['id'])}}">
                            @if(isset($recommendation['backdrop_path']) && $recommendation['backdrop_path']!=null)
                                <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" src="{{'https://image.tmdb.org/t/p/w300' .$recommendation['backdrop_path']}}" class="w-full h-28 rounded-md shadow-xl"/>
                            @else
                                <img class="w-full h-28 rounded-md shadow-xl" src="{{asset('img/no-img.jpg')}}"/>
                            @endif
                        </a>
                        <div class="flex items-center justify-between text-xs text-gray-400 mt-1"><a href="{{route('movie.show',$recommendation['id'])}}" class="w-40 truncate">{{$recommendation['title']}}</a><span class="ml-6">{{$recommendation['vote_average']*10}}%</span></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    @if(count($moviedetails['keywords']['keywords'])>0)
        <div class="py-10 sm:py-20">
            <h2 class="font-semibold text-2xl mt-6 md:mt-0 mb-6">Keywords</h2>
            @foreach($moviedetails['keywords']['keywords'] as $keyword)
                <a href="{{route('movie.keyword',$keyword['id'])}}" class="text-black font-light text-sm mr-2 whitespace-nowrap bg-white rounded-sm px-2 py-1">{{$keyword['name']}}</a>
            @endforeach
        </div>
    @endif
</div>
@endsection