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
            'log_num'=>'1',
            'content_type'=>'가사',
            'content'=>'오늘ㄹ도 열시미 놀앗따 ~끝~',
        ]);
        DB::table('work_content')->insert([
            'num'=>null,
            'log_num'=>'3',
            'content_type'=>'가사',
            'content'=>'빌런놀이를 해따~~`',
        ]);
    }
}
