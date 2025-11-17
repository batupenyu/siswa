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
            'nama' => $row['nama'],
            'nip' => $row['nip'],
            'jabatan' => $row['jabatan'],
            'pangkat' => $row['pangkat'],
        ]);
    }
}
