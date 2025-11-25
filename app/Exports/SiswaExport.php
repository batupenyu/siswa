<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Siswa::with('kelas')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIS',
            'NPSN',
            'Kelas',
        ];
    }

    public function map($siswa): array
    {
        return [
            $siswa->name,
            $siswa->nis,
            $siswa->npsn,
            $siswa->kelas ? $siswa->kelas->name : '',
        ];
    }
}
