<?php

use App\Post;
use App\Subject;
use App\Tag;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(DataSeed::subjects as $key => $sub) {
            $tags = Tag::all()->filter(function($tag) use ($sub) {
                return array_search($tag['tagname'], $sub['tags']) !== false;
            });

            // $tags = Tag::all();

            // $filteredTags = array_filter($tags, function ($tag) use ($sub) {
            //     return array_search($tag['tagname'], $sub['tags']) !== false;
            // });

            foreach($sub['posts'] as $key => $post) {
                $existPost = Post::where('content', '=', $post)->first();
                $existSub = Subject::where('title', '=', $sub['subject'])->first();

                if (!isset($existPost) && isset($existSub)) {
                    $existPost = new Post;
                    $existPost->subject_id = $existSub->id;
                    $existPost->content = $post;
                    $existPost->save();

                    $existPost->tags()->attach($tags);
                }
            }
        }
    }
}
