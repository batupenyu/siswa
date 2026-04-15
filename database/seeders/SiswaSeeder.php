<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample data for siswas table
        Siswa::create([
            'name' => 'Siswa One',
            'nis' => '1234567890',
            'kelas_id' => 1, // Adjust as per your kelas table data
            // Add other required fields as per your Siswa model
        ]);

        Siswa::create([
            'name' => 'Siswa Two',
            'nis' => '0987654321',
            'kelas_id' => 1, // Adjust as per your kelas table data
            // Add other required fields as per your Siswa model
        ]);
    }
}
