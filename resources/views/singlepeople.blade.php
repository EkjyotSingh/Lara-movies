@extends('layouts.app')
@section('content')

<div class=" container mx-auto py-14 px-2 lg:px-6 text-gray-200">

    <div class="space-x-0 sm:space-x-4 md:space-x-8 lg:space-x-12 pb-20 mx-10 sm:mx-0 h-screen grid grid-cols-1 sm:grid-cols-4">
        <div class="col-span-1">
            <img class="mb-4  rounded-md shadow-lg" src="{{'https://image.tmdb.org/t/p/original' .$people['profile_path'] }}"/>

            <h1 class="font-bold text-2xl text-center block sm:hidden">{{$people['name']}}</h1>

            <div class="flex items-center justify-center sm:justify-start space-x-4 my-4">
                @if(isset($people['external_ids']['facebook_id']))
                    <a href="https://www.facebook.com/{{$people['external_ids']['facebook_id']}}/" target="_blank">
                        <svg class="icon icon-facebook fill-current text-white w-5 h-5"><use xlink:href="{{asset('img/sprite.svg#icon-facebook')}}"></use></svg>
                    </a>
                @endif
                @if(isset($people['external_ids']['instagram_id']))
                    <a href="https://www.instagram.com/{{$people['external_ids']['instagram_id']}}" target="_blank">
                        <svg class="icon icon-instagram fill-current text-white w-5 h-5"><use xlink:href="{{asset('img/sprite.svg#icon-instagram')}}"></use></svg>
                    </a>
                @endif
                @if(isset($people['external_ids']['twitter_id']))
                    <a href="https://www.twitter.com/{{$people['external_ids']['twitter_id']}}" target="_blank">
                        <svg class="icon icon-twitter fill-current text-white w-5 h-5"><use xlink:href="{{asset('img/sprite.svg#icon-twitter')}}"></use></svg>
                    </a>
                @endif

                @if(isset($people['homepage']))
                    @if(isset($people['external_ids']['facebook_id']) || isset($people['external_ids']['instagram_id']) || isset($people['external_ids']['twitter_id']))
                        <span class="mx-1 text-gray-500 font-extralight text-3xl">|</span>
                    @endif
                    <a href="{{$people['homepage']}}" target="_blank">
                        <svg class="icon icon-link fill-current text-white w-5 h-5"><use xlink:href="{{asset('img/sprite.svg#icon-link')}}"></use></svg>
                    </a>
                @endif
            </div>

            <h1 class="font-medium text-lg mb-2">Personal Info</h1>

            <h1 class="font-medium text-md mb-2 mt-1">Known For</h1>
            <span class="font-light text-sm text-gray-400">{{$people['known_for_department']}}</span>

            {{--<h1 class="font-medium text-md mb-2 mt-4">Known Credits</h1>
            <span class="font-light text-sm text-gray-400">{{$people['name']}}</span>--}}

            <h1 class="font-medium text-md mb-2 mt-4">Gender</h1>
            <span class="font-light text-sm text-gray-400">{{$people['gender'] == '1'?'Female':'Male'}}</span>

            <h1 class="font-medium text-md mb-2 mt-4">Birthday</h1>
            <span class="font-light text-sm text-gray-400">{{$people['birthday']}} ({{\Carbon\Carbon::parse($people['birthday'])->age}} years old)</span>

            <h1 class="font-medium text-md mb-2 mt-4">Place of Birth</h1>
            <span class="font-light text-sm text-gray-400">{{$people['place_of_birth']}}</span>

            <h1 class="font-medium text-md mb-2 mt-4 hidden sm:block">Also Known As</h1>

            @foreach($people['also_known_as'] as $known)
                <span class="font-light text-sm text-gray-400 block mb-1 hidden sm:block">{{$known}}</span>
            @endforeach
        </div>

        <div class="flex flex flex-col  col-span-3">
            <h1 class="font-bold text-2xl mb-8 hidden sm:block">{{$people['name']}}</h1>
            <h1 class="font-medium text-lg mb-2 mt-4 sm:mt-0">Biography</h1>
            @if(isset($people['biography']) && $people['biography']!='')
                <p class="text-sm mb-6 whitespace-pre-wrap">{{$people['biography']}}</p>
            @else
                <h1 class="text-sm text-gray-400 mb-4">No Biography</h1>
            @endif

            @if(count($known_fors)>0)
                <h1 class="font-medium text-lg mb-2">Known For</h1>
                <div class="overflow-auto w-full mb-6">
                    <div class="flex flex-nowrap space-x-4">
                        @foreach($known_fors as $known_for)
                            <div style="min-width:110px; max-width:110px;" class="mb-2 ">
                                <a href="">
                                    <img src="{{'https://image.tmdb.org/t/p/w185'.$known_for['poster_path'] }}" class="h-40 rounded-md shadow-2xl"/>
                                </a>
                                <a href="" class="text-xs text-gray-400 mt-1 block text-center overflow-hidden">{{$known_for['title']}}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <h1 class="font-medium text-lg mb-2">Acting</h1>
            @if(count($cast_movies)>0 || count($cast_tvs)>0)
                <table class="border border-gray-400 shadow-2xl mb-6">
                    <thead>
                        <th class="font-medium text-md px-6 pt-2" colspan="2">Movies</th>
                    </thead>
                    <tbody>
                        @if(count($cast_movies)>0)
                            @foreach($cast_movies as $cast_movie)
                                <tr style="vertical-align:top;">
                                    <td class="text-center py-2">
                                        {!!isset($cast_movie['release_date']) && $cast_movie['release_date']!=''?'<span class="font-extralight px-6">'.\Carbon\Carbon::parse($cast_movie['release_date'])->format('Y').'</span>':'<span class="font-extralight px-6 text-4xl">-</span>'!!}
                                    </td>
                                    <td class="py-2">
                                        <span class="font-semibold">{{$cast_movie['title']}}</span>
                                        @if(isset($cast_movie['character']) && $cast_movie['character'] !='')
                                            <span class="text-md text-gray-400">as</span>
                                            <span class="text-gray-300">{{$cast_movie['character']}}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center text-sm text-gray-400"><td colspan="2">No Movies</td></tr>
                        @endif
                        <tr>
                            <td class="font-medium text-md px-6 pt-4 text-center" colspan="2">Tv Shows</td>
                        </tr>
                        @if(count($cast_tvs)>0)
                            @foreach($cast_tvs as $cast_tv)
                                <tr style="vertical-align:top;">
                                    <td class="text-center py-2">
                                        {!!isset($cast_tv['first_air_date']) && $cast_tv['first_air_date']!=''?'<span class="font-extralight px-6">'.\Carbon\Carbon::parse($cast_tv['first_air_date'])->format('Y').'</span>':'<span class="font-extralight px-6 text-4xl">-</span>'!!}
                                    </td>
                                    <td class="py-2">
                                        <span class="font-semibold">{{$cast_tv['name']}}</span>
                                        @if(isset($cast_tv['episode_count']) && $cast_tv['episode_count']!='0')
                                            <span class="text-sm text-gray-400">({{$cast_tv['episode_count'].' '.Str::plural('episode',$cast_tv['episode_count'])}})</span>
                                        @endif
                                        @if(isset($cast_tv['character']) && $cast_tv['character'] !='')
                                            <span class="text-md text-gray-400">as</span>
                                            <span class="text-gray-300">{{$cast_tv['character']}}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center text-sm text-gray-400"><td colspan="2">No Tv Shows</td></tr>
                        @endif
                    </tbody>
                </table>
            @else
                <h1 class="text-sm text-gray-400 mb-4">No Actings</h1>
            @endif


            <h1 class="font-medium text-lg mb-2">Production</h1>
            @if(count($crew_movies)>0 || count($crew_tvs)>0)

            <table class="border border-gray-400 shadow-2xl">
                <thead>
                    <th class="font-medium text-md px-6 pt-2" colspan="2">Movies</th>
                </thead>
                <tbody>
                    @if(count($crew_movies)>0)
                        @foreach($crew_movies as $crew_movie)
                            <tr style="vertical-align:top;">
                                <td class="text-center py-2">
                                    {!!isset($crew_movie['release_date']) && $crew_movie['release_date']!=''?'<span class="font-extralight px-6">'.\Carbon\Carbon::parse($crew_movie['release_date'])->format('Y').'</span>':'<span class="font-extralight px-6 text-4xl">-</span>'!!}
                                </td>
                                <td class="py-2">
                                    <span class="font-semibold">{{$crew_movie['title']}}</span>
                                    @if(isset($crew_movie['job']) && $crew_movie['job'] !='')
                                        <span class="text-md text-gray-400">as</span>
                                        <span class="text-gray-300">{{$crew_movie['job']}}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-center text-sm text-gray-400"><td colspan="2">No Movies</td></tr>
                    @endif
                    <tr>
                        <td class="font-medium text-md px-6 pt-4 text-center" colspan="2">Tv Shows</td>
                    </tr>
                    @if(count($crew_tvs)>0)
                        @foreach($crew_tvs as $crew_tv)
                            <tr style="vertical-align:top;">
                                <td class="text-center py-2">
                                    {!!isset($crew_tv['first_air_date']) && $crew_tv['first_air_date']!=''?'<span class="font-extralight px-6">'.\Carbon\Carbon::parse($crew_tv['first_air_date'])->format('Y').'</span>':'<span class="font-extralight px-6 text-4xl">-</span>'!!}
                                </td>
                                <td class="py-2">
                                    <span class="font-semibold">{{$crew_tv['name']}}</span>
                                    @if(isset($crew_tv['episode_count']) && $crew_tv['episode_count']!='0')
                                        <span class="text-sm text-gray-400">({{$crew_tv['episode_count'].' '.Str::plural('episode',$crew_tv['episode_count'])}})</span>
                                    @endif
                                    @if(isset($crew_tv['job']) && $crew_tv['job'] !='')
                                        <span class="text-md text-gray-400">as</span>
                                        <span class="text-gray-300">{{$crew_tv['job']}}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-center text-sm text-gray-400"><td colspan="2">No Tv Shows</td></tr>
                    @endif
                </tbody>
            </table>
            @else
                <h1 class="text-sm text-gray-400">No Productions</h1>
            @endif
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    
</script>
  @endsection