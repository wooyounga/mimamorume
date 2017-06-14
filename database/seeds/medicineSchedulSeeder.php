<?php

use Illuminate\Database\Seeder;

class medicineSchedulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicine_schedule')->insert([
            'num' => null,
            'log_num' => 1,
            'medicine_name' => '애기약',
            'start_date' => '2017/06/01',
            'end_date' => '2017/06/20',
            'time' => '2017/06/20 3:00'
        ]);
        DB::table('medicine_schedule')->insert([
            'num' => null,
            'log_num' => 2,
            'medicine_name' => '감기약',
            'start_date' => '2017/06/01',
            'end_date' => '2017/06/20',
            'time' => '2017/06/20 3:00'
        ]);
    }
}
