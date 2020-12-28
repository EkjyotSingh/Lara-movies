<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PeopleController extends Controller
{
    public function peoples(){
        $peoples=Http::get('https://api.themoviedb.org/3/person/popular?api_key=9a6878bd9c7e18164a0be276c2d30a3d')->json();
        
        //dd($peoples['results'][0]['known_for']);
        return view('peoples')->with('peoples',$peoples['results']);
    }


    public function people_show($id){
        $peoples=Http::get('https://api.themoviedb.org/3/person/'.$id.'?api_key=9a6878bd9c7e18164a0be276c2d30a3d')->json();
        
        dd($peoples);
        return view('peoples')->with('peoples',$peoples['results']);
    }
}
