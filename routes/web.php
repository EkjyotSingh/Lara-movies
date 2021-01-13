<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\TvshowsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/movie/{type}',[MoviesController::class,'show'])->name('movie.show');
Route::get('/movie/images/{id}',[MoviesController::class,'movie_images'])->name('movie.images');

Route::get('/peoples/{page?}',[PeopleController::class,'peoples'])->name('peoples');
Route::get('/people/{id}',[PeopleController::class,'people_show'])->name('people.show');

Route::get('/search',[MoviesController::class,'search'])->name('search');

Route::get('/tv-shows/{page?}',[TvshowsController::class,'index'])->name('shows.index');
Route::get('/show/{id}',[TvshowsController::class,'show'])->name('show.show');

Route::get('/episode/images',[TvshowsController::class,'single_episode_images'])->name('episode.single.images');

Route::get('/show/{id}/season/{season_no}',[TvshowsController::class,'single_season'])->name('season.single');

Route::get('/show/{id}/all-seasons',[TvshowsController::class,'all_seasons'])->name('all.seasons');

Route::get('/show/{id}/full-cast-&-crew',[TvshowsController::class,'aggregate_credits'])->name('cast.crew');

Route::get('/keyword/{keyword_id}/tv',[TvshowsController::class,'keyword_tv'])->name('tv.keyword');
Route::get('/keyword/{keyword_id}/movie',[TvshowsController::class,'keyword_movie'])->name('movie.keyword');

Route::get('/{page?}',[MoviesController::class,'movies'])->name('movies.index');
