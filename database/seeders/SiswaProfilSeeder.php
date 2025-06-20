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
            'siswa_id' => 1,
            'nama_panggilan' => 'Budi',
            'jenis_kelamin' => 'L',
            'tempat_tanggal_lahir' => 'Jakarta, 2005-05-15',
            'agama' => 'islam',
            'kewarganegaraan' => 'Indonesia',
            'anak_ke_berapa' => 2,
            'jumlah_saudara_kandung' => 3,
            'jumlah_saudara_tiri' => 0,
            'jumlah_saudara_angkat' => 0,
            'status_anak' => 'yatim',
            'bahasa_sehari_hari_di_rumah' => 'Bahasa Indonesia',
            'alamat' => 'Jl. Merdeka No. 10',
            'nomor_telepon' => '08123456789',
            'tinggal_dengan' => 'orang_tua',
            'jarak_tempat_tinggal_ke_sekolah' => 5.0,
            'golongan_darah' => 'O',
            'penyakit_yang_pernah_diderita' => 'dll',
            'kelainan_jasmani' => 'Tidak ada',
            'tinggi_dan_berat_badan' => '170 cm / 60 kg',
            'pendidikan_sebelumnya' => 'SMP Negeri 1 Jakarta',
            'lulusan_dari' => 'SMP Negeri 1 Jakarta',
            'tanggal_dan_nomor_sttb' => '2021-06-10 / 12345',
            'lama_belajar' => '3 tahun',
            'dari_sekolah' => 'SMP Negeri 1 Jakarta',
            'alasan_pindah' => 'Pindah domisili',
            'diterima_di_sekolah_ini' => '2022-07-01',
            'di_kelas' => '10',
            'kelompok' => 'A',
            'jurusan' => 'TBSM',
            'tanggal_diterima' => '2022-07-01',
            'kesenian_kegemaran_siswa' => 'Menyanyi',
            'olahraga_kegemaran_siswa' => 'Sepak bola',
            'kegiatan_kemasyarakatan_kegemaran_siswa' => 'Pramuka',
            'kegemaran_lain_lain' => 'Membaca buku',
        ]);
    }
}
