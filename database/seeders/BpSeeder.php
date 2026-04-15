<?php

namespace Database\Seeders;

use App\Models\Bp;
use Illuminate\Database\Seeder;

class BpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bp::firstOrCreate([
            'nip' => '19800407 200501 1 007',
        ], [
            'nama' => 'JOKO SANTOSO,S.St.Pi',
            'jabatan' => 'Bendaha Pengeluaran Pembantu',
            'pangkat' => 'Pembina, IV/a',
            'unitkerja' => 'Cabang Dinas Wilayah I',
            'instansi' => 'Dinas Pendidikan Prov. Kep. Bangka Belitung',
        ]);
    }
}
