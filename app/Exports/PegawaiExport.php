<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class PegawaiExport implements FromCollection, WithHeadings
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
}
