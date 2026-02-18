<?php

namespace Database\Seeders;

use App\Models\Penilai;
use Illuminate\Database\Seeder;

class PenilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Penilai::firstOrCreate([
            'nip' => '197708262006041005',
        ], [
            'nama' => 'Syahryanto, S.T',
            'jabatan' => 'Kepala Sekolah',
            'pangkat' => 'Pembina, IV/a',
            'unitkerja' => 'SMK Negeri 1 Koba',
            'instansi' => 'Dinas Pendidikan Prov. Kep. Bangka Belitung',
        ]);
    }
}
