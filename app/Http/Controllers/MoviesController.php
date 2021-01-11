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
        $moviedetails=Http::get('https://api.themoviedb.org/3/movie/'.$id.'?api_key=9a6878bd9c7e18164a0be276c2d30a3d&append_to_response=images,credits,videos,keywords')->json();
        $genres=Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=9a6878bd9c7e18164a0be276c2d30a3d')->json();
        $genre=collect($genres['genres'])->mapWithKeys(function($genre){
            return [$genre['id']=>$genre['name']];
        });
        //dd($moviedetails);
        return view('singlemovie')->with('moviedetails',$moviedetails)
                                    ->with('genres',$genre);
    }
    public function movie_search(Request $request){
        $search=Http::get('https://api.themoviedb.org/3/search/multi?api_key=9a6878bd9c7e18164a0be276c2d30a3d&query='.$request->input.'')->json();
        if(isset($search['results']) && count($search['results'])>0){
            $view=view('partialsearch')->with('search',collect($search['results'])->take(8))->render();
            return response()->json(['html'=>$view]);
        }else{
            return response()->json(['html'=>'<div class="absolute text-sm mt-1 w-full h-12 border border-gray-300 bg-gray-800 border_list text-gray-200 flex items-center justify-center">No results found for "'.$request->input.'"</div>']);
        }
        
    }
}
