<div class="flex flex-nowrap space-x-4">
    @foreach($images['stills'] as $image)
        <div class="mb-2 min-w-max">
            @if(isset($image['file_path']) && $image['file_path']!=null)
                <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" src="{{'https://image.tmdb.org/t/p/w300' .$image['file_path']}}" class="w-56 h-32 shadow-lg"/>
            @else
                <img class="w-56 h-32 shadow-lg" src="{{asset('img/no-img.jpg')}}"/>
            @endif
        </div>
    @endforeach
</div>