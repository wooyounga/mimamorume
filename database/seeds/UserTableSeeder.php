<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'id' => 'user1',
            'user_type' => '보호사',
            'pw' => bcrypt('secret'),
            'name' => '김태인',
            'age' => 27,
            'gender' => '남성',
            'email' => 'kimtaein@naver.com',
            'telephone' => '0700000000',
            'cellphone' => '01096887755',
            'zip_code' => '38117',
            'main_address' => '경상북도 경주시 천군동 191-5',
            'rest_address' => '파에톤',
        ]);

        DB::table('user')->insert([
            'id' => 'user2',
            'user_type' => '보호자',
            'pw' => bcrypt('secret'),
            'name' => '곽대효',
            'age' => '26',
            'gender' => '남성',
            'email' => 'kwakdaehyo@naver.com',
            'telephone' => '07000000000',
            'cellphone' => '01033329775',
            'zip_code' => '41426',
            'main_address' => '대구광역시 북구 동천동 914',
            'rest_address' => '204동 1104호',
        ]);

        DB::table('user')->insert([
            'id' => 'user3',
            'user_type' => '보호사',
            'pw' => bcrypt('secret'),
            'name' => '이현필',
            'age' => '26',
            'gender' => '남성',
            'email' => 'aritsitic0326@naver.com',
            'telephone' => '07050339461',
            'cellphone' => '01024420326',
            'zip_code' => '41562',
            'main_address' => '대구광역시 북구 복현동 428-7',
            'rest_address' => '안하우스 402호',
        ]);

        DB::table('user')->insert([
            'id' => 'user4',
            'user_type' => '보호자',
            'pw' => bcrypt('secret'),
            'name' => '김성용',
            'age' => '26',
            'gender' => '남성',
            'email' => 'krk3553@naver.com',
            'telephone' => '08011595344',
            'cellphone' => '01041161574',
            'zip_code' => '44920',
            'main_address' => '울산광역시 울주군 범서읍 구영리 212',
            'rest_address' => '101동 104호',
        ]);
    }
}
