<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
        {{--<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">--}}
        <!-- Styles -->
        <style>
            @font-face {
                font-family: 'nunitosemibold';
                src: url('{{asset('fonts/Nunito/nunito-semibold-webfont.woff2')}}') format('woff2'),
                    url('{{asset('fonts/Nunito/nunito-semibold-webfont.woff')}}') format('woff');
                font-weight: normal;
                font-style: normal;
            }
            @font-face {
                font-family: 'nunitoblack';
                src: url('{{asset('fonts/Nunito/nunito-black-webfont.woff2')}}') format('woff2'),
                    url('{{asset('fonts/Nunito/nunito-black-webfont.woff')}}') format('woff');
                font-weight: normal;
                font-style: normal;
            }
            @font-face {
                font-family: 'nunitoextrabold';
                src: url('{{asset('fonts/Nunito/nunito-extrabold-webfont.woff2')}}') format('woff2'),
                    url('{{asset('fonts/Nunito/nunito-extrabold-webfont.woff')}}') format('woff');
                font-weight: normal;
                font-style: normal;

            }
            @font-face {
                font-family: 'nunitobold';
                src: url('{{asset('fonts/Nunito/nunito-bold-webfont.woff2')}}') format('woff2'),
                    url('{{asset('fonts/Nunito/nunito-bold-webfont.woff')}}') format('woff');
                font-weight: normal;
                font-style: normal;
            }
            @font-face {
                font-family: 'nunitoextralight';
                src: url('{{asset('fonts/Nunito/nunito-extralight-webfont.woff2')}}') format('woff2'),
                    url('{{asset('fonts/Nunito/nunito-extralight-webfont.woff')}}') format('woff');
                font-weight: normal;
                font-style: normal;

            }
            @font-face {
                font-family: 'nunitolight';
                src: url('{{asset('fonts/Nunito/nunito-light-webfont.woff2')}}') format('woff2'),
                    url('{{asset('fonts/Nunito/nunito-light-webfont.woff')}}') format('woff');
                font-weight: normal;
                font-style: normal;

            }
            @font-face {
                font-family: 'nunitoregular';
                src: url('{{asset('fonts/Nunito/nunito-regular-webfont.woff2')}}') format('woff2'),
                    url('{{asset('fonts/Nunito/nunito-regular-webfont.woff')}}') format('woff');
                font-weight: normal;
                font-style: normal;

            }
            :root{
            font-family: 'nunitoregular';
            }
            h2{
                font-family:'nunitobold';
            }
            h3{
                font-family:'nunitosemibold';
            }
            h1{
                font-family:'nunitobold';
            }
            h4{
                font-family:'nunitoblack';
            }
        </style>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/my.css')}}">
    </head>
    <body class="antialiased bg-gray-800">
        <div class="h-22 md:h-20 border-b border-gray-500 bg-gray-700 py-2">
            <div class="container mx-auto h-full flex-col md:flex-row md:flex md:justify-between px-2 lg:px-6">
                <ul class="flex-col sm:flex-row flex justify-center  items-center text-gray-200 ">
                    <li class="">
                        <a href="{{route('movies.index')}}" class="mr-0 sm:mr-8 lg:mr-16 font-bold xl:font-extrabold text-lg md:text-xl lg:text-2xl hover:text-yellow-500 flex items-center space-x-2">
                            <svg class="icon icon-video-camera fill-current w-6 h-6 lg:w-8 lg:h-8">
                                <use xlink:href="{{asset('img/sprite.svg#icon-video-camera')}}"></use>
                            </svg>
                            <span class="whitespace-nowrap flex items-center "style="font-family:'nunitoextrabold';">Laravel Movies</span>
                        </a>
                    </li>
                    <a href="{{route('movies.index')}}" class="mr-0 sm:mr-6 hover:text-yellow-500 text-md"><li>Movies</li></a>
                    <a href="{{route('shows.index')}}" class="mr-0 sm:mr-6 hover:text-yellow-500 text-md"><li>Tv Shows</li></a>
                    <a href="{{route('peoples')}}" class="hover:text-yellow-500 text-md"><li>People</li></a>
                </ul>
                <ul class="flex-col sm:flex-row flex items-center justify-center items-center mt-1 md:mt-0">
                    <li class="mr-0 mb-1 sm:mb-0 sm:mr-4 lg:mr-8 relative search_append">
                        <input type="text" placeholder="Search" class="text-sm px-8 rounded-2xl focus:outline-none border-2 border-indigo-400 search_input h-6 w-56">
                        <svg class="icon icon-search fill-current w-4 h-4 text-gray-400 absolute left-1.5" style="top:5px;">
                            <use xlink:href="{{asset('img/sprite.svg#icon-search')}}"></use>
                        </svg>
                        <svg class="search_spinner absolute top-1.5 right-1.5" width="15px" height="15px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                            <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                        </svg>
                    </li>
                    <script>
                        $('.search_spinner').hide();
                    </script>
                    <li>
                        <img src="{{asset('img/php.jpg')}}" class="w-10 h-10 rounded-full"/>
                    </li>
                </ul>
            </div>
        </div>
        <a class="fixed bottom-12 right-6 sm:right-12 back transition-all transform translate-y-28" onclick="to_top()">
            <svg class="icon icon-circle-up h-8 w-8 fill-current text-white hover:text-yellow-500"><use xlink:href="{{asset('img/sprite.svg#icon-circle-up')}}"></use></svg>
        </a>
        
        @yield('content')
        @yield('script')
        <script>
            function to_top(){
                $('html').scrollTop(0)
            }
            $(document).scroll(function(){
                if($(document).scrollTop() > $(window).height()){
                    $('.back').removeClass('translate-y-28');
                    $('.back').addClass('translate-y-0');
                }
                else{
                    $('.back').addClass('translate-y-28');
                    $('.back').removeClass('translate-y-0');
                }
            })
            function search(){
                let input=$('.search_input').val();
                if(input.length >2 && input!=''){
                    $('.border_list').remove();
                        $.ajax({
                            url:`{{route('search')}}`,
                            type:'get',
                            data:`input=${input}`,
                            success:function(response){
                                $('.search_spinner').hide();
                                $('.search_append').append(response.html);
                            }
                        })
                }
                else{
                    $('.search_spinner').hide();
                    $('.border_list').remove();
                }
            }
            let timerId;
            function throttle(func,delay){
                if(timerId){
                    return;
                }
                timerId=setTimeout(function(){
                    $('.search_spinner').show();
                    func()
                    timerId=undefined;
                },delay)
            }

            $('.search_input').on('input focus',function(){
                throttle(search,1000);
            })
            
            $('.search_input').blur(function(){
                setTimeout(function(){
                    $('.border_list').remove();
                },200)
            })
        </script>
    </body>
</html>
