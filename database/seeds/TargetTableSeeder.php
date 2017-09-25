<?php

use Illuminate\Database\Seeder;

class TargetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('target')->insert([
            'num' => null,
            'name' => 'ジョ・チャンホ',
            'profile_image' => 'Jo.jpg',
            'age' => '60',
            'gender' => '男',
            'telephone' => '',
            'cellphone' => '01036508923',
            'zip_code' => '41529',
            'main_address' => '東京都',
            'rest_address' => '世田谷区',
            'latitude' => '35.894130',
            'longitude' => '128.620890',
            'disability_main' => '障害なし',
            'disability_sub' => '',
            'comment' => '',
        ]);

        DB::table('target')->insert([
          'num' => null,
          'name' => 'グヮク・デヒョ',
          'profile_image' => 'Kwak.jpg',
          'age' => '70',
          'gender' => '男',
          'telephone' => '',
          'cellphone' => '01033329774',
          'zip_code' => '41562',
          'main_address' => '東京都',
          'rest_address' => '足立区',
          'latitude' => '35.938073',
          'longitude' => '128.561825',
          'disability_main' => '障害なし',
          'disability_sub' => '',
          'comment' => '',
        ]);
    }
}
