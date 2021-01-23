<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvshowsController extends Controller
{
    public function index($type=1){
        $genres=Http::get('https://api.themoviedb.org/3/genre/tv/list?api_key='.config('api_key',''))->json();
        $genres=collect($genres['genres'])->mapwithkeys(function($genres){
            return [$genres['id']=>$genres['name']];
        });

        if($type==1){
            $popularshows=Http::get('https://api.themoviedb.org/3/tv/popular?api_key='.config('api_key',''))->json();
            return view('tvshows')->with('show',$popularshows['results'])
                                    ->with('genres',$genres);
        }
        elseif($type==2){
            $topratedshows=Http::get('https://api.themoviedb.org/3/tv/top_rated?api_key='.config('api_key',''))->json();
            $view = view('components.single-show')->with('showss',$topratedshows['results'])->with('genres',$genres)->render();
            return response()->json(['html'=>$view]);

        }
        else{
            $ontheairshows=Http::get('https://api.themoviedb.org/3/tv/on_the_air?api_key='.config('api_key',''))->json();
            $view = view('components.single-show')->with('showss',$ontheairshows['results'])->with('genres',$genres)->render();
            return response()->json(['html'=>$view]);
        }
    }
    public function show($show_id){
        $show=Http::get('https://api.themoviedb.org/3/tv/'.$show_id.'?api_key='.config('api_key','').'&append_to_response=aggregate_credits,recommendations,external_ids,keywords,videos')->json();
        //dd($show);
        $languages=Http::get('https://api.themoviedb.org/3/configuration/languages?api_key='.config('api_key',''))->json();
        $language=collect($languages)->where('iso_639_1',$show['original_language'])->first();
        return view('single_show')->with('show',$show)
                                    ->with('language',$language['english_name']);
    }

    public function single_season($show_id,$season_no){
        $season=Http::get('https://api.themoviedb.org/3/tv/'.$show_id.'/season/'.$season_no.'?api_key='.config('api_key','').'&append_to_response=images')->json();
        //dd($season);
        return view('single_season')->with('season',$season)
                                    ->with('show_id',$show_id);
    }

    public function single_episode_images(){
        $images=Http::get('https://api.themoviedb.org/3/tv/'.request()->show_id.'/season/'.request()->season_no.'/episode/'.request()->episode_no.'/images?api_key='.config('api_key',''))->json();
        //dd($images);
        $html= view('episode_images')->with('images',collect($images)->take(7))->render();
        return response()->json(['html'=>$html]);
    }

    public function all_seasons($show_id){
        $seasons=Http::get('https://api.themoviedb.org/3/tv/'.$show_id.'?api_key='.config('api_key',''))->json();
        return view('all_seasons')->with('seasons',$seasons);
    }

    public function aggregate_credits($show_id){
        $aggregate_credit=Http::get('https://api.themoviedb.org/3/tv/'.$show_id.'?api_key='.config('api_key','').'&append_to_response=aggregate_credits')->json();
        $departments=array('Art','Camera','Costume & Make-Up','Crew','Directing','Editing','Production','Sound','Visual Effects','Writing');
        return view('cast_crew')->with('aggregate_credit',$aggregate_credit)
                                ->with('departments',$departments);
    }

    public function keyword_tv($keyword_id){
        $keywords=Http::get('https://api.themoviedb.org/3/discover/tv?api_key='.config('api_key','').'&with_keywords='.$keyword_id)->json();
        //dd($keywords);
        return view('search_results')->with('results',$keywords['results']);
    }

    public function keyword_movie($keyword_id){
        $keywords=Http::get('https://api.themoviedb.org/3/discover/movie?api_key='.config('api_key','').'&with_keywords='.$keyword_id)->json();
        //dd($keywords);
        return view('search_results')->with('results',$keywords['results']);
    }
}
