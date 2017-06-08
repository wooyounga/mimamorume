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
        /*$user = */

        DB::table('user')->insert([
            'id' => 'user1',
            'user_type' => '보호사',
            'pw' => bcrypt('secret'),
            'name' => '사용자1',
            'age' => '40',
            'gender' => '여',
            'email' => 'ss@naver.com',
            'telephone' => '0535551234',
            'cellphone' => '01012345678',
            'zip_code' => '122345',
            'main_address' => '대구시 북구 복현동',
            'rest_address' => '영진전문대',
        ]);
        DB::table('user')->insert([
            'id' => 'user2',
            'user_type' => '보호자',
            'pw' => bcrypt('secret'),
            'name' => '사용자1',
            'age' => '40',
            'gender' => '여',
            'email' => 'ss3@naver.com',
            'telephone' => '0535451234',
            'cellphone' => '01015345678',
            'zip_code' => '122345',
            'main_address' => '대구시 북구 복현동',
            'rest_address' => '영진전문대',
        ]);
        /*foreach($user as $u){
            App\User::create($u);
        }*/
    }
}
