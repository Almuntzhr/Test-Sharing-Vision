<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 50; $i++){
 
    		DB::table('posts')->insert([
    			'title' => $faker->realText(30),
    			'content' => $faker->text(350),
    			'category' => $faker->randomElement(['category 1', 'category 2', 'category 3']),
    			'status' => $faker->randomElement(['publish', 'draft', 'trash']),
                'created_at' => $faker->dateTime()
    		]);
 
    	}
    }
}
