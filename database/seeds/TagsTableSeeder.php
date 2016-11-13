<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Tag::insert([
    		['name' => 'Programming'],
    		['name' => 'Music'],
    		['name' => 'Literature'],
    		['name' => 'Geo'],
    		['name' => 'Front End'],
    		['name' => 'Js'],
    	]);
    }
}
