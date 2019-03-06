<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@index')->name('users');
Route::get('/users/{user_name}', 'UserController@detail');

Route::get('/competitions', 'CompetitionController@index')->name('competitions');
Route::view('/competitions/register', 'competitions.register')->name('competition_register')->middleware('auth');
Route::get('/competitions/{title}', 'CompetitionController@detail');
Route::get('/competitions/{title}/results', 'CompetitionController@results');
Route::post('/competitions/{title}/results', 'EvaluationController@index');


