<?php

use Illuminate\Database\Seeder;

class licenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('license')->insert([
            'license_num' => '1',
            'sitter_id' => 'user1',
            'license_kind' => '응애자격증',
            'license_grade' => '1급',
            'institution' => '응애학회'
        ]);
        DB::table('license')->insert([
            'license_num' => '2',
            'sitter_id' => 'user1',
            'license_kind' => '아재개그자격증',
            'license_grade' => '1급',
            'institution' => '아재학회'
        ]);
    }
}
