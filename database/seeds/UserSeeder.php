<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => '사용자1',
                'id' => 'user1@myhost.com',
                'pw' => bcrypt('secret'),
            ],
        ];

        foreach($users as $u){
            App\User::create($u);
        }
    }
}
