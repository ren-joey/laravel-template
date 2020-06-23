<?php

namespace App\Http\Controllers;

use App\Post;
use App\Subject;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (!Auth::check()) return redirect('/');
        $posts = Post::cursor();
        foreach($posts as $post) {
            $post->tags();
        }

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::check()) return redirect()->route('posts.index');
        return view('posts.create', [
            'subjects' => Subject::cursor(),
            'tags' => Tag::cursor(),
            'auth_id' => Auth::id()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // var_dump($request->input());

        $post = new Post;
        $post->content = $request->input('content');
        $post->subject_id = $request->input('subject');
        $post->user_id = Auth::id();
        $post->save();
        $post->tags()->attach(Tag::cursor()->random());
        return redirect()->route('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->tags();
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $body = ['post' => $post];
        $user = Auth::user();
        if(is_null($user)
            || $user->cant('update', $post)) {
                Log::channel('posts')->info('錯誤用戶嘗試編輯', ['user' => $user]);
                return redirect()->route('posts.show', $body);
            }
        return view('posts.edit', array_merge($body, [
            'auth_id' => Auth::id()
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // return var_dump($request->input())
        $this->authCheck();
        $post->content = $request->input('content');
        $post->save();
        return redirect()->route('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
