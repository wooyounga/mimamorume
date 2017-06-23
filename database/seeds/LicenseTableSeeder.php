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
            'license_kind' => '장애인심리치료사',
            'license_grade' => '1급',
            'institution' => '한국'
        ]);

        DB::table('license')->insert([
            'license_num' => '1501242',
            'sitter_id' => 'user3',
            'license_kind' => '장애인활동보조 교육 위수증',
            'license_grade' => '없음',
            'institution' => '한국 보건복지부'
        ]);
    }
}
