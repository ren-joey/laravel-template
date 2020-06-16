<?php

use App\Animal;
use App\Http\Controllers\folderController\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

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
Route::get('bind', function () {
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
Route::get('facade', function() {
    // return Cache::get('key');
});

/**
 * 測試 Route
 */
Route::get('view/3/{id?}', function ($id = 0) {
    return $id;
}); // app/Providers/RouteServiceProvider.php 中強制綁定 $id 的 pattern 為 [0-9]
Route::get('view/2/{test?}', function ($test = 0) {
    return view('test', ['test' => $test]);
})->where(['test' => '[0-9]+']);
Route::get('view/{test?}', function ($test = 'good') {
    return view('test', ['test' => $test]);
});
Route::view('view', 'test', ['test' => 'good'])->name('test'); // 將 route 命名
Route::get('name/{name}', function ($name) {
    return redirect()->route($name);
});
// Route::get('view/{test}', function ($test) {
//     return view('test', ['test' => $test]);
// });
// Route 批次共用同一個中介層(middleware)
// 未測試
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second Middleware
    });

    Route::get('user/profile', function () {
        // Uses first & second Middleware
    });
});
// 另一個 Group 方法，運用 namespace
// 未測試
Route::namespace('Admin')->group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
});
// Subdomain Routing
// 未成功
Route::domain('{domain}')->group(function () {
    Route::get('domain', function ($domain) {
        echo $domain;
    });
});
// Route Name Prefixes
// return redirect()->route('admin.users');
Route::name('admin.')->group(function () {
    Route::get('users', function () {
        echo 'users';
    })->name('users');
});
Route::get('animal/{animal}', function (Animal $animal) {
    return response($animal, Response::HTTP_OK);
});

/**
 * 測試 middleware
 */
// Route::middleware('check.age')->get('age', function () {
//     $age = Request::input('age') ?: 0;
//     return "your age is {$age}";
// });
Route::get('age', function () {
    $age = Request::input('age') ?: 0;
    return "your age is {$age}";
})->middleware('check.age');

/**
 * 測試 Controller
 */
Route::get('controller/{name?}', 'TestController@get');
Route::get('folder-controller/{name?}', 'FolderController\TestController@get');
Route::get('invoke/{name?}', 'TestController'); // 使用 __invoke 函式，不需傳入@指定即可自動取用
Route::get('redirect', 'TestController@redirect');

/**
 * 測試Request
 */
Route::get('query', 'TestController@query')->name('query');
Route::get('boolean', 'TestController@boolean');
Route::get('flash', 'TestController@flash');
Route::get('cookie', 'TestController@cookie');
Route::get('bag', 'TestController@bag');

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