<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    
    public function movies(){
        $popularmovies=Http::get('https://api.themoviedb.org/3/movie/popular?api_key=9a6878bd9c7e18164a0be276c2d30a3d')->json();
        $nowplayingmovies=Http::get('https://api.themoviedb.org/3/movie/now_playing?api_key=9a6878bd9c7e18164a0be276c2d30a3d')->json();
        $topratedmovies=Http::get('https://api.themoviedb.org/3/movie/top_rated?api_key=9a6878bd9c7e18164a0be276c2d30a3d')->json();

        $genres=Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=9a6878bd9c7e18164a0be276c2d30a3d')->json();
        $genre=collect($genres['genres'])->mapWithKeys(function($genre){
            return [$genre['id']=>$genre['name']];
        });
        
        return view('movies')->with('popularmovies',$popularmovies['results'])
                            ->with('nowplayingmovies',$nowplayingmovies['results'])
                            ->with('topratedmovies',$topratedmovies['results'])
                            ->with('genres',$genre);
    }

    public function show($id){
        $moviedetails=Http::get('https://api.themoviedb.org/3/movie/'.$id.'?api_key=9a6878bd9c7e18164a0be276c2d30a3d&append_to_response=images,credits,videos')->json();
        $genres=Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=9a6878bd9c7e18164a0be276c2d30a3d')->json();
        $genre=collect($genres['genres'])->mapWithKeys(function($genre){
            return [$genre['id']=>$genre['name']];
        });
        //dd($moviedetails['images']['backdrops']);
        return view('singlemovie')->with('moviedetails',$moviedetails)
                                    ->with('genres',$genre);
    }
}
