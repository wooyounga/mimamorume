<?php

use Illuminate\Database\Seeder;

class SnapshotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('snapshot')->insert([
          'num' => null,
          'snapshot_type' => '',
          'snapshot_name' => '',
          'upload_name' => '',
          'camera_num' => ,
        ]);
    }
}
