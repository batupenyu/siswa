<?php

namespace App\Exports;

use App\Models\SiswaProfil;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaProfilExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return SiswaProfil::all();
    }

    public function headings(): array
    {
        return [
            'nama_lengkap', 'nama_panggilan', 'tempat_lahir', 'tanggal_lahir',
            'jenis_kelamin', 'agama', 'kewarganegaraan', 'anak_ke_berapa',
            'jumlah_saudara_kandung', 'jumlah_saudara_tiri', 'jumlah_saudara_angkat',
            'bahasa_sehari_hari_di_rumah', 'alamat', 'nomor_telepon', 'tinggal_dengan',
            'jarak_tempat_tinggal_ke_sekolah', 'alat_transportasi_ke_sekolah',
            'berat_badan', 'tinggi_badan', 'golongan_darah', 'penyakit_yang_pernah_diderita',
            'asal_SD', 'nomor_sttb_SD', 'tanggal_sttb_SD', 'lama_belajar_SD',
            'asal_SMP', 'nomor_sttb_SMP', 'tanggal_sttb_SMP', 'lama_belajar_SMP',
            'nama_ayah', 'tempat_lahir_ayah', 'tanggal_lahir_ayah', 'alamat_ayah',
            'nomor_telepon_ayah', 'pekerjaan_ayah', 'penghasilan_perbulan_ayah',
            'pendidikan_ayah', 'kewarganegaraan_ayah',
            'nama_ibu', 'tempat_lahir_ibu', 'tanggal_lahir_ibu', 'alamat_ibu',
            'nomor_telepon_ibu', 'pekerjaan_ibu', 'penghasilan_perbulan_ibu',
            'pendidikan_ibu', 'kewarganegaraan_ibu',
            'nama_wali', 'alamat_wali', 'nomor_telepon_wali',
            'kegemaran_olah_raga', 'kegemaran_kemasyarakatan', 'kegemaran_hasta_karya', 'jurusan',
        ];
    }

    public function map($row): array
    {
        return [
            $row->nama_lengkap, $row->nama_panggilan, $row->tempat_lahir, $row->tanggal_lahir,
            $row->jenis_kelamin, $row->agama, $row->kewarganegaraan, $row->anak_ke_berapa,
            $row->jumlah_saudara_kandung, $row->jumlah_saudara_tiri, $row->jumlah_saudara_angkat,
            $row->bahasa_sehari_hari_di_rumah, $row->alamat, $row->nomor_telepon, $row->tinggal_dengan,
            $row->jarak_tempat_tinggal_ke_sekolah, $row->alat_transportasi_ke_sekolah,
            $row->berat_badan, $row->tinggi_badan, $row->golongan_darah, $row->penyakit_yang_pernah_diderita,
            $row->asal_SD, $row->nomor_sttb_SD, $row->tanggal_sttb_SD, $row->lama_belajar_SD,
            $row->asal_SMP, $row->nomor_sttb_SMP, $row->tanggal_sttb_SMP, $row->lama_belajar_SMP,
            $row->nama_ayah, $row->tempat_lahir_ayah, $row->tanggal_lahir_ayah, $row->alamat_ayah,
            $row->nomor_telepon_ayah, $row->pekerjaan_ayah, $row->penghasilan_perbulan_ayah,
            $row->pendidikan_ayah, $row->kewarganegaraan_ayah,
            $row->nama_ibu, $row->tempat_lahir_ibu, $row->tanggal_lahir_ibu, $row->alamat_ibu,
            $row->nomor_telepon_ibu, $row->pekerjaan_ibu, $row->penghasilan_perbulan_ibu,
            $row->pendidikan_ibu, $row->kewarganegaraan_ibu,
            $row->nama_wali, $row->alamat_wali, $row->nomor_telepon_wali,
            $row->kegemaran_olah_raga, $row->kegemaran_kemasyarakatan, $row->kegemaran_hasta_karya, $row->jurusan,
        ];
    }
}
