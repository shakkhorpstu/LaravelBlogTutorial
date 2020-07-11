<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Models\Category');
        for($i = 1; $i<=10; $i++) {
            DB::table('categories')->insert(
                [
                    'title' => $faker->name
                ]
            );
        }
    }
}
