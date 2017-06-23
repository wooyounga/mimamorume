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
          'name' => '양현하',
          'profile_image' => 'Yang.png',
          'age' => 27,
          'gender' => '남성',
          'telephone' => '',
          'cellphone' => '01027592641',
          'zip_code' => '41529',
          'main_address' => '대구광역시 북구 복현동 338-14',
          'rest_address' => '201호',
          'latitude' => '35.893662',
          'longitude' => '128.622511',
          'disability_main' => '안면장애',
          'disability_sub' => '2급',
          'comment' => '항상 무표정',
        ]);

        DB::table('target')->insert([
          'num' => null,
          'name' => '주성민',
          'profile_image' => 'default.jpg',
          'age' => 25,
          'gender' => '남성',
          'telephone' => '',
          'cellphone' => '01025763143',
          'zip_code' => '41527',
          'main_address' => '대구광역시 북구 복현동 218',
          'rest_address' => '영진전문대학 본관 200호',
          'latitude' => '35.896577',
          'longitude' => '128.620242',
          'disability_main' => '지적장애',
          'disability_sub' => '1급',
          'comment' => '무철',
        ]);

        DB::table('target')->insert([
          'num' => null,
          'name' => '정준석',
          'profile_image' => 'default.jpg',
          'age' => 24,
          'gender' => '남성',
          'telephone' => '',
          'cellphone' => '01094860488',
          'zip_code' => '41160',
          'main_address' => '대구광역시 동구 방촌동 1067-1',
          'rest_address' => '101동 102호',
          'latitude' => '35.881260',
          'longitude' => '128.663858',
          'disability_main' => '지체장애',
          'disability_sub' => '3급',
          'comment' => '오른손 사용불가',
        ]);

        DB::table('target')->insert([
            'num' => null,
            'name' => '우영아',
            'profile_image' => 'default.jpg',
            'age' => 22,
            'gender'=> '여성',
            'telephone'=> '',
            'cellphone'=> '01077135530',
            'zip_code' => '41527',
            'main_address' =>'대구광역시 북구 복현동 218',
            'rest_address' => '영진전문대학 본관 200호',
            'latitude' => '35.896576',
            'longitude' => '128.620240',
            'disability_main' => '장애없음',
            'disability_sub' => '',
            'comment' => '',
        ]);

        DB::table('target')->insert([
            'num' => null,
            'name' => '조찬호',
            'profile_image' => 'default.jpg',
            'age' => '70',
            'gender' => '남성',
            'telephone' => '',
            'cellphone' => '01036508922',
            'zip_code' => '41529',
            'main_address' => '대구광역시 북구 복현동 339-7',
            'rest_address' => '201호',
            'latitude' => '35.894130',
            'longitude' => '128.620890',
            'disability_main' => '지체장애',
            'disability_sub' => '2급',
            'comment' => '발가락 아야함',
        ]);
    }
}
