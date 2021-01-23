<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    
    public function movies($type=1){
        $genres=Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key='.config('app.api_key',''))->json();
        $genre=collect($genres['genres'])->mapWithKeys(function($genre){
            return [$genre['id']=>$genre['name']];
        });
        if($type==1){
            $popularmovies=Http::get('https://api.themoviedb.org/3/movie/popular?api_key='.config('app.api_key',''))->json();
            return view('movies')->with('popularmovies',$popularmovies['results'])
                                ->with('genres',$genre);
        }
        elseif($type==2){
            $topratedmovies=Http::get('https://api.themoviedb.org/3/movie/top_rated?api_key='.config('app.api_key',''))->json();
            //dd($popularmovies);
            $view = view('components.single-movie')->with('moviess',$topratedmovies['results'])->with('genres',$genre)->render();
            return response()->json(['html'=>$view]);

        }
        else{
            $nowplayingmovies=Http::get('https://api.themoviedb.org/3/movie/now_playing?api_key='.config('app.api_key',''))->json();
            $view = view('components.single-movie')->with('moviess',$nowplayingmovies['results'])->with('genres',$genre)->render();
            return response()->json(['html'=>$view]);
        }
    }

    public function show($id){
        $moviedetails=Http::get('https://api.themoviedb.org/3/movie/'.$id.'?api_key='.config('app.api_key','').'&append_to_response=credits,videos,keywords,recommendations,external_ids')->json();
        //dd($moviedetails);
        $languages=Http::get('https://api.themoviedb.org/3/configurapp.ation/languages?api_key='.config('app.api_key',''))->json();
        //dd($languages);
        $language=collect($languages)->where('iso_639_1',$moviedetails['original_language'])->first();
        return view('singlemovie')->with('moviedetails',$moviedetails)
                                    ->with('language',$language);
    }

    public function movie_images($id){
        $images=Http::get('https://api.themoviedb.org/3/movie/'.$id.'/images?api_key='.config('app.api_key',''))->json();
        //dd($images);
        $html=view('movie_images')->with('images',collect($images['backdrops'])->take(15))->render();
        return response()->json(['html'=>$html]);
    }

    /**       
         * Display a listing of the resource.
         *
         * @param  Illuminate\Http\Request $request
         * @return Response
         */
    public function search(Request $request){
        $search=Http::get('https://api.themoviedb.org/3/search/multi?api_key='.config('app.api_key','').'&query='.$request->search.'')->json();
    
        if(isset($search['results']) && count($search['results'])>0){
            if($request->ajax()){
                //ajax request
                $view=view('partialsearch')->with('search',collect($search['results'])->take(8))->render();
                return response()->json(['html'=>$view]);
            }else{
                //normal request
                return view('search_results')->with('results',$search['results']);
            }
        }else{
            return response()->json(['html'=>'<div class="absolute text-sm mt-1 w-full h-12 border border-gray-300 bg-gray-800 border_list text-gray-200 flex items-center justify-center">No results found for "'.$request->input.'"</div>']);
        }
        
    }
}
