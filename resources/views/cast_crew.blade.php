@extends('layouts.app')
@section('content')

<div class=" container mx-auto pt-14 px-2 lg:px-6 space-y-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
        <div class="mb-6 md:mb-0">
            <h3 class="col-span-1 text-gray-200 font-bold inline-block mb-4">Series Cast</h3><span class="text-gray-400 font-light"> {{count($aggregate_credit['aggregate_credits']['cast'])}}</span>
            @if(count($aggregate_credit['aggregate_credits']['cast'])>0)
                @foreach($aggregate_credit['aggregate_credits']['cast'] as $cast)
                    <div class="flex items-center space-x-6 mb-4 col-span-1">
                        <a href="{{route('people.show',$cast['id'])}}">
                            @if(isset($cast['profile_path']) && $cast['profile_path']!='')
                                <img class="w-16 h-16 rounded-md" src="{{'https://image.tmdb.org/t/p/w92' .$cast['profile_path']}}" style="min-width:64px;" onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';"/>
                            @else
                                <img class="w-16 h-16 rounded-md" src="{{asset('img/no-img.jpg')}}" style="min-width:64px;"/>
                            @endif
                        </a>
                        <div>
                            <a href="{{route('people.show',$cast['id'])}}"><h1 class="text-sm text-gray-200 font-extrabold">{{$cast['name']}}</h1></a>
                            <span class="text-sm text-gray-300 font-light">
                                @foreach($cast['roles'] as $role)
                                    {!!$role['character'].' <span class="font-light text-gray-400 font-sm">('.$role['episode_count'].' ' .Str::plural('Episode',$role['episode_count']).')</span>'!!}@if(!$loop->last), @endif
                                @endforeach
                            </span>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-300 text-sm whitespace-pre-wrap">No series cast are added</p>
            @endif
        </div>

        <div>
            <h3 class="col-span-1 text-gray-200 font-bold inline-block mb-4">Series Crew</h3><span class="text-gray-400 font-light"> {{count($aggregate_credit['aggregate_credits']['crew'])}}</span>
            @if(count($aggregate_credit['aggregate_credits']['crew'])>0)
                @foreach($departments as $department)
                    @if(count(collect($aggregate_credit['aggregate_credits']['crew'])->where('department',$department))>0)
                        <div class="mb-8">
                            <h3 class="col-span-1 text-gray-200 font-bold mb-2">{{$department}}</h3>
                            @foreach(collect($aggregate_credit['aggregate_credits']['crew'])->where('department',$department) as $crew)
                                <x-series-cast :crew="$crew"/>
                            @endforeach
                        </div>
                    @endif
                @endforeach    
            @else
                <p class="text-gray-300 text-sm whitespace-pre-wrap">No series crew are added</p>
            @endif
        </div>
    </div>
</div>
@endsection