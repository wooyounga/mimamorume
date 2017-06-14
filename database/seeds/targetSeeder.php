<?php

use Illuminate\Database\Seeder;

class targetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('target')->insert([
            'num'=>null,
            'name'=>'이현필',
            'profile_image'=>'/images/profileImage/1.jpg',
            'age'=>'70',
            'gender'=>'남',
            'telephone'=>'0535555555',
            'cellphone'=>'0109999999',
            'zip_code'=>'153132',
            'main_address' =>'대구시 북고 대현동',
            'rest_address' => '영진빌딩',
            'latitude'=>'35',
            'longitude'=>'35',
            'disability_main'=>'없음',
            'disability_sub'=>'없음',
            'comment'=>'아픕니다',
        ]);
        DB::table('target')->insert([
            'num'=>null,
            'name'=>'곽대효',
            'profile_image'=>'/images/profileImage/1.jpg',
            'age'=>'50',
            'gender'=>'여',
            'telephone'=>'0535544555',
            'cellphone'=>'0109955999',
            'zip_code'=>'153132',
            'main_address' =>'북구시 대구 현필동',
            'rest_address' => '현필시티',
            'latitude'=>'35',
            'longitude'=>'35',
            'disability_main'=>'없음',
            'disability_sub'=>'없음',
            'comment'=>'빌런임니다~~!',
        ]);

        DB::table('target')->insert([
            'num'=>null,
            'name'=>'조찬호',
            'profile_image'=>'/images/profileImage/1.jpg',
            'age'=>'70',
            'gender'=>'남',
            'telephone'=>'0535884555',
            'cellphone'=>'0105323499',
            'zip_code'=>'135132',
            'main_address' =>'네모시 바지구 스펀지동',
            'rest_address' => '핑핑이 아파트',
            'latitude'=>'35',
            'longitude'=>'32',
            'disability_main'=>'없음',
            'disability_sub'=>'없음',
            'comment'=>'데헷',
        ]);

    }
}
