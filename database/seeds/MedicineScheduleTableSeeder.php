<?php

use Illuminate\Database\Seeder;

class MedicineScheduleTableSeeder extends Seeder
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
            'medicine_name' => '風邪薬',
            'start_date' => '2017/06/01',
            'end_date' => '2017/06/20',
            'time' => '2017/06/20 3:00'
        ]);

        DB::table('medicine_schedule')->insert([
            'num' => null,
            'log_num' => 3,
            'medicine_name' => '頭痛薬',
            'start_date' => '2017/08/11',
            'end_date' => '2017/08/20',
            'time' => '2017/08/20 1:00'
        ]);
    }
}
