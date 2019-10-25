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
    return view('buscaaberta/busca');
});

Route::resource('/busca','BuscaController');
Route::get('busca-resultado',['uses'=> 'BuscaController@buscaLivro', 'as' =>'buscaLivro']);
Route::get('/busca-avancada',['uses'=> 'BuscaController@buscaAvancada', 'as' =>'buscaAvancada']);
Route::get('busca-resultado-avancado',['uses'=> 'BuscaController@buscaAvancadaLivro', 'as' =>'buscaAvancadaLivro']);

Route::get('/busca-avancada-externo',['uses'=> 'BuscaController@buscaExterna', 'as' =>'buscaAvancada']);


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});