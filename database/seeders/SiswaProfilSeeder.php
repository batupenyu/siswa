<?php

namespace Database\Seeders;

use App\Models\SiswaProfil;
use Illuminate\Database\Seeder;

class SiswaProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiswaProfil::create([
            'nama_lengkap' => 'Budi Santoso',
            'nama_panggilan' => 'Budi',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => ' 2005-05-15',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'kewarganegaraan' => 'Indonesia',
            'anak_ke_berapa' => 2,
            'jumlah_saudara_kandung' => 3,
            'jumlah_saudara_tiri' => 0,
            'jumlah_saudara_angkat' => 0,
            'bahasa_sehari_hari_di_rumah' => 'Bahasa Indonesia',
            'alamat' => 'Jl. Merdeka No. 10',
            'nomor_telepon' => '08123456789',
            'tinggal_dengan' => 'orang tua',
            'jarak_tempat_tinggal_ke_sekolah' => 5.0,
            'alat_transportasi_ke_sekolah' => 1,
            'berat_badan' => '60',
            'tinggi_badan' => '170',
            'golongan_darah' => 'O',
            'penyakit_yang_pernah_diderita' => '-',
            'asal_SD' => 'SD Negeri 1 Jakarta',
            'tanggal_sttb_SD' => '2017-06-10',
            'nomor_sttb_SD' => '12345',
            'lama_belajar_SD' => '6 tahun',
            'asal_SMP' => 'SMP Negeri 1 Jakarta',
            'tanggal_sttb_SMP' => '2021-06-10',
            'nomor_sttb_SMP' => '67890',
            'lama_belajar_SMP' => '3 tahun',
            'nama_ayah' => 'Bapak Santoso',
            'tempat_lahir_ayah' => 'Jakarta',
            'tanggal_lahir_ayah' => '1970-01-01',
            'alamat_ayah' => 'Jl. Merdeka No. 10',
            'nomor_telepon_ayah' => '08129876543',
            'pekerjaan_ayah' => 'Pegawai Negeri',
            'penghasilan_perbulan_ayah' => 5000000,
            'pendidikan_ayah' => 'S1',
            'kewarganegaraan_ayah' => 'Indonesia',
            'nama_ibu' => 'Ibu Sari',
            'tempat_lahir_ibu' => 'Jakarta',
            'tanggal_lahir_ibu' => '1975-02-02',
            'alamat_ibu' => 'Jl. Merdeka No. 10',
            'nomor_telepon_ibu' => '08129876544',
            'pekerjaan_ibu' => 'Ibu Rumah Tangga',
            'penghasilan_perbulan_ibu' => 0,
            'pendidikan_ibu' => 'SMA',
            'kewarganegaraan_ibu' => 'Indonesia',
            'nama_wali' => '',
            'alamat_wali' => '',
            'nomor_telepon_wali' => '',
            'kegemaran_olah_raga' => 'Sepak bola',
            'kegemaran_kemasyarakatan' => 'Pramuka',
            'kegemaran_hasta_karya' => 'Membaca buku',
            'jurusan' => 'TBSM',
        ]);
    }
}
