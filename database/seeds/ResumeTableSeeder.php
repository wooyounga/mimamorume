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
            'center' => '영진전문대학',
            'career' => '3년',
            'profile_image' => 'Woo.jpg',
        ]);
    }
}
