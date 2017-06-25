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
            'name' => '우영아',
            'age' => '22',
            'gender' => '여성',
            'email' => 'wooyoung-a@naver.com',
            'telephone' => '0700000000',
            'cellphone' => '01077135539',
            'zip_code' => '41527',
            'main_address' => '대구광역시 북구 복현동 218',
            'rest_address' => '영진전문대학 본관 200호',
        ]);

        DB::table('user')->insert([
            'id' => 'user2',
            'user_type' => '보호자',
            'pw' => bcrypt('secret'),
            'name' => '김태인',
            'age' => '27',
            'gender' => '남성',
            'email' => 'kimtaein@naver.com',
            'telephone' => '07000000000',
            'cellphone' => '01096887750',
            'zip_code' => '44978',
            'main_address' => '울산광역시 울주군 온양읍 대안리 568-2',
            'rest_address' => '동호대안맨션 302호',
        ]);

        DB::table('user')->insert([
            'id' => 'user3',
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
            'rest_address' => '울산구영1단지주공아파트 101동 104호',
        ]);
    }
}
