@extends('layouts.app')
@section('content')

@foreach($results as $result)
    <div class="border-b border-gray-600 py-4">
        <div class=" container mx-auto  px-2 lg:px-6 space-y-10">
            <div class="grid grid-cols-8 lg:grid-cols-9 xl:grid-cols-8 gap-x-3 xs:gap-x-4 sm:gap-x-2 xl:gap-x-6">
                <div class="col-span-3 xxs:col-span-3 sm:col-span-2 lg:grid-cols-2 xl:col-span-1">
                    @if(isset($result['poster_path']) && $result['poster_path']!=null)
                        <img src="{{'https://image.tmdb.org/t/p/w300' .$result['poster_path']}}" onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" class="rounded-md h-44 sm:h-60 w-32 sm:w-36">
                    @else
                        <img class="rounded-md h-44 sm:h-60 w-32 sm:w-36" src="{{asset('img/no-img.jpg')}}"/>
                    @endif 
                </div>  
                <div class="col-span-4 xxs:col-span-5 sm:col-span-6 lg:grid-cols-7 xl:col-span-7 my-auto">
                    @if($type=='tv')
                        <a href="{{route('show.show',$result['id'])}}"><h2 class="text-gray-200 font-bold text-lg">{{$result['name']}}</h2></a>
                        @if(isset($result['first_air_date']) && $result['first_air_date']!='')
                            <h3 class="text-gray-400 font-light text-sm whitespace-pre-wrap">{!!\Carbon\Carbon::parse($result['first_air_date'])->toFormattedDateString()!!}</h3>
                        @endif
                        @if(isset($result['overview']) && $result['overview']!='')
                            <p class="text-gray-300 text-sm mt-8 whitespace-pre-wrap w-auto h-10" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{$result['overview']}}</p>
                        @else
                            <p class="text-gray-300 text-sm mt-8 whitespace-pre-wrap">No overview is added.</p>
                        @endif
                    @else
                        <a href="{{route('show.show',$result['id'])}}"><h2 class="text-gray-200 font-bold text-lg">{{$result['title']}}</h2></a>
                        @if(isset($result['release_date']) && $result['release_date']!='')
                            <h3 class="text-gray-400  font-light text-sm whitespace-pre-wrap">{!!\Carbon\Carbon::parse($result['release_date'])->toFormattedDateString()!!}</h3>
                        @endif
                        @if(isset($result['overview']) && $result['overview']!='')
                            <p class="text-gray-300 text-sm mt-8 whitespace-pre-wrap w-auto h-10" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{$result['overview']}}</p>
                        @else
                            <p class="text-gray-300 text-sm mt-8 whitespace-pre-wrap">No overview is added.</p>
                        @endif
                     @endif
                </div>  
            </div>
        </div>
    </div>
@endforeach
@endsection