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
          'name' => '이현필',
          'profile_image' => 'Yi.jpg',
          'age' => '70',
          'gender' => '男',
          'telephone' => '07050339461',
          'cellphone' => '01024420326',
          'zip_code' => '41562',
          'main_address' => '대구광역시 북구 복현동 428-7',
          'rest_address' => '안하우스 402호',
          'latitude' => '35.894486',
          'longitude' => '128.618083',
          'disability_main' => '障害なし',
          'disability_sub' => '',
          'comment' => '',
        ]);

        DB::table('target')->insert([
            'num' => null,
            'name' => '조찬호',
            'profile_image' => 'Jo.jpg',
            'age' => '25',
            'gender' => '男',
            'telephone' => '',
            'cellphone' => '01036508923',
            'zip_code' => '41529',
            'main_address' => '대구광역시 북구 복현동 339-7',
            'rest_address' => '201호',
            'latitude' => '35.894130',
            'longitude' => '128.620890',
            'disability_main' => '지체장애',
            'disability_sub' => '2급',
            'comment' => '발가락 아야함',
        ]);

        DB::table('target')->insert([
          'num' => null,
          'name' => '곽대효',
          'profile_image' => 'Kwak.jpg',
          'age' => '26',
          'gender' => '男',
          'telephone' => '',
          'cellphone' => '01033329774',
          'zip_code' => '41562',
          'main_address' => '대구광역시 북구 동천동 915',
          'rest_address' => '칠곡3차화성타운 106동 1104호',
          'latitude' => '35.938073',
          'longitude' => '128.561825',
          'disability_main' => '자폐성장애',
          'disability_sub' => '1급',
          'comment' => '농구 밖에 모름',
        ]);
    }
}
