<?php

use Illuminate\Support\Facades\Config;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/hello-world', function () {
        return 'Hello world!';
});

// TODO:
// https://ithelp.ithome.com.tw/articles/10213865
Route::match(['get', 'post'], '/api/{action?}', function($action = null) {
    if (!isset($action)) return redirect(('/'));
    else {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode([
            'action' => $action,
            'name' => Config::get('app.name'),
            'time' => date("Y-m-d H:i:s")
        ]);
    }
});

Route::view('/{any}', 'index')->where('any', '.*');

// Route::get('/south/{id?}', function ($id = null) {
//     if (!isset($id)) return redirect('/');
//     else return 'baby';
// });

// Route::view('/welcome', 'welcome-by-view', ['name' => 'Taylor']);

// Route::redirect('/home', '/');
