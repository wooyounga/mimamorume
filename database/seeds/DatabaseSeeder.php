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
         $this->call(licenseSeeder::class);
         $this->call(resumeSeeder::class);
        $this->call(targetSeeder::class);
        $this->call(supportSeeder::class);
        // $this->call(workLogSeeder::class);
        // $this->call(medicineSchedulSeeder::class);
        // $this->call(workContentSeeder::class);
        $this->call(vitalDataSeeder::class);
        $this->call(cameraSeeder::class);
        $this->call(snapshotSeeder::class);
    }
}
