<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PegawaiExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting, WithTitle, WithStyles
{
    protected $search;
    protected $pangkat;

    public function __construct($search = null, $pangkat = null)
    {
        $this->search = $search;
        $this->pangkat = $pangkat;
    }

    public function query()
    {
        return Pegawai::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nama', 'like', "%{$this->search}%")
                        ->orWhere('nip', 'like', "%{$this->search}%");
                });
            })
            ->when($this->pangkat, fn($q) => $q->where('pangkat', $this->pangkat));
    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            'Jabatan',
            'Pangkat',
            'Status Kepegawaian',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'Alamat',
            'TMT CPNS',
            'TMT Pangkat',
            'TMT Jabatan',
            'No. Karpeg',
            'Integrasi',
        ];
    }

    public function map($pegawai): array
    {
        // Pastikan NIP dijadikan STRING dan ditambahkan karakter non-numeric di awal (opsional)
        $nip = (string) $pegawai->nip;

        // 👇 INI KUNCI: Gunakan spasi atau karakter invisible jika petik tunggal tidak cukup
        // Alternatif: gunakan \u{200B} (zero-width space) — tapi lebih aman pakai petik + pastikan format teks
        return [
            $nip, // Cukup kirim string biasa — format teks akan di-handle oleh styles
            $pegawai->nama,
            $pegawai->jabatan,
            $pegawai->pangkat,
            $pegawai->status_kepegawaian,
            $pegawai->jenis_kelamin,
            $pegawai->tempat_lahir,
            $pegawai->tgl_lahir ? $pegawai->tgl_lahir->format('Y-m-d') : null,
            $pegawai->agama,
            $pegawai->alamat,
            $pegawai->tgl_tmt_cpns ? $pegawai->tgl_tmt_cpns->format('Y-m-d') : null,
            $pegawai->tgl_tmt_pangkat ? $pegawai->tgl_tmt_pangkat->format('Y-m-d') : null,
            $pegawai->tgl_tmt_jabatan ? $pegawai->tgl_tmt_jabatan->format('Y-m-d') : null,
            $pegawai->no_karpeg,
            $pegawai->integrasi,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // ☑️ Ini sangat penting: pastikan kolom A (NIP) benar-benar diformat sebagai teks
        $sheet->getStyle('A:A')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);

        // Opsional: atur lebar kolom agar NIP terlihat utuh
        $sheet->getColumnDimension('A')->setWidth(20);
    }

    public function title(): string
    {
        return 'Data Pegawai';
    }
}
