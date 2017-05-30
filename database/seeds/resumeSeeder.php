<?php

use Illuminate\Database\Seeder;

class resumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resume')->insert([
            'sitterId' => 'user1',
            'lisence' => '1',
            'center' => '영진전문대',
            'career' => '1234',
            'profileImage' => '/image/profileImage/2.jpg',
        ]);
    }
}
