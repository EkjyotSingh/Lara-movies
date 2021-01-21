@extends('layouts.app')
@section('content')

<div class=" container mx-auto py-14 px-2 lg:px-6">

    <h1 class="uppercase text-xl font-bold text-yellow-500 mb-10 text-center xxs:text-left">Popular Shows</h1>
    <x-single-show :showss="$show" :genres="$genres"/>

    <h1 class="uppercase text-xl border-t border-gray-600 font-bold text-yellow-500 py-10 text-center xxs:text-left">Top Rated Shows</h1>
    <div class="top_rated_container">
        <div class="loadmore_loader pt-8 flex justify-center" style="min-height:100px;">
            <svg class=" icon icon-spinner3  fill-current text-gray-200 h-10 w-10 animate-spin"><use xlink:href="{{asset('img/sprite.svg#icon-spinner3')}}"></use></svg>
        </div>
    </div>



    <h1 class="uppercase text-xl  border-t border-gray-600 font-bold text-yellow-500 py-10 text-center xxs:text-left">tv shows airing today</h1>
    <div class="on_air_container">
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
                url:`{{route('shows.index')}}/${type}`,
                type:'get',
                success:function(data){
                        if(type==2){
                            $('.top_rated_container').html(data.html);
                        }
                        else{
                            $('.on_air_container').html(data.html);
                        }
                        type++;
                }
            })
                currentscrollHeight = scrollHeight
            }
        })
    </script>
@endsection