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
            'email' => 'siswa1@example.com',
            'nis' => '1234567890',
            'kelas_id' => 1, // Adjust as per your kelas table data
            'tanggal_lahir' => '2005-01-01',
            // Add other required fields as per your Siswa model
        ]);

        Siswa::create([
            'name' => 'Siswa Two',
            'email' => 'siswa2@example.com',
            'nis' => '0987654321',
            'kelas_id' => 1, // Adjust as per your kelas table data
            'tanggal_lahir' => '2006-02-02',
            // Add other required fields as per your Siswa model
        ]);
    }
}
