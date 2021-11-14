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

// 日記一覧画面
Route::get('/diaries', 'DiaryController@index');

// 日記追加画面
Route::get('/diaries/create', 'DiaryController@create');
Route::post('/diaries/create', 'DiaryController@store');

// 日記編集画面
Route::get('/diaries/{id}/edit', 'DiaryController@edit');
Route::patch('/diaries/{id}', 'DiaryController@update');

// 日記削除
Route::get('/diaries/{id}', 'DiaryController@destroy');
