    <div class="flex flex-col text-gray-200 mb-11 w-full xl:px-3">
        <a href="{{route('movie.show',$movie['id'])}}" class="h-60 xxs:h-64 sm:h-56 lg:h-60 xl:h-72">
            <img src="{{'https://image.tmdb.org/t/p/w342' .$movie['poster_path'] }}" class="transition duration-250 ease-in-out hover:opacity-50  h-full xl:h-72 w-44 xxs:w-full"/>
        </a>
        <a href="{{route('movie.show',$movie['id'])}}" class="text-lg mt-1 hover:text-yellow-400">{{$movie['title']}}</a>
        <span class="text-xs mb-.5 flex">
            <svg class="icon inline-block icon-star-full fill-current text-yellow-400 w-3 h-3 mr-1">
                <use xlink:href="img/sprite.svg#icon-star-full"></use>
            </svg>
            {{$movie['vote_average']*10 .'%'}}<span class="mx-1.5">|</span>
            {{\Carbon\Carbon::parse($movie['release_date'])->format('M d,Y')}}
        </span>
        <span class="text-xs">
            @foreach( $movie['genre_ids'] as $gen)
            {{$genres->get($gen)}}@if(!$loop->last),@endif
            @endforeach
        </span>
    </div>
