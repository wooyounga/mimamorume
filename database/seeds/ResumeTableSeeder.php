<?php

use Illuminate\Database\Seeder;

class ResumeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resume')->insert([
            'sitter_id' => 'user1',
            'license' => 'yes',
            'center' => '永進介護施設',
            'career' => '3年',
            'profile_image' => 'Woo.jpg',
        ]);
    }
}
