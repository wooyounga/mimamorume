<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class vitalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*$user = */
      for($i = 50; $i <= 100; $i++){
        DB::table('vital_data')->insert([
            'num' => null,
            'data_type' => 'pulse',
            'target_num' => '1',
            'value' => $i,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
      }


      /*foreach($user as $u){
          App\User::create($u);
      }*/
    }
}
