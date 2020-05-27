<?php

use App\Type;
use App\Animal;
use Illuminate\Database\Seeder;

class AnimalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(DataSeed::animals as $animal) {
            $tag = Type::where('name', '=', $animal['type'])->first();
            $eloquent = new Animal();
            $eloquent->name = $animal['name'];
            $eloquent->type_id =$tag->id;
            $eloquent->birthday = $animal['birthday'];
            $eloquent->area = $animal['area'];
            $eloquent->fix = $animal['fix'];
            $eloquent->save();
        }
    }
}
