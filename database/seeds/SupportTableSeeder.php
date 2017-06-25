<?php

use Illuminate\Database\Seeder;

class SupportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('support')->insert([
          'family_id' => 'user2',
          'target_num' => '1',
        ]);

        \DB::table('support')->insert([
          'family_id' => 'user3',
          'target_num' => '2',
        ]);

        \DB::table('support')->insert([
          'family_id' => 'user3',
          'target_num' => '3',
        ]);
    }
}
