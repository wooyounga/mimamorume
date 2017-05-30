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
            'licenseNum' => '1',
            'sitterId' => 'user1',
            'licenseKind' => '응애자격증',
            'licenseGrade' => '1급',
            'institution' => '응애학회'
        ]);
    }
}
