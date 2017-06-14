<?php

use Illuminate\Database\Seeder;

class matching_post_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB:table('matching_post')->insert([
           "num" => null,
           "user_id" => "user1",
           "target_num" => null,
           "title" => "대상자 구함",
           "content" => "월급 100~:
           

        ]);
    }
}
