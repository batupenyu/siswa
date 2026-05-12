<?php

namespace App\Imports;

use App\Models\SiswaProfil;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaProfilImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new SiswaProfil([
            'nama_lengkap'                    => $row['nama_lengkap'] ?? null,
            'nama_panggilan'                  => $row['nama_panggilan'] ?? null,
            'tempat_lahir'                    => $row['tempat_lahir'] ?? null,
            'tanggal_lahir'                   => $row['tanggal_lahir'] ?? null,
            'jenis_kelamin'                   => $row['jenis_kelamin'] ?? null,
            'agama'                           => $row['agama'] ?? null,
            'kewarganegaraan'                 => $row['kewarganegaraan'] ?? null,
            'anak_ke_berapa'                  => $row['anak_ke_berapa'] ?? null,
            'jumlah_saudara_kandung'          => $row['jumlah_saudara_kandung'] ?? null,
            'jumlah_saudara_tiri'             => $row['jumlah_saudara_tiri'] ?? null,
            'jumlah_saudara_angkat'           => $row['jumlah_saudara_angkat'] ?? null,
            'bahasa_sehari_hari_di_rumah'     => $row['bahasa_sehari_hari_di_rumah'] ?? null,
            'alamat'                          => $row['alamat'] ?? null,
            'nomor_telepon'                   => $row['nomor_telepon'] ?? null,
            'tinggal_dengan'                  => $row['tinggal_dengan'] ?? null,
            'jarak_tempat_tinggal_ke_sekolah' => $row['jarak_tempat_tinggal_ke_sekolah'] ?? null,
            'alat_transportasi_ke_sekolah'    => $row['alat_transportasi_ke_sekolah'] ?? null,
            'berat_badan'                     => $row['berat_badan'] ?? null,
            'tinggi_badan'                    => $row['tinggi_badan'] ?? null,
            'golongan_darah'                  => $row['golongan_darah'] ?? null,
            'penyakit_yang_pernah_diderita'   => $row['penyakit_yang_pernah_diderita'] ?? null,
            'asal_SD'                         => $row['asal_sd'] ?? null,
            'nomor_sttb_SD'                   => $row['nomor_sttb_sd'] ?? null,
            'tanggal_sttb_SD'                 => $row['tanggal_sttb_sd'] ?? null,
            'lama_belajar_SD'                 => $row['lama_belajar_sd'] ?? null,
            'asal_SMP'                        => $row['asal_smp'] ?? null,
            'nomor_sttb_SMP'                  => $row['nomor_sttb_smp'] ?? null,
            'tanggal_sttb_SMP'                => $row['tanggal_sttb_smp'] ?? null,
            'lama_belajar_SMP'                => $row['lama_belajar_smp'] ?? null,
            'nama_ayah'                       => $row['nama_ayah'] ?? null,
            'tempat_lahir_ayah'               => $row['tempat_lahir_ayah'] ?? null,
            'tanggal_lahir_ayah'              => $row['tanggal_lahir_ayah'] ?? null,
            'alamat_ayah'                     => $row['alamat_ayah'] ?? null,
            'nomor_telepon_ayah'              => $row['nomor_telepon_ayah'] ?? null,
            'pekerjaan_ayah'                  => $row['pekerjaan_ayah'] ?? null,
            'penghasilan_perbulan_ayah'       => $row['penghasilan_perbulan_ayah'] ?? null,
            'pendidikan_ayah'                 => $row['pendidikan_ayah'] ?? null,
            'kewarganegaraan_ayah'            => $row['kewarganegaraan_ayah'] ?? null,
            'nama_ibu'                        => $row['nama_ibu'] ?? null,
            'tempat_lahir_ibu'                => $row['tempat_lahir_ibu'] ?? null,
            'tanggal_lahir_ibu'               => $row['tanggal_lahir_ibu'] ?? null,
            'alamat_ibu'                      => $row['alamat_ibu'] ?? null,
            'nomor_telepon_ibu'               => $row['nomor_telepon_ibu'] ?? null,
            'pekerjaan_ibu'                   => $row['pekerjaan_ibu'] ?? null,
            'penghasilan_perbulan_ibu'        => $row['penghasilan_perbulan_ibu'] ?? null,
            'pendidikan_ibu'                  => $row['pendidikan_ibu'] ?? null,
            'kewarganegaraan_ibu'             => $row['kewarganegaraan_ibu'] ?? null,
            'nama_wali'                       => $row['nama_wali'] ?? null,
            'alamat_wali'                     => $row['alamat_wali'] ?? null,
            'nomor_telepon_wali'              => $row['nomor_telepon_wali'] ?? null,
            'kegemaran_olah_raga'             => $row['kegemaran_olah_raga'] ?? null,
            'kegemaran_kemasyarakatan'        => $row['kegemaran_kemasyarakatan'] ?? null,
            'kegemaran_hasta_karya'           => $row['kegemaran_hasta_karya'] ?? null,
            'jurusan'                         => $row['jurusan'] ?? null,
        ]);
    }
}
