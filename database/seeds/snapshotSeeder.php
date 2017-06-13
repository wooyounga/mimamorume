<?php

use Illuminate\Database\Seeder;

class snapshotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('snapshot')->insert([
            'num' => null,
            'snapshot_type' => '정기촬영',
            'snapshot_name' => 'RnRk.png',
            'upload_name' => 'RnRk.png',
            'camera_num' => '1',
        ]);
        DB::table('snapshot')->insert([
            'num' => null,
            'snapshot_type' => '정기촬영',
            'snapshot_name' => 'kk.png',
            'upload_name' => 'kk.png',
            'camera_num' => '1',
        ]);
    }
}
