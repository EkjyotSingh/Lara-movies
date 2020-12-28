@extends('layouts.app')
@section('content')

<div class=" container mx-auto py-14 px-2 lg:px-6 text-gray-200">

    <h1 class="uppercase text-xl font-bold text-yellow-500 mb-10">Popular People</h1>
    <div class="grid justify-items-center grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-6">
        @foreach($peoples as $people)
            <div class="flex flex-col text-gray-200 mb-11">
                <a href="{{route('people.show',$people['id'])}}">
                    <img src="{{'https://image.tmdb.org/t/p/w500' .$people['profile_path'] }}" class="transition duration-250 ease-in-out hover:opacity-50"/>
                </a>
                <a href="{{route('people.show',$people['id'])}}" class="text-lg mt-1 hover:text-yellow-400">{{$people['name']}}</a>
                <span class="text-xs h-4 overflow-hidden">
                    @foreach( $people['known_for'] as $peo)
                        @if($peo['media_type']=='tv')
                            {{$peo['name']}}@if(!$loop->last),@endif
                        @else
                            {{$peo['title']}}@if(!$loop->last),@endif
                        @endif
                    @endforeach
                </span>

            </div>
        @endforeach
    </div>
    
</div>
@endsection