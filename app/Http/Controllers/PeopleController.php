<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PeopleController extends Controller
{
    public function peoples($page=1){
        $peoples=Http::get('https://api.themoviedb.org/3/person/popular?page='.$page.'&api_key=9a6878bd9c7e18164a0be276c2d30a3d')->json();
        if(request()->ajax()){
            if(isset($peoples['errors'])){
                return response()->json(['error'=>'empty']);
            }else{
                $view = view('partial')->with('peoples',$peoples)->render();
                return response()->json(['html'=>$view]);
            }
        }else{
            return view('peoples')->with('peoples',$peoples);
        }
}
    public function people_show($id){
        $people=Http::get('https://api.themoviedb.org/3/person/'.$id.'?api_key=9a6878bd9c7e18164a0be276c2d30a3d&append_to_response=movie_credits,combined_credits,tv_credits,external_ids')->json();
        
        $crew_movie=collect($people['movie_credits']['crew'])->sortByDesc('release_date');
        $crew_tv=collect($people['tv_credits']['crew'])->sortByDesc('first_air_date');

        $cast_movie=collect($people['movie_credits']['cast'])->sortByDesc('release_date');
        $cast_tv=collect($people['tv_credits']['cast'])->sortByDesc('first_air_date');
        $known_for=collect($people['movie_credits']['cast'])->sortByDesc('popularity')->take(8);
        return view('singlepeople')->with('people',$people)
                                    ->with('cast_movies',$cast_movie)
                                    ->with('cast_tvs',$cast_tv)
                                    ->with('crew_movies',$crew_movie)
                                    ->with('crew_tvs',$crew_tv)
                                    ->with('known_fors',$known_for);



    }
}
