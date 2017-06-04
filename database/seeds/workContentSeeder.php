<?php

use Illuminate\Database\Seeder;

class workContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('work_content')->insert([
            'num'=>null,
            'logNum'=>'1',
            'contentType'=>'가사',
            'content'=>'오늘ㄹ도 열시미 놀앗따 ~끝~',
        ]);
    }
}
