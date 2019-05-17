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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index')->name('home');

// Route::get('popularBancoDeDados', 'HomeController@popular');

Route::group(['prefix' => 'post'], function (){
    Route::get('listar', 'PostController@listar');
    Route::get('listarPorTema/{theme_id}', 'PostController@listarPorTema');
    Route::post('listarPorNome', 'PostController@listarPorNome');
    Route::get('cadastrar', 'PostController@cadastrar');
    Route::post('cadastrar', 'PostController@store')->middleware('auth');
    Route::delete('apagar/{id}', 'PostController@delete')->middleware('auth');
});

Route::group(['prefix' => 'resposta'], function () {
    Route::get('listar', 'AnswerController@listar');
    Route::post('cadastrar', 'AnswerController@store')->middleware('auth');
});

Route::group(['prefix' => 'tema'], function (){
    Route::get('listar', 'ThemeController@listar');
    Route::post('listarPorNome', 'ThemeController@listarPorNome');
    Route::get('cadastrar', 'ThemeController@cadastrar');
    Route::post('cadastrar', 'ThemeController@store')->middleware('auth');
    Route::get('atualizar/{id}', 'ThemeController@atualizar');
    Route::put('atualizar/{id}', 'ThemeController@update')->middleware('auth');;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
