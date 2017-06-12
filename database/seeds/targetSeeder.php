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
     /*   DB::table('target')->insert([
            'num'=>null,
            'name'=>'감나무',
            'profile_image'=>'/images/profileImage/1.jpg',
            'age'=>'70',
            'gender'=>'남',
            'telephone'=>'0535555555',
            'cellphone'=>'0109999999',
            'zip_code'=>'153132',
            'main_address' =>'대구시 북고 대현동',
            'rest_address' => '응애빌딩',
            'latitude'=>'35',
            'longitude'=>'35',
            'disability_main'=>'없음',
            'disability_sub'=>'없음',
            'comment'=>'응애',
        ]);*/
        DB::table('target')->insert([
            'num'=>null,
            'name'=>'응애빌런',
            'profile_image'=>'/images/profileImage/1.jpg',
            'age'=>'50',
            'gender'=>'여',
            'telephone'=>'0535544555',
            'cellphone'=>'0109955999',
            'zip_code'=>'153132',
            'main_address' =>'아이언맨',
            'rest_address' => '응애빌딩',
            'latitude'=>'35',
            'longitude'=>'35',
            'disability_main'=>'없음',
            'disability_sub'=>'없음',
            'comment'=>'빌런임니다~~!',
        ]);
    }
}
