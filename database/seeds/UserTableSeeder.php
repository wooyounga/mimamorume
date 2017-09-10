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
            'id' => 'admin',
            'user_type' => '管理者',
            'pw' => bcrypt('secret'),
            'name' => '永進介護施設',
            'age' => '0',
            'gender' => '男性',
            'email' => 'admin@admin.kr',
            'telephone' => '00000000000',
            'cellphone' => '00000000000',
            'zip_code' => '00000',
            'main_address' => '東京都',
            'rest_address' => '',
        ]);

        DB::table('user')->insert([
            'id' => 'user1',
            'user_type' => '介護職員',
            'pw' => bcrypt('secret'),
            'name' => 'ウ・ヨンア',
            'age' => '22',
            'gender' => '女',
            'email' => 'wooyoung-a@naver.com',
            'telephone' => '0700000000',
            'cellphone' => '01077135539',
            'zip_code' => '41527',
            'main_address' => '東京都',
            'rest_address' => '',
        ]);

        DB::table('user')->insert([
            'id' => 'user2',
            'user_type' => '保護者',
            'pw' => bcrypt('secret'),
            'name' => 'キム・テイン',
            'age' => '27',
            'gender' => '男',
            'email' => 'kimtaein@naver.com',
            'telephone' => '07000000000',
            'cellphone' => '01096887750',
            'zip_code' => '44978',
            'main_address' => '東京都',
            'rest_address' => '',
        ]);

        DB::table('user')->insert([
            'id' => 'user3',
            'user_type' => '保護者',
            'pw' => bcrypt('secret'),
            'name' => 'キム・ソンヨン',
            'age' => '26',
            'gender' => '男',
            'email' => 'krk3553@naver.com',
            'telephone' => '08011595344',
            'cellphone' => '01041161574',
            'zip_code' => '44920',
            'main_address' => '東京都',
            'rest_address' => '',
        ]);
    }
}
