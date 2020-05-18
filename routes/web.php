<?php
// https://ithelp.ithome.com.tw/articles/10213865
// https://ithelp.ithome.com.tw/articles/10215152

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
    return view('hello-world');
});

Route::get('/about-us/{name?}', function ($name = '未知') {
    return view('about-us', [
        'name' => $name,
        'records' => array(1, 2),
        'users' => array(
            ['id' => '0001'],
            ['id' => '0002']
        )
    ]);
});

Route::get('/inspire', 'InspireController@inspire');

Route::get('/posts', function() {
    return App\Post::cursor();
});

Route::get('/tags', function() {
    $tagnames = ['科技', 'PHP', 'IT', '後端', '財經', '社會', '交通'];

    foreach($tagnames as $key => $tagname) {
        $count = App\Tag::where('tagname', '=', $tagname)->take(1)->count();
        if ($count === 0) {
            $tag = new App\Tag;
            $tag->tagname = $tagname;
            $tag->save();
        }
    }

    $posts = App\Post::all();
    $tags = App\Tag::all();
    $tags_id = array_map(function($tag) {
        return $tag['id'];
    }, $tags->toArray());
    foreach($posts as $key => $post) {
        $idx = rand(0, count($tags_id));

        if (count($post->tags) === 0) {
            $post->tags()->attach(App\Tag::find($idx));
        }
    }

    return App\Post::find(2)->tags;
});

Route::get('/test', function() {
    // 瀏覽
    // $post = App\Post::all();
    $subject = App\Subject::cursor();

    if (count($subject) === 0) {
        $subject = new App\Subject;
        $subject->title = 'Laravel 6.0 初體驗！怎麼用最新的 laravel 架網站！';
        $subject->save();
    } else {
        $subject = App\Subject::find(1);
    }

    // 查找
    // $post = App\Post::find(1);

    // 編輯
    // $post->content = 'Laravel demo 6.0 day 11';
    // $post->save();

    // 多筆編輯
    // $post->each->update([
    //     'content' => date('Y-m-d H:i:s')
    // ]);

    // 新增
    // $post = new App\Post;
    // $post->content = 'Laravel demo 6.0 day 11';
    // $post->save();

    // 刪除
    // $post->delete();

    // 大量刪除
    // $posts = App\Post::destroy([2, 3]);
    // return $post;

    // $subject = new App\Subject();
    // $subject->title = 'ithelp Laravel 6.0 初體驗！怎麼用最新的 laravel 架網站！';
    // $subject->save();

    // $subject = App\Subject::find(2);
    $posts = $subject->posts;

    if (count($posts) === 0) {
        $post = new App\Post;
        $post->content = '[Day 12] 實作物件之間的關聯！談 Laravel Model Relation';
        $post->subject_id = $subject->id;
        $post->save();

        $post = new App\Post;
        $post->content = '[Day 13] 幫文章加上標籤！聊多對多關係';
        $post->subject_id = $subject->id;
        $post->save();
    }

    $subject->posts;
    return $subject;
});

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
