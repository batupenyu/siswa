<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        // Call the KelasSeeder
        $this->call(PenilaiSeeder::class);
        $this->call(KpaSeeder::class);
        $this->call(BpSeeder::class);
        $this->call(SiswaProfilSeeder::class);
        $this->call(SiswaSeeder::class);
    }
}
