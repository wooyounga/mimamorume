<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VitalDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 30; $i++) {
          $randomNum = mt_rand(60, 120);

          DB::table('vital_data')->insert([
              'num' => null,
              'data_type' => 'pulse',
              'target_num' => '1',
              'value' => $randomNum,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]);
        }
    }
}
