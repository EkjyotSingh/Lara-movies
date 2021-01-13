@extends('layouts.app')
@section('content')

<div class=" container mx-auto pt-14 px-2 lg:px-6 space-y-10">
    @foreach($season['episodes'] as $episode)
        <div class="rounded-md border border-gray-600 shadow-lg xs:mx-8 sm:mx-0">
            <div class="grid grid-cols-6 lg:grid-cols-3 xl:grid-cols-4 pr-0 sm:pr-2 md:pr-4 gap-2 md:gap-4 xl:gap-8 rounded-t-md border-b border-gray-600">
                <div class="col-span-6 sm:col-span-3 md:col-span-2 lg:col-span-1">
                    @if(isset($episode['still_path']) && $episode['still_path']!=null)
                        {{--<img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" src="{{'https://image.tmdb.org/t/p/original' .$episode['still_path']}}" class="rounded-t-md sm:rounded-tl-md sm:rounded-tr-none h-40 w-full sm:w-72">--}}
                    @else
                        <img class="rounded-t-md sm:rounded-tl-md sm:rounded-tr-none h-40 w-full sm:w-72" src="{{asset('img/no-img.jpg')}}"/>
                    @endif
                </div>
                <div class="col-span-6 sm:col-span-3 md:col-span-4 lg:col-span-2 xl:col-span-3 my-auto px-2 sm:px-0">
                    <div class="py-3">
                        <div class="md:flex items-center justify-between mb-4">
                            <div class="text-gray-200 font-extrabold flex items-center">
                                <h3 class="inline-block">{{$episode['episode_number']}}</h3>
                                <span class="font-light hidden h-4 bg-white text-xs text-black mx-3 py-1 px-2 rounded-2xl md:flex items-center justify-between space-x-1">
                                    <svg class="icon inline-block icon-star-full fill-current text-black w-3 h-4">
                                        <use xlink:href="{{asset('img/sprite.svg#icon-star-full')}}"></use>
                                    </svg>
                                    <span style="padding-top:2px;">{{$episode['vote_average']}}</span>
                                </span>
                                <h3 class="inline-block ml-3 md:ml-0">{{$episode['name']}}</h3>
                            </div>
                            <span class="text-gray-400 font-light text-sm xs:text-md">{{\Carbon\Carbon::parse($episode['air_date'])->toFormattedDateString()}}</span>
                            <span class="inline-block md:hidden relative" style="top:3px;">
                                <span class="h-4 bg-white text-xs text-black mx-3 py-1 px-2 rounded-2xl flex items-center justify-between space-x-1">
                                    <svg class="icon inline-block icon-star-full fill-current text-black w-3 h-4">
                                        <use xlink:href="{{asset('img/sprite.svg#icon-star-full')}}"></use>
                                    </svg>
                                    <span style="padding-top:2px;">{{$episode['vote_average']}}</span>
                                </span>
                            </span>
                        </div>
                        @if(isset($episode['overview']) && $episode['overview'] !='')
                            <p class="text-gray-300 text-sm whitespace-pre-wrap">{{$episode['overview']}}</p>
                        @else
                            <p class="text-gray-300 text-sm whitespace-pre-wrap"> No overview is added</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-center text-gray-200 text-sm font-light py-2 expand_link{{$episode['episode_number']}}"><span class="cursor-pointer hover:underline hover:text-gray-400" onclick="expand({{$episode['episode_number']}})">Expand</span></div>
            <div class="hidden expand{{$episode['episode_number']}} border-b border-gray-600">
                <div class="hidden sm:grid grid-cols-7 gap-x-2 px-4 py-3">
                    <h3 class="col-span-3 md:col-span-2 text-gray-200 font-bold">Crew <span class="text-gray-300 text-xs font-light">{{count($episode['crew'])}}</span></h3>
                    <h3 class="col-span-2 md:col-span-2 text-gray-200 font-bold ">Guest Stars <span class="text-gray-300 text-xs font-light">{{count($episode['guest_stars'])}}</span></h3>
                    <a href="{{route('cast.crew',$show_id)}}" class="col-span-2 md:col-span-3 text-gray-300 text-xs justify-self-end font-light">Full Cast & Crew</a>
                </div>

                <div class="grid grid-cols-7 gap-x-2 px-4 py-3">
                    <div class="col-span-7 sm:col-span-3 md:col-span-2">
                        <div>
                            <div class="sm:hidden mb-2 flex items-center justify-between">
                                <h3 class="text-gray-200 font-bold">Crew <span class="text-gray-300 text-xs font-light">{{count($episode['crew'])}}</span></h3>
                                <a href="{{route('cast.crew',$show_id)}}" class=" col-span-2 md:col-span-3 text-gray-300 text-xs justify-self-end font-light">Full Cast & Crew</a>
                            </div>
                            @if(count($episode['crew'])>0)
                                <?php $directors=collect($episode['crew'])->where('job','Director')?>
                                <h1 class="text-sm text-gray-200 font-bold inline-block">Directed By :</h1>
                                @foreach($directors as $director)
                                    <a href="{{route('people.show',$director['id'])}}" class="text-sm text-gray-300 font-light hover:underline hover:text-gray-400"> {{$director['name']}}@if(!$loop->last),@endif</a>
                                @endforeach
                            @else
                                <h1 class="text-sm text-gray-200 font-bold inline-block">Directed By :</h1><span class="text-sm text-gray-300 font-light">No director has been added</span>
                            @endif
                        </div>
                        <div>
                            @if(count($episode['crew'])>0)
                                <?php $writers=collect($episode['crew'])->where('job','Writer')?>
                                <h1 class="text-sm text-gray-200 font-bold inline-block">Written By :</h1>
                                @foreach($writers as $writer)
                                    <a href="{{route('people.show',$writer['id'])}}" class="text-sm text-gray-300 font-light hover:underline hover:text-gray-400"> {{$writer['name']}}@if(!$loop->last), @endif</a>
                                @endforeach
                            @else
                                <h1 class="text-sm text-gray-200 font-bold inline-block">Written By :</h1><span class="text-sm text-gray-300 font-light">No writer has been added</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-7 sm:col-span-4  md:col-span-5 space-y-3">
                        <h3 class="sm:hidden mb-2 mt-4 col-span-2 md:col-span-2 text-gray-200 font-bold ">Guest Stars <span class="text-gray-300 text-xs font-light">{{count($episode['guest_stars'])}}</span></h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if(count($episode['guest_stars'])>0)
                                @foreach($episode['guest_stars'] as $guest_star)
                                    <div class="flex items-center space-x-4 col-span-1">
                                        <a href="{{route('people.show',$guest_star['id'])}}">
                                            @if(isset($guest_star['profile_path']) && $guest_star['profile_path']!='')
                                                <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" class="w-16 h-16 rounded-md" src="{{'https://image.tmdb.org/t/p/w92' .$guest_star['profile_path']}}"/>
                                            @else
                                                <img class="w-16 h-16 rounded-md" src="{{asset('img/no-img.jpg')}}"/>
                                            @endif
                                        </a>
                                        <div>
                                            <a href="{{route('people.show',$guest_star['id'])}}"><h1 class="text-sm text-gray-200 font-extrabold">{{$guest_star['name']}}</h1></a>
                                            <span class="text-sm text-gray-300 font-light">{{$guest_star['character']}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-300 text-sm whitespace-pre-wrap">No guest stars are added</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="hidden lg:inline-block lg:col-span-1"></div>
                </div>

                <div class="px-4 py-3">
                    <h3 class="text-gray-200 font-bold py-3 ">Images</h3>
                    <div class="overflow-auto w-full images{{$episode['episode_number']}}">
                        <div class="loadmore_loader2 pt-8 flex justify-center" style="min-height:100px;">
                            <svg class=" icon icon-spinner3  fill-current text-gray-200 h-10 w-10 animate-spin"><use xlink:href="{{asset('img/sprite.svg#icon-spinner3')}}"></use></svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
</div>
@endsection
@section('script')
<script>
    function expand(id){
        $(`.expand${id}`).removeClass('hidden');
        $(`.expand_link${id}`).addClass('hidden');
        $(`.expand${id}`).addClass('block');
        $.ajax({
            url:`{{route('episode.single.images')}}`,
            type:'get',
            data:`show_id={{$show_id}}&season_no={{$season['season_number']}}&episode_no=${id}`,
            success:function(response){
                $(`.images${id}`).html(response.html);
            }
        })
    }
</script>
@endsection