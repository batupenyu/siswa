<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Http\Request;

class PegawaiExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    protected $search;
    protected $pangkat;

    public function __construct($search = null, $pangkat = null)
    {
        $this->search = $search;
        $this->pangkat = $pangkat;
    }

    public function collection()
    {
        $query = Pegawai::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('nip', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->pangkat && $this->pangkat !== '') {
            $query->where('pangkat', $this->pangkat);
        }

        return $query->orderBy('pangkat', 'ASC')->get([
            'nama',
            'nip',
            'jabatan',
            'pangkat',
            'integrasi',
            'no_karpeg',
            'jenis_kelamin',
            'tgl_lahir',
            'tempat_lahir',
            'tgl_tmt_jabatan',
            'tgl_tmt_pangkat',
        ]);
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIP',
            'Jabatan',
            'Pangkat',
            'Integrasi',
            'No Karpeg',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Tempat Lahir',
            'Tanggal TMT Jabatan',
            'Tanggal TMT Pangkat',
        ];
    }

    public function map($pegawai): array
    {
        return [
            $pegawai->nama,
            $pegawai->nip,
            $pegawai->jabatan,
            $pegawai->pangkat,
            $pegawai->integrasi,
            $pegawai->no_karpeg,
            $pegawai->jenis_kelamin,
            $pegawai->tgl_lahir,
            $pegawai->tempat_lahir,
            $pegawai->tgl_tmt_jabatan,
            $pegawai->tgl_tmt_pangkat,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
