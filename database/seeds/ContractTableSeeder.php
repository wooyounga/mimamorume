<?php

use Illuminate\Database\Seeder;

class ContractTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('contract')->insert([
          'family_id' => 'user2',
          'sitter_id' => 'user1',
          'work_week' => '매주 월, 수, 금',
          'work_start' => '2017-05-21',
          'work_end' => '2017-06-21',
          'work_start_time' => '09:00',
          'work_end_time' => '18:00',
        ]);

        \DB::table('contract')->insert([
          'family_id' => 'user2',
          'sitter_id' =>'user3',
          'work_week' => '매주 화, 목, 토',
          'work_start' => '2017-05-21',
          'work_end' => '2017-06-21',
          'work_start_time' => '09:00',
          'work_end_time' => '18:00',
        ]);
    }
}
