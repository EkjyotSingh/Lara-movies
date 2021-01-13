<ul class="absolute mt-1 w-full border border-gray-300 bg-gray-800 border_list overflow-auto">
    @foreach($search as $sea)
    <li class="text-white flex text-sm hover:bg-gray-700">
        @if($sea['media_type'] == 'person')
            <a href="{{route('people.show', $sea['id'])}}" class="py-1">
                @if(isset($sea['profile_path']) && $sea['profile_path']!='')
                    <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" class="w-10 h-12 mx-2 inline-block" src="{{'https://image.tmdb.org/t/p/w45' .$sea['profile_path'] }}" style="min-width:40px;">
                @else
                    <div class="flex justify-center items-center w-10 h-12 mx-2 inline-block bg-gray-200 text-black" style="min-width:40px;">{{substr($sea['name'],0,2)}}</div>
                @endif
            </a>
        @elseif($sea['media_type'] == 'movie')
            <a href="{{route('movie.show', $sea['id'])}}" class="py-1">
                @if(isset($sea['poster_path']) && $sea['poster_path']!='')
                    <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" class="w-10 h-12 mx-2 inline-block" src="{{'https://image.tmdb.org/t/p/w92' .$sea['poster_path'] }}" style="min-width:40px;">
                @else
                    <div class="flex justify-center items-center w-10 h-12 mx-2 bg-gray-200 text-black" style="min-width:40px;">{{substr($sea['title'],0,2)}}</div>
                @endif
            </a>
        @else
            <a href="{{route('movie.show', $sea['id'])}}" class="py-1">
                @if(isset($sea['poster_path']) && $sea['poster_path']!='')
                    <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" class="w-10 h-12 mx-2 inline-block" src="{{'https://image.tmdb.org/t/p/w92' .$sea['poster_path'] }}" style="min-width:40px;">
                @else
                    <div class="flex justify-center items-center w-10 h-12 mx-2 bg-gray-200 text-black" style="min-width:40px;">{{substr($sea['title'],0,2)}}</div>
                @endif
            </a>
        @endif
            @if($sea['media_type'] == 'person')
                <a href="{{route('people.show', $sea['id'])}}" class="py-1 w-full align-top mr-2 text-gray-200 flex items-center">{{$sea['name']}}</a>
            @elseif($sea['media_type'] == 'movie')
                <a href="{{route('movie.show', $sea['id'])}}" class="py-1 w-full align-top mr-2 text-gray-200 flex items-center">{{$sea['title']}}</a>
            @else
                <a href="{{route('show.show', $sea['id'])}}" class="py-1 w-full align-top mr-2 text-gray-200 flex items-center">{{$sea['name']}}</a>
            @endif
    </li>
    @endforeach
</ul>