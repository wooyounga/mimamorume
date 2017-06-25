<?php

use Illuminate\Database\Seeder;

class LicenseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('license')->insert([
            'license_num' => '1501073',
            'sitter_id' => 'user1',
            'license_kind' => '요양보호사',
            'license_grade' => '1급',
            'institution' => '대한한국 보건복지부'
        ]);
    }
}
