<?php

use Illuminate\Database\Seeder;

class careSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('care')->insert([
            'sitter_id' => 'user1',
            'target_num' => '1',
        ]);
    }
}
