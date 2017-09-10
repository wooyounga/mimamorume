<?php

use Illuminate\Database\Seeder;

class WorkContentTableSeeder extends Seeder
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
            'content_type'=>'介護',
            'content'=>'咳が少し出るぐらい',
        ]);

        DB::table('work_content')->insert([
            'num'=>null,
            'log_num'=>'2',
            'content_type'=>'介護',
            'content'=>'特に問題なし',
        ]);
    }
}
