@extends('layouts.app')
@section('content')
<div class="container mx-auto pt-14 px-2 lg:px-6 text-gray-200">
    <h1 class="uppercase text-xl font-bold text-yellow-500 mb-10 text-center xxs:text-left">Popular People</h1>
    <div class=" loadmore w-44 mx-auto xxs:mx-0 xxs:w-full grid justify-items-center grid-cols-1 xxs:grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-x-3 xs:gap-x-6 xl:gap-x-12">
        @include('partial')
    </div>
</div>
<div class="loadmore_loader pt-8 flex justify-center" style="opacity:0;min-height:100px;"></div>
@endsection
@section('script')
    <script>
            let page =2;
            let currentscrollHeight=0;
            let lockScroll= false;
            $(document).scroll(function(){
            let scrollHeight = $(document).height();
            let scrollPos = Math.floor($(window).height() + $(window).scrollTop());
            let isBottom = scrollHeight - 600 < scrollPos

            if (isBottom && currentscrollHeight < scrollHeight) {
                console.log(scrollHeight,scrollPos)
                $('.loadmore_loader').html(`<svg class=" icon icon-spinner3  fill-current text-gray-200 h-10 w-10 animate-spin"><use xlink:href="{{asset('img/sprite.svg#icon-spinner3')}}"></use></svg>`);
                $('.loadmore_loader').css('opacity','1');
                console.log('yes')
                $.ajax({
                url:`{{route('peoples')}}/${page}`,
                type:'get',
                success:function(data){
                    if(data.error =='empty'){
                        $('.loadmore_loader').html('<div class="text-xl text-gray-200">No More Data!</div>');
                        $('.loadmore_loader').css('opacity','1');
                    }else{
                         $('.loadmore_loader').css('opacity','0');
                        $('.loadmore').append(data.html);
                        page++;
                    }
                }
            })
                currentscrollHeight = scrollHeight
            }
        })
    </script>
@endsection