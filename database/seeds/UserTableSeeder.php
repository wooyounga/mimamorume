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
            'name' => 'イ・ヒョンピル',
            'age' => '25',
            'gender' => '男',
            'email' => 'artistic0326@naver.com',
            'telephone' => '07050339461',
            'cellphone' => '01024420326',
            'zip_code' => '44978',
            'main_address' => '蔚山廣域市蔚州郡溫陽邑大安1道7－6',
            'rest_address' => '302号（ドンホデアンマンション）',
        ]);

        DB::table('user')->insert([
            'id' => 'user2',
            'user_type' => '保護者',
            'pw' => bcrypt('secret'),
            'name' => 'ウ・ヨンア',
            'age' => '22',
            'gender' => '女',
            'email' => 'wooyoung-a@naver.com',
            'telephone' => '',
            'cellphone' => '01077135539',
            'zip_code' => '41527',
            'main_address' => '大邱廣域市北区伏賢道35',
            'rest_address' => '永進專門大学',
        ]);
    }
}
