<?php

use Illuminate\Database\Seeder;

class CameraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('camera')->insert([
            'num' => null,
            'target_num' => '1',
        ]);

        DB::table('camera')->insert([
            'num' => null,
            'target_num' => '1',
        ]);

        DB::table('camera')->insert([
            'num' => null,
            'target_num' => '1',
        ]);
    }
}
