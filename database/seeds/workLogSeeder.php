<?php

use Illuminate\Database\Seeder;

class workLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('work_log')->insert([
            'num'=>null,
            'sitter_id'=>'user1',
            'target_num'=>'1',
            'medicine_schedule_num'=>'1',
            'work_date'=>'2017/05/04',
        ]);
    }
}
