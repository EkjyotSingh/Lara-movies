@extends('layouts.app')
@section('content')

<div class=" container mx-auto py-14 px-2 lg:px-6">

    <h1 class="uppercase text-xl font-bold text-yellow-500 mb-10 text-center xxs:text-left">Top Rated movies</h1>
    <x-single-movie :moviess="$topratedmovies" :genres="$genres"/>

    <h1 class="uppercase text-xl font-bold text-yellow-500 my-10 text-center xxs:text-left">popular movies</h1>
    <div class="popular_container">
        <div class="loadmore_loader pt-8 flex justify-center" style="min-height:100px;">
            <svg class=" icon icon-spinner3  fill-current text-gray-200 h-10 w-10 animate-spin"><use xlink:href="{{asset('img/sprite.svg#icon-spinner3')}}"></use></svg>
        </div>
    </div>

    <h1 class="uppercase text-xl font-bold text-yellow-500 my-10 text-center xxs:text-left">now playing movies</h1>
    <div class="now_playing_container">
        <div class="loadmore_loader pt-8 flex justify-center" style="min-height:100px;">
            <svg class=" icon icon-spinner3  fill-current text-gray-200 h-10 w-10 animate-spin"><use xlink:href="{{asset('img/sprite.svg#icon-spinner3')}}"></use></svg>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
            let type =2;
            let total_pages=3;
            let currentscrollHeight=0;
            let lockScroll= false;
            $(document).scroll(function(){
            let scrollHeight = $(document).height();
            let scrollPos = Math.floor($(window).height() + $(window).scrollTop());
            let isBottom = scrollHeight - 1400 < scrollPos

            if (isBottom && currentscrollHeight < scrollHeight && type<=total_pages) {
                $.ajax({
                url:`{{route('movies.index')}}/${type}`,
                type:'get',
                success:function(data){
                        if(type==2){
                            $('.popular_container').html(data.html);
                        }
                        else{
                            $('.now_playing_container').html(data.html);
                        }
                        type++;
                }
            })
                currentscrollHeight = scrollHeight
            }
        })
    </script>
@endsection