@extends('layouts.app')
@section('content')

@foreach($seasons['seasons'] as $season)
    <div class="border-b border-gray-600 py-4">
        <div class=" container mx-auto  px-2 lg:px-6 space-y-10">
            <div class="grid grid-cols-8 lg:grid-cols-9 xl:grid-cols-8 gap-x-3 xs:gap-x-4 sm:gap-x-2 xl:gap-x-6">
                <div class="col-span-3 xxs:col-span-3 sm:col-span-2 lg:grid-cols-2 xl:col-span-1">
                    @if(isset($season['poster_path']) && $season['poster_path']!=null)
                        <img src="{{'https://image.tmdb.org/t/p/w300' .$season['poster_path']}}" onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" class="rounded-md h-44 sm:h-60 w-32 sm:w-36">
                    @else
                        <img class="rounded-md h-44 sm:h-60 w-32 sm:w-36" src="{{asset('img/no-img.jpg')}}"/>
                    @endif 
                </div>  
                <div class="col-span-4 xxs:col-span-5 sm:col-span-6 lg:grid-cols-7 xl:col-span-7 my-auto">
                    <x-single-season :season="$season" :id="$seasons['id']" :name="$seasons['name']"/>
                </div>  
            </div>
        </div>
    </div>
@endforeach
@endsection