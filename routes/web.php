<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\PeopleController;

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

Route::get('/',[MoviesController::class,'movies'])->name('movies.index');
Route::get('/movie/{id}',[MoviesController::class,'show'])->name('movie.show');
Route::get('/peoples/{page?}',[PeopleController::class,'peoples'])->name('peoples');
Route::get('/people/{id}',[PeopleController::class,'people_show'])->name('people.show');


