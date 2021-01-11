@foreach($peoples['results'] as $people)
    <div class="flex flex-col text-gray-200 mb-11 items-center w-full">
        <?php $known_for=array();?>
        <a href="{{route('people.show',$people['id'])}}" class="w-full h-60 xxs:h-60  sm:h-56 lg:h-60 xl:h-72">
            @if($people['profile_path'])
                <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" src="{{'https://image.tmdb.org/t/p/w185' .$people['profile_path'] }}" class="transition duration-250 ease-in-out hover:opacity-50 h-full  xl:h-72 w-96"/>
            @else
                <div class="transition flex items-center justify-center h-56 xxs:h-60  sm:h-56 lg:h-60 xl:h-72 text-3xl duration-250 ease-in-out hover:opacity-50 bg-gray-200 text-black">{{substr($people['name'],0,2)}}</div>
            @endif
        </a>
        <h3 class="text-lg mt-1 hover:text-yellow-400 block text-center"><a href="{{route('people.show',$people['id'])}}" class="text-lg mt-1 hover:text-yellow-400 block text-center">{{$people['name']}}</a></h3>
        <span class="text-xs h-4 truncate text-center whitespace-nowrap w-full">
            @foreach( $people['known_for'] as $peo)
                @if($peo['media_type']=='tv')
                    <?php array_push($known_for,$peo['name'])?>
                @else
                <?php array_push($known_for,$peo['title'])?>
                @endif
            @endforeach
            {{implode(', ',$known_for),0,23}}
        </span>
    </div>
@endforeach