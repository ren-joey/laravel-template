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
         foreach(DataSeed::tags as $key => $tag) {
            $existTag = Tag::where('tagname', '=', $tag)->first();
            if (!isset($existTag)) {
                $existTag = new Tag;
                $existTag->tagname = $tag;
                $existTag->save();
            }
        }
    }
}
