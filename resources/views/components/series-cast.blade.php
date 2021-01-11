<div class="flex items-center space-x-6 mb-4 col-span-1">
    <a href="{{route('people.show',$crew['id'])}}">
        @if(isset($crew['profile_path']) && $crew['profile_path']!='')
            <img class="w-16 h-16 rounded-md" onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" src="{{'https://image.tmdb.org/t/p/w92' .$crew['profile_path']}}" style="min-width:64px;"/>
        @else
        <img class="w-16 h-16 rounded-md" src="{{asset('img/no-img.jpg')}}" style="min-width:64px;"/>
        @endif
    </a>
    <div>
        <a href="{{route('people.show',$crew['id'])}}"><h1 class="text-sm text-gray-200 font-extrabold">{{$crew['name']}}</h1></a>
        <span class="text-sm text-gray-300 font-light">
            @foreach($crew['jobs'] as $job)
                {!!$job['job'].' <span class="font-light text-gray-400 font-sm">('.$job['episode_count'].' ' .Str::plural('Episode',$job['episode_count']).')</span>'!!}@if(!$loop->last), @endif
            @endforeach
        </span>
    </div>
</div>