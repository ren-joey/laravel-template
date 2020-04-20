<?php

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

Route::view('/', 'index')->where('any', '.*');

// Route::get('/south/{id?}', function ($id = null) {
//     if (!isset($id)) return redirect('/');
//     else return 'baby';
// });

// Route::view('/welcome', 'welcome-by-view', ['name' => 'Taylor']);

// Route::redirect('/home', '/');
