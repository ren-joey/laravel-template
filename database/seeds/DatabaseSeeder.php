<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TagTableSeeder::class,
            SubjectTableSeeder::class,
            PostTableSeeder::class,
            TypeTableSeeder::class
        ]);
    }
}
