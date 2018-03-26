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

Route::get('/search/article', [
    'as' => 'api.search',
    'uses' => 'Api\SearchController@searchArticles'
]);

Route::get('/search/gallery', [
    'as' => 'api.search',
    'uses' => 'Api\SearchController@searchGalleries'
]);

Route::get('/city/ajax-province',function(Request $request)
{
});
Route::get('city/{code}/province.json', function($code)
{
    $province = Indonesia::findProvince($code, ['cities']);
    $cities = $province->cities;
    return $cities;
});
