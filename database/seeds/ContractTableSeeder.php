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
      DB::table('contract')->insert([
          'family_id' => 'user2',
          'sitter_id' => 'user1',
          'work_week' => '週1回',
          'work_start' => '2017-06-23',
          'work_end' => '2017-06-30',
          'work_start_time' => '9:00',
          'work_end_time' => '18:00',
      ]);
    }
}
