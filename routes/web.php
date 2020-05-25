<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', 'HomeController@index')->name('home');

Route::get('vue', function() {
    return view('vue');
});

Route::match(['get', 'post'], 'api', function () {
    return [];
});

/**
 * 此宣告作法會同時宣告七個路徑
 * ---------------------------------------------------------
 * 動作         網址                對應函式名稱    route 名稱
 * ---------------------------------------------------------
 * GET         /posts              index         posts.index
 * GET         /posts/create       create        posts.create
 * POST        /posts              store         posts.store
 * GET         /posts/{post}       show          posts.show
 * GET         /posts/{post}/edit  edit          posts.edit
 * PUT/PATCH   /posts/{post}       update        posts.update
 * DELETE      /posts/{post}       destroy       posts.destroy
 */
Route::resource('posts', 'PostController');