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
            'sitterId'=>'user1',
            'targetNum'=>'1',
            'medicineSchedule'=>'2017/07/08',
            'workDate'=>'2017/05/04',
        ]);
    }
}
