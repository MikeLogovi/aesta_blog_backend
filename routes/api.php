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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/articles/html_editor/{id}','ArticleController@setHtmlCode')->name('article.html_editor_api');
Route::get('/articles/html_editor/{id}','ArticleController@getJsonCode')->name('article.json_code_api');
