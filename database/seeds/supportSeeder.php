<?php

use Illuminate\Database\Seeder;

class supportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('support')->insert([
            'family_id' => 'user2',
            'target_num' => '2',
        ]);
    }
}