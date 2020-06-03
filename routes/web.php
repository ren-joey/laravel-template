<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

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

/**
 * 測試 binding 時使用
 * https://stackoverflow.com/questions/49348681/what-is-a-usage-and-purpose-of-laravels-binding
 */
Route::get('foo', function (App\Foo $foo) {
    return $foo->hello();
});
Route::get('pay', function (App\PaymentInterface $payment) {
    return $payment->pay();
});
Route::get('test', function () {
    // $bindings 中的綁定每次都返回新的類別
    echo app('bindTestClass')->increase();
    echo app('bindTestClass')->increase();
    echo app('bindTestClass')->increase();

    // $singletons 中綁定的物件只會實例化一次，所有參數都會一直保留
    echo app('singletonTestClass')->increase();
    echo app('singletonTestClass')->increase();
    echo app('singletonTestClass')->increase();
});

/**
 * 測試 Facades 使用
 * https://laravel.com/docs/7.x/facades#introduction
 */
Route::get('cache', function() {
    return Cache::get('key');
});

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