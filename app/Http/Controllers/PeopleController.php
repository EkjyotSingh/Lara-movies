<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PeopleController extends Controller
{
    public function peoples($page=1){
        $peoples=Http::get('https://api.themoviedb.org/3/person/popular?page='.$page.'&api_key='.config('app.api_key',''))->json();
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
        $people=Http::get('https://api.themoviedb.org/3/person/'.$id.'?api_key='.config('app.api_key','').'&append_to_response=movie_credits,tv_credits,external_ids,combined_credits')->json();    
        $known_for=collect($people['combined_credits']['cast'])->sortByDesc('popularity')->take(8);
        $departments=array('Art','Camera','Costume & Make-Up','Crew','Directing','Editing','Production','Sound','Visual Effects','Writing');
        //dd($known_for);
        return view('singlepeople')->with('people',$people)
                                    ->with('known_fors',$known_for)
                                    ->with('departments',$departments);
    }
}
