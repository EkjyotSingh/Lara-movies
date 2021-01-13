<div class="grid grid-cols-1 xs:grid-cols-2 place-items-center sm:grid-cols-3 xl:grid-cols-4 gap-x-0 gap-y-4 xxs:gap-4 md:gap-4 lg:gap-12 xl:gap-8">
    @foreach($images as $image)
        <div class="w-full">
            <img onerror="this.onerror=null;this.src='{{asset('img/no-img.jpg')}}';" src="{{'https://image.tmdb.org/t/p/w780' .$image['file_path']}}" class="h-48 xs:h-40 lg:h-48 w-full"/>
        </div>
    @endforeach
</div>