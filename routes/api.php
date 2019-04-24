<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('school','School\SchoolController@store');
Route::get('school','School\SchoolController@index');
Route::post('school/{id}','School\SchoolController@update');
Route::get('school/{id}','School\SchoolController@show');
Route::delete('school/{id}', 'School\SchoolController@destroy');
Route::post('school/search/result', 'School\SchoolController@search');

Route::get('alat','AlatController@index');
Route::post('alat','AlatController@store');
Route::post('alat/search/result', 'AlatController@search');