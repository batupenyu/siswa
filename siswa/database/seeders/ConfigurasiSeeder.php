<?php

namespace Database\Seeders;

use App\Models\Configurasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Configurasi::create(['code' => 'atasan.nama', 'value' => ' Syahryanto, S.T']);
        Configurasi::create(['code' => 'atasan.jabatan', 'value' => ' Kepala Sekolah']);
        Configurasi::create(['code' => 'atasan.nip', 'value' => '197708262006041005']);
        Configurasi::create(['code' => 'atasan.pangkat', 'value' => 'Pembina, IV/a']);
        Configurasi::create(['code' => 'atasan.unitkerja', 'value' => 'SMK Negeri 1 Koba']);
        Configurasi::create(['code' => 'atasan.instansi', 'value' => 'Dinas Pendidikan Prov. Kep. Bangka Belitung']);

        Configurasi::create(['code' => 'kpa.nama', 'value' => 'SJAMSUL BAHRI, SH,M.AP']);
        Configurasi::create(['code' => 'kpa.jabatan', 'value' => 'Kepala Cabang']);
        Configurasi::create(['code' => 'kpa.nip', 'value' => '19780604 200212 1 005']);
        Configurasi::create(['code' => 'kpa.pangkat', 'value' => 'Pembina, IV/a']);
        Configurasi::create(['code' => 'kpa.unitkerja', 'value' => 'Cabang Dinas Wilayah I']);

        Configurasi::create(['code' => 'pptk.nama', 'value' => ' SYAHRYANTO, ST']);
        Configurasi::create(['code' => 'pptk.jabatan', 'value' => ' Kepala Sekolah']);
        Configurasi::create(['code' => 'pptk.nip', 'value' => '19770826 200604 1 005']);
        Configurasi::create(['code' => 'pptk.pangkat', 'value' => 'Pembina, IV/a']);
        Configurasi::create(['code' => 'pptk.unitkerja', 'value' => 'SMK Negeri 1 Koba']);

        Configurasi::create(['code' => 'bp.nama', 'value' => ' JOKO SANTOSO,S.St.Pi']);
        Configurasi::create(['code' => 'bp.jabatan', 'value' => ' Bendaha Pengeluaran Pembantu']);
        Configurasi::create(['code' => 'bp.nip', 'value' => '19800407 200501 1 007']);
        Configurasi::create(['code' => 'bp.pangkat', 'value' => 'Pembina, IV/a']);
        Configurasi::create(['code' => 'bp.unitkerja', 'value' => 'Cabang Dinas Wilayah I']);
    }
}
