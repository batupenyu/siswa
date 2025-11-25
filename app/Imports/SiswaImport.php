<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Find or create kelas by name
        $kelas = Kelas::firstOrCreate(['name' => $row['kelas']]);

        return new Siswa([
            'name' => $row['nama'],
            'nis' => $row['nis'],
            'npsn' => $row['npsn'] ?? null,
            'kelas_id' => $kelas->id,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nama' => 'required|string',
            '*.nis' => 'required',
            '*.kelas' => 'required|string',
            '*.npsn' => 'nullable|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.nama.required' => 'Nama is required.',
            '*.nis.required' => 'NIS is required.',
            '*.kelas.required' => 'Kelas is required.',
        ];
    }
}
