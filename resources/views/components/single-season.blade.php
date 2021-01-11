
<a href="{{route('season.single',[$id,$season['season_number']])}}"><h2 class="text-gray-200 font-bold text-lg">{{$season['name']}}</h2></a>
<h3 class="text-gray-200 font-extrabold text-sm mb-8  whitespace-pre-wrap">{!!\Carbon\Carbon::parse($season['air_date'])->format('Y').'<span class="text-gray-400 font-extralight">  |  </span>'.$season['episode_count']!!} Episodes</h3>
@if(\Carbon\Carbon::parse($season['air_date'])->lessThan(\Carbon\Carbon::now()))
    @if(isset($season['overview']) && $season['overview']!='')
        <p class="text-gray-300 text-sm whitespace-pre-wrap">{{$season['overview']}}</p>
    @else
    <p class="text-gray-300 text-sm whitespace-pre-wrap">{{$season['name'].' of '.$name.' premiered on '.\Carbon\Carbon::parse($season['air_date'])->toFormattedDateString()}}.</p>
    @endif
@else
    <p class="text-gray-300 text-sm whitespace-pre-wrap">{{$season['name'].' of '.$name.' is set to premier on '.\Carbon\Carbon::parse($season['air_date'])->toFormattedDateString()}}.</p>
@endif