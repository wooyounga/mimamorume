<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(TargetTableSeeder::class);
        $this->call(ResumeTableSeeder::class);
        $this->call(SupportTableSeeder::class);
        $this->call(LicenseTableSeeder::class);
        $this->call(ContractTableSeeder::class);
        $this->call(CareTableSeeder::class);
        $this->call(VitalDataTableSeeder::class);
        $this->call(CameraTableSeeder::class);
        $this->call(MatchingPostTableSeeder::class);
    }
}
