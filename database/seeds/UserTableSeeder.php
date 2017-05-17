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
                'userType' => '보호사',
                'pw' => bcrypt('secret'),
                'name' => '사용자1',
                'age' => '40',
                'gender' => '여',
                'email' => 'ss@naver.com',
                'telephone' => '0535551234',
                'cellphone' => '01012345678',
                'adressCity' => '대구시',
                'adressGu' => '북구',
                'adressDong' => '복현동',
                'adressRest' => '영진전문대',
            ]);

        /*foreach($user as $u){
            App\User::create($u);
        }*/
    }
}
