<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased bg-gray-800">
        <div class="h-22 md:h-20 border-b border-gray-500 bg-gray-700 py-2">
            <div class="container mx-auto h-full flex-col md:flex-row md:flex md:justify-between px-2 lg:px-6">
                <ul class="flex-col sm:flex-row flex justify-center  items-center text-gray-200 ">
                    <a href="{{route('movies.index')}}" class="mr-0 sm:mr-8 lg:mr-16 font-bold xl:font-extrabold text-lg md:text-xl lg:text-2xl hover:text-yellow-500">
                        <li class="flex items-center space-x-2">
                            <svg class="icon icon-video-camera fill-current w-6 h-6 lg:w-8 lg:h-8">
                                <use xlink:href="{{asset('img/sprite.svg#icon-video-camera')}}"></use>
                            </svg>
                            <span class="whitespace-nowrap">Laravel Movies</span>
                        </li>
                    </a>
                    <a href="{{route('movies.index')}}" class="mr-0 sm:mr-6 hover:text-yellow-500 text-md"><li>Movies</li></a>
                    <a href="" class="mr-0 sm:mr-6 hover:text-yellow-500 text-md"><li>Shows</li></a>
                    <a href="{{route('peoples')}}" class="hover:text-yellow-500 text-md"><li>People</li></a>
                </ul>
                <ul class="flex-col sm:flex-row flex items-center justify-center items-center mt-1 md:mt-0">
                    <li class="mr-0 mb-2 sm:mb-0 sm:mr-4 lg:mr-8 relative">
                        <input type="text" placeholder="Search Movies" class=" px-8 rounded-2xl focus:outline-none border-2 border-indigo-400 ">
                        <svg class="icon icon-search fill-current w-4 h-4 text-gray-400 absolute top-1.5 left-2">
                            <use xlink:href="{{asset('img/sprite.svg#icon-search')}}"></use>
                        </svg>
                    </li>
                    <li>
                        <img src="{{asset('img/php.jpg')}}" class="w-10 h-10 rounded-full"/>
                    </li>
                </ul>
            </div>
        </div>
        
@yield('content')
        
    </body>
</html>