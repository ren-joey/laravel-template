<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Auth
Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user-detail', 'Api\AuthController@userDetail');
});

// Data
Route::apiResource('animal', 'AnimalController')->parameters([
    'my-animal' => 'animal' // 使用 kas 來取代 animal model 名稱
])->names([
    // 'animals' => 'my-animal.index' // 修改 route 名稱，沒有用
])->only([
    'index', 'store', 'destroy', 'update'
]);
Route::apiResource('type', 'TypeController');

Route::get('check-login', function () {
    return response([
        'is_login' => Auth::check() ? 'Y' : 'N'
    ], Response::HTTP_OK);
});

Route::fallback(function() {
    // response()
});