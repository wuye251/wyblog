<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tags')->insert([
            'name' => 'php',
            'keywords' => '编程',
            'description' => 'php语言标签',
        ])->withTimestamps();

    }
}
