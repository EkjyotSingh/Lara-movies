@extends('layouts.app')
@section('content')

<div class=" container mx-auto py-14 px-2 lg:px-6">

    <h1 class="uppercase text-xl font-bold text-yellow-500 mb-10 text-center xxs:text-left">Top Rated movies</h1>
    {{--<div class="w-44 mx-auto xxs:mx-0 xxs:w-full grid border-b border-gray-600 grid-cols-1 xxs:grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-x-0 xxs:gap-x-3 xs:gap-x-6 xl:gap-x-12 justify-items-center">
        @foreach($topratedmovies as $movie)--}}
            <x-single-movie :moviess="$topratedmovies" :genres="$genres"/>
        {{--@endforeach
    </div>--}}

    <h1 class="uppercase text-xl font-bold text-yellow-500 my-10 text-center xxs:text-left">popular movies</h1>
    <div class="popular_container">
        <div class="loadmore_loader1 pt-8 flex justify-center" style="min-height:100px;">
            <svg class=" icon icon-spinner3  fill-current text-gray-200 h-10 w-10 animate-spin"><use xlink:href="{{asset('img/sprite.svg#icon-spinner3')}}"></use></svg>
        </div>

        {{--<div class="w-44 mx-auto xxs:mx-0 xxs:w-full grid justify-items-center border-b border-gray-600 grid-cols-1 xxs:grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-x-0 xxs:gap-x-3 xs:gap-x-6 xl:gap-x-12 popular">
            @foreach($popularmovies as $movie)
                <x-single-movie :movie="$movie" :genres="$genres"/>
            @endforeach
        </div>--}}
    </div>



    <h1 class="uppercase text-xl font-bold text-yellow-500 my-10 text-center xxs:text-left">now playing movies</h1>
    <div class="now_playing_container">
        <div class="loadmore_loader2 pt-8 flex justify-center" style="min-height:100px;">
            <svg class=" icon icon-spinner3  fill-current text-gray-200 h-10 w-10 animate-spin"><use xlink:href="{{asset('img/sprite.svg#icon-spinner3')}}"></use></svg>
        </div>

        {{--<div class="w-44 mx-auto xxs:mx-0 xxs:w-full grid justify-items-center  grid-cols-1 xxs:grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-x-0 xxs:gap-x-3 xs:gap-x-6 xl:gap-x-12 now_playing">
            @foreach($nowplayingmovies as $movie)
                <x-single-movie :movie="$movie" :genres="$genres"/>
            @endforeach
        </div>--}}
    </div>
</div>
@endsection

@section('script')
    <script>
            let page =2;
            let total_pages=3;
            let currentscrollHeight=0;
            let lockScroll= false;
            $(document).scroll(function(){
            let scrollHeight = $(document).height();
            let scrollPos = Math.floor($(window).height() + $(window).scrollTop());
            let isBottom = scrollHeight - 1000 < scrollPos

            if (isBottom && currentscrollHeight < scrollHeight && page<=total_pages) {
                console.log(scrollHeight,scrollPos)
                console.log('yes')
                $.ajax({
                url:`{{route('movies.index')}}/${page}`,
                type:'get',
                success:function(data){
                        if(page==2){
                            $('.loadmore_loader1').remove();
                            $('.popular_container').append(data.html);
                        }
                        else{
                            $('.loadmore_loader2').remove();
                            $('.now_playing_container').append(data.html);
                        }
                        page++;
                }
            })
                currentscrollHeight = scrollHeight
            }
        })
    </script>
@endsection