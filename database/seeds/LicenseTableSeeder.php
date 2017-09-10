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
            'license_kind' => '介護職員',
            'license_grade' => '1級',
            'institution' => '厚生労働省'
        ]);
    }
}
