<?php

namespace Database\Seeders;

use App\Models\Kpa;
use Illuminate\Database\Seeder;

class KpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kpa::create([
            'nama' => ' SJAMSUL BAHRI,SH,M . AP',
            'jabatan' => 'Kepala Cabang',
            'nip' => '19780604 200212 1 005',
            'pangkat' => 'Pembina, IV/a',
            'unitkerja' => 'Cabang Dinas Wilayah I',
            'instansi' => 'Dinas Pendidikan Prov. Kep. Bangka Belitung',
        ]);
    }
}
