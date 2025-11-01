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
<<<<<<< HEAD
=======
        $this->call(UserSeeder::class);
>>>>>>> 0da78d7 (commit)
        // Call the KelasSeeder
        $this->call(PenilaiSeeder::class);
        $this->call(KpaSeeder::class);
        $this->call(BpSeeder::class);
        $this->call(SiswaProfilSeeder::class);
<<<<<<< HEAD
        $this->call(SiswaSeeder::class);
=======
>>>>>>> 0da78d7 (commit)
    }
}
