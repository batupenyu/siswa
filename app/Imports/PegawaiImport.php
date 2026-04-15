<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PegawaiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Pegawai([
            'nama' => $row['nama'] ?? $row['name'], // Handle both 'name' and 'nama' columns
            'nip' => $row['nip'],
            'jabatan' => $row['jabatan'],
            'pangkat' => $row['pangkat'] ?? null,
            'status_kepegawaian' => $row['status_kepegawaian'] ?? null,
            'agama' => $row['agama'] ?? null,
            'alamat' => $row['alamat'] ?? null,
            'tgl_tmt_cpns' => $row['tgl_tmt_cpns'] ?? null,
            'integrasi' => $row['integrasi'] ?? null,
            'no_karpeg' => $row['no_karpeg'] ?? null,
            'jenis_kelamin' => $row['jenis_kelamin'] ?? null,
            'tgl_lahir' => $row['tgl_lahir'] ?? null,
            'tempat_lahir' => $row['tempat_lahir'] ?? null,
            'tgl_tmt_jabatan' => $row['tgl_tmt_jabatan'] ?? null,
            'tgl_tmt_pangkat' => $row['tgl_tmt_pangkat'] ?? null,
        ]);
    }
}
