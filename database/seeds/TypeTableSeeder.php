<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(DataSeed::types as $type) {
            $existType = Type::where('name', '=', $type)->first();
            if (empty($existType)) {
                $max = Type::max('sort') ?: 100;
                $existType = new Type();
                $existType->name = $type;
                $existType->sort = $max + 1;
                $existType->save();
            }
        }
    }
}
