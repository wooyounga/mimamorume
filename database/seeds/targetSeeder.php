<?php

use Illuminate\Database\Seeder;

class targetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('target')->insert([
            'num'=>null,
            'name'=>'감나무',
            'profileImage'=>'/image/profile/1.jpg',
            'age'=>'70',
            'gender'=>'남',
            'telephone'=>'0535555555',
            'cellphone'=>'0109999999',
            'adressCity'=>'대구시',
            'adressGu'=>'북구',
            'adressDong'=>'복현동',
            'adressRest'=>'영진전문대',
            'latitude'=>'35',
            'longitude'=>'35',
            'disabilityMain'=>'없음',
            'disabilityShb'=>'없음',
            'comment'=>'응애',
        ]);
    }
}
