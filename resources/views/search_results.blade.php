@extends('layouts.app')
@section('content')

@foreach($results as $result)
    <div class="border-b border-gray-600 py-4">
        <div class=" container mx-auto  px-2 lg:px-6 space-y-10">
            <div class="grid grid-cols-3 xxs:grid-cols-6 md:grid-cols-7 lg:grid-cols-8 gap-x-3 xxs:gap-x-0 ">
                @if(isset($result['title']))
                {{--movie--}}
                    <div class="cols-span-1 xxs:col-span-2 sm:col-span-1">
                        @if(isset($result['poster_path']) && $result['poster_path']!=null)
                            <img src="{{'https://image.tmdb.org/t/p/w300' .$result['poster_path']}}" onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" class="rounded-md h-32  w-24">
                        @else
                            <img class="rounded-md h-32  w-24" src="{{asset('img/no-img.jpg')}}"/>
                        @endif
                    </div>
                    <div class="col-span-2 xxs:col-span-4 sm:col-span-5 md:col-span-6 lg:col-span-7 my-auto">
                        <a href="{{route('movie.show',$result['id'])}}"><h2 class="text-gray-200 font-bold text-lg">{{$result['title']}}</h2></a>
                        @if(isset($result['release_date']) && $result['release_date']!='')
                            <h3 class="text-gray-400  font-light text-sm whitespace-pre-wrap">{!!\Carbon\Carbon::parse($result['release_date'])->toFormattedDateString()!!}</h3>
                        @endif
                        @if(isset($result['overview']) && $result['overview']!='')
                            <p class="text-gray-300 text-sm mt-3 xs:mt-8 whitespace-pre-wrap w-auto h-10" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{$result['overview']}}</p>
                        @else
                            <p class="text-gray-300 text-sm mt-3 xs:mt-8 whitespace-pre-wrap">No overview is added.</p>
                        @endif
                    </div>
                @else
                    {{--tv_shows--}}
                    @if(isset($result['poster_path']))
                        <div class="cols-span-1 xxs:col-span-2 sm:col-span-1">
                            @if(isset($result['poster_path']) && $result['poster_path']!=null)
                                <img src="{{'https://image.tmdb.org/t/p/w300' .$result['poster_path']}}" onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" class="rounded-md h-32  w-24">
                            @else
                                <img class="rounded-md h-32  w-24" src="{{asset('img/no-img.jpg')}}"/>
                            @endif 
                        </div> 
                        <div class="col-span-2 xxs:col-span-4 sm:col-span-5 md:col-span-6 lg:col-span-7 my-auto">
                            <a href="{{route('show.show',$result['id'])}}"><h2 class="text-gray-200 font-bold text-lg">{{$result['name']}}</h2></a>
                            @if(isset($result['first_air_date']) && $result['first_air_date']!='')
                                <h3 class="text-gray-400 font-light text-sm whitespace-pre-wrap">{!!\Carbon\Carbon::parse($result['first_air_date'])->toFormattedDateString()!!}</h3>
                            @endif
                            @if(isset($result['overview']) && $result['overview']!='')
                                <p class="text-gray-300 text-sm mt-3 xs:mt-8 whitespace-pre-wrap w-auto h-10" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{$result['overview']}}</p>
                            @else
                                <p class="text-gray-300 text-sm mt-3 xs:mt-8 whitespace-pre-wrap">No overview is added.</p>
                            @endif
                        </div>
                    @else
                    {{--people--}}
                        <div class="cols-span-1 xxs:col-span-2 sm:col-span-1">
                            @if(isset($result['profile_path']) && $result['profile_path']!=null)
                                <img src="{{'https://image.tmdb.org/t/p/w300' .$result['profile_path']}}" onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" class="rounded-md h-32  w-24">
                            @else
                                <img class="rounded-md h-32  w-24" src="{{asset('img/no-img.jpg')}}"/>
                            @endif 
                        </div> 
                        <div class="col-span-2 xxs:col-span-4 sm:col-span-5 md:col-span-6 lg:col-span-7 my-auto">
                            <a href="{{route('people.show',$result['id'])}}"><h2 class="text-gray-200 font-bold text-lg">{{$result['name']}}</h2></a>
                        </div>

                    @endif

                @endif
            </div>
        </div>
    </div>
@endforeach
@endsection