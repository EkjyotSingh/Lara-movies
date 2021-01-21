@extends('layouts.app')
@section('content')

<div class="md:border-b border-gray-600">
    <div class=" container mx-auto pt-14 px-2 lg:px-6">
        <div class="border-b border-gray-600 md:border-none grid grid-cols-4 space-x-0 sm:space-x-6 md:space-x-14 py-0 sm:py-8">
            <div class="col-span-4 sm:col-span-1 mb-8  sm:my-auto mx-auto sm:mx-0">
                @if(isset($show['poster_path']) && $show['poster_path']!=null)
                    <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" class="rounded-md shadow-lg w-40 xs:w-60 h-60 xs:h-80 sm:h-auto sm:w-auto" src="{{'https://image.tmdb.org/t/p/original' .$show['poster_path']}}">
                @else
                    <img class="rounded-md shadow-lg" src="{{asset('img/no-img.jpg')}}"/>
                @endif
            </div>
            <div class="col-span-4 sm:col-span-3 my-auto">
                <div class="flex flex-col pt-0 pb-10 lg:py-10">
                    <div class="text-center sm:text-left">
                        <h1 class="text-gray-200 font-bold text-2xl inline-block">{{$show['name']}}</h1>
                        @if(isset($show['first_air_date']) && $show['first_air_date']!='')
                            <span class="text-gray-300  text-xl font-extralight">({{\Carbon\Carbon::parse($show['first_air_date'])->format('Y')}})</span>
                        @endif
                        <div class="text-sm font-light text-gray-400 sm:flex items-center justify-center sm:justify-start">
                            <span class="block sm:inline-block mb-2 sm:mb-0">
                                @foreach($show['genres'] as $genre)
                                    {{$genre['name']}}@if(!$loop->last), @endif
                                @endforeach
                            </span>
                            @if(isset($show['episode_run_time'][0]) && $show['episode_run_time'][0]!='')
                                <svg class="icon icon-clock fill-current text-gray-400 h-3 w-3 ml-4 mr-1 sm:mr-1.5 inline-block mb-0.5"><use xlink:href="{{asset('img/sprite.svg#icon-clock')}}"></use></svg>
                                <span>
                                    @if(intdiv($show['episode_run_time'][0], 60)!=0)
                                        {{intdiv($show['episode_run_time'][0], 60).'h '}}
                                    @endif
                                    @if($show['episode_run_time'][0] % 60!=0)
                                        {{$show['episode_run_time'][0] % 60 .'m'}}
                                    @endif
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex space-x-8 items-center justify-center sm:justify-start my-6">
                        <div class="text-sm text-gray-300">User Score : {{ $show['vote_average']*10}}%</div>
                        @foreach($show['videos']['results'] as $video)
                            @if($video['type']=='Trailer')
                                <a href="javascript:void(0)" onclick="movie_video_show('{{$video['key']}}')" class="rounded-sm font-semibold text-black px-3 py-3 bg-yellow-600 flex items-center justify-center text-sm hover:bg-yellow-700">
                                    <svg class="icon icon-play fill-current text-black h-4 w-4 mr-2">
                                        <use xlink:href="{{asset('img/sprite.svg#icon-play')}}"></use>
                                    </svg>
                                    <span class="">Play Trailer</span>
                                </a>
                                <?php break;?>
                            @endif
                        @endforeach
                    </div>
                    @if(isset($show['tagline']) && $show['tagline']!='')
                        <i class="text-sm font-extralight text-gray-400">{{$show['tagline']}}</i>
                    @endif
                    <h2 class="text-gray-200 font-medium text-lg mt-4 mb-2">Overview</h2>
                    <p class="text-gray-300 text-sm whitespace-pre-wrap">{{$show['overview']}}</p>
                    @if(isset($show['created_by']) && count($show['created_by'])>0)
                        <a href="{{route('people.show',$show['created_by'][0]['id'])}}"><h3 class="text-gray-100 font-bold mt-4  text-sm">{{$show['created_by'][0]['name']}}</h3></a>
                        <div class="text-xs text-gray-300">Creator</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class=" container mx-auto pb-8 px-2 lg:px-6">
    <div class="grid grid-cols-4 space-x-0 md:space-x-6 lg:space-x-12">
        <div class="col-span-4 md:col-span-3">
            <div class="flex flex-col">

                <div class=" border-b border-gray-600 py-6">
                    <h2 class="text-gray-200 font-medium text-lg mb-3">Series Cast</h2>
                    <div class="overflow-auto w-full slide">
                        <div class="flex flex-nowrap space-x-4">
                            @foreach(collect($show['aggregate_credits']['cast'])->sortByDesc('total_episode_count')->take(9) as $aggregate_credit)
                                <div style="min-width:100px; max-width:100px;" class="mb-2 ">
                                    <a href="{{route('people.show',$aggregate_credit['id'])}}">
                                        @if(isset($aggregate_credit['profile_path']) && $aggregate_credit['profile_path']!=null)
                                            <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" src="{{'https://image.tmdb.org/t/p/w185' .$aggregate_credit['profile_path']}}" class="h-36 rounded-md shadow-2xl"/>
                                        @else
                                            <img class="h-36 rounded-md shadow-2xl" src="{{asset('img/no-img.jpg')}}"/>
                                        @endif
                                    </a>
                                    <a href="{{route('people.show',$aggregate_credit['id'])}}"><h1 class="text-sm font-bold text-gray-200 mt-1 block text-left overflow-hidden">{{$aggregate_credit['name']}}</h1></a>
                                    <div class="text-sm text-gray-300  block text-left overflow-hidden">{{$aggregate_credit['roles'][0]['character']}}</div>
                                    <div class="text-xs text-gray-400 block text-left overflow-hidden">
                                        {{$aggregate_credit['total_episode_count'].' '.Str::plural('Episode',$aggregate_credit['total_episode_count'])}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <h3 class="text-gray-300 font-bold text-sm mt-4"><a href="{{route('cast.crew',$show['id'])}}" >Full Cast & Crew</a></h3>
                </div>

                <div class=" border-b border-gray-600 py-6">
                    <h2 class="text-gray-200 font-medium text-lg mb-3">Current Season</h2>
                    <div class=" rounded-lg shadow-2xl border border-gray-600 flex space-x-8 pr-4">
                        @if(end($show['seasons'])['episode_count'] >0)
                            <a href="{{route('season.single',[$show['id'],end($show['seasons'])['season_number']])}}">
                                @if(end($show['seasons'])['poster_path']!=null)
                                    <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" class="w-28 h-36 rounded-l-md" src="{{'https://image.tmdb.org/t/p/w342' .end($show['seasons'])['poster_path']}}" style="min-width:96px;"/>
                                @else
                                    <img class="w-24 h-36 rounded-l-md" src="{{asset('img/no-img.jpg')}}" style="min-width:96px;"/>
                                @endif
                            </a>
                            <div class="my-auto">
                                <div class="py-3">
                                    <x-single-season :season="end($show['seasons'])" :id="$show['id']" :name="$show['name']"/>
                                </div>
                            </div>
                        @else
                            <a href="{{route('season.single',[$show['id'],$show['seasons'][count($show['seasons']) - 2]['season_number']])}}">
                                @if($show['seasons'][count($show['seasons']) - 2]['poster_path']!=null)
                                    <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" class="w-24 h-36 rounded-l-md" src="{{'https://image.tmdb.org/t/p/w342' .$show['seasons'][count($show['seasons']) - 2]['poster_path']}}" style="min-width:96px;"/>
                                @else
                                    <img class="w-24 h-36 rounded-l-md" src="{{asset('img/no-img.jpg')}}"/>
                                @endif
                            </a>
                            <div class="my-auto">
                                <div class="py-3">
                                    <x-single-season :season="$show['seasons'][count($show['seasons']) - 2]" :id="$show['id']" :name="$show['name']"/>
                                </div>
                            </div>
                        @endif
                    </div>
                    <h3 class="text-gray-300 font-bold text-sm mt-4"><a href="{{route('all.seasons',$show['id'])}}">View All Seasons</a></h3>
                </div>

                <div class="py-6">
                    <h2 class="text-gray-200 font-medium text-lg mb-3">Recommendtions</h2>
                    <div class="overflow-auto w-full slide">
                        <div class="flex flex-nowrap space-x-4">
                            @foreach($show['recommendations']['results'] as $recommendation)
                                <div class="mb-2">
                                    <a href="{{route('show.show',$recommendation['id'])}}">
                                        @if(isset($recommendation['backdrop_path']) && $recommendation['backdrop_path']!=null)
                                            <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" src="{{'https://image.tmdb.org/t/p/w300' .$recommendation['backdrop_path']}}" class="w-full h-28 rounded-md shadow-2xl"/>
                                        @else
                                            <img class="w-full h-28 rounded-md shadow-2xl" src="{{asset('img/no-img.jpg')}}"/>
                                        @endif
                                    </a>
                                    <div class="flex items-center justify-between text-xs text-gray-400 mt-1"><a href="{{route('show.show',$recommendation['id'])}}" class="w-40 truncate">{{$recommendation['name']}}</a><span class="ml-6">{{$recommendation['vote_average']*10}}%</span></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-span-4 md:col-span-1">

            <div class="flex items-center justify-start space-x-4 pt-6 pb-8">
                @if(isset($show['external_ids']['facebook_id']))
                    <a href="https://www.facebook.com/{{$show['external_ids']['facebook_id']}}/" target="_blank">
                        <svg class="icon icon-facebook fill-current text-white w-5 h-5"><use xlink:href="{{asset('img/sprite.svg#icon-facebook')}}"></use></svg>
                    </a>
                @endif
                @if(isset($show['external_ids']['instagram_id']))
                    <a href="https://www.instagram.com/{{$show['external_ids']['instagram_id']}}" target="_blank">
                        <svg class="icon icon-instagram fill-current text-white w-5 h-5"><use xlink:href="{{asset('img/sprite.svg#icon-instagram')}}"></use></svg>
                    </a>
                @endif
                @if(isset($show['external_ids']['twitter_id']))
                    <a href="https://www.twitter.com/{{$show['external_ids']['twitter_id']}}" target="_blank">
                        <svg class="icon icon-twitter fill-current text-white w-5 h-5"><use xlink:href="{{asset('img/sprite.svg#icon-twitter')}}"></use></svg>
                    </a>
                @endif

                @if(isset($show['homepage']))
                    @if(isset($show['external_ids']['facebook_id']) || isset($show['external_ids']['instagram_id']) || isset($show['external_ids']['twitter_id']))
                        <span class="mx-1 text-gray-500 font-extralight text-3xl">|</span>
                    @endif
                    <a href="{{$show['homepage']}}" target="_blank">
                        <svg class="icon icon-link fill-current text-white w-5 h-5"><use xlink:href="{{asset('img/sprite.svg#icon-link')}}"></use></svg>
                    </a>
                @endif
            </div>
            
            <h3 class="text-gray-300 font-bold text-md mb-4">Facts</h3>
            <div>
                <h3 class="text-gray-300 font-semibold text-sm mt-4">Status</h3>
                <span class="text-gray-400 font-light text-sm">{{$show['status']}}</span>
            </div>

            <div>
                <h3 class="text-gray-300 font-semibold text-sm mt-4 mb-1">Network</h3>
                @foreach($show['networks'] as $network)
                    <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" src="{{'https://image.tmdb.org/t/p/w300' .$network['logo_path']}}" class="h-8 mb-4">
                @endforeach
            </div>

            <div>
                <h3 class="text-gray-300 font-semibold text-sm mt-4">Type</h3>
                <span class="text-gray-400 font-light text-sm">{{$show['type']}}</span>
            </div>

            <div>
                <h3 class="text-gray-300 font-semibold text-sm mt-4">Original Language</h3>
                <span class="text-gray-400 font-light text-sm">{{$language}}</span>
            </div>

            <div>
                <h3 class="text-gray-300 font-semibold text-sm mt-4">Keywords</h3>
                @foreach($show['keywords']['results'] as $keyword)
                    <a href="{{route('tv.keyword',$keyword['id'])}}" class="text-black font-light text-sm mr-2 whitespace-nowrap bg-white rounded-sm px-2 py-1">{{$keyword['name']}}</a>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection