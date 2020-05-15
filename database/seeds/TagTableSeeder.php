<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $tags = ['科技', 'PHP', 'IT', '後端', '財經', '社會', '交通'];

         foreach($tags as $key => $tag) {
            $existTag = Tag::where('tagname', '=', $tag)->first();
            if (!isset($existTag)) {
                $existTag = new Tag;
                $existTag->tagname = $tag;
                $existTag->save();
            }
        }
    }
}
