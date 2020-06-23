<?php

use App\Subject;
use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(DataSeed::subjects as $key => $sub) {
            $existSub = Subject::where('title', '=', $sub['subject'])->first();

            if (!isset($existSub)) {
                $existSub = new App\Subject;
                $existSub->title = $sub['subject'];
                $existSub->save();
            }
        }
    }
}
