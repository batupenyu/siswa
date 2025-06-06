<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    .table-bordered {
      border: 1px solid;
      border-collapse: collapse;
      /* margin: 20px auto; */
      width: 80%;
    }

    .table-bordered td,
    .table-bordered th {
      border: 1px solid;
      /* padding: 8px; */
    }

    .table-borderless {
      border: none;
      border-collapse: separate;
      /* margin: 20px auto; */
      width: 80%;
    }

    .table-borderless td,
    .table-borderless th {
      border: none;
      /* padding: 8px; */
    }

    tr {
      height: 10pt;
      line-height: 0.9;
      padding: 0;
      margin: 0;
    }
  </style>
</head>

<body style="margin-top: 1.5cm;">
  <table class="table-bordered" style="font-size: 11pt">
    <tr>
      <td style="width: 325px"></td>
      <td style="width: 325px">
        <table class="table-borderless">
          <tr>
            <td style="width: 30px">I.</td>
            <td style="width: 150px">Berangkat dari</td>
            <td>:</td>
            <td style="width: 150px"> .................... </td>
          </tr>
          <tr>
            <td></td>
            <td>(Tempat Kedudukan)</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td>ke</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>pada tanggal</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>kepala</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <br>
          <br>
          <br>
          <tr>
            <td></td>
            <td colspan="3">
              @if($stPegawai->pegawais->isNotEmpty())
              @php
              $firstPegawai = $stPegawai->pegawais->first();
              $namaParts = explode(' ', $firstPegawai->jabatan);
              $firstName = $namaParts[0];
              $lastName = isset($namaParts[1]) ? $namaParts[1] : '';
              @endphp
              {{-- {{ $firstName }} --}}
              {{-- {{ $lastName }} --}}
              @if ($firstName == 'Kepala')
              {{ $kpaNama}}
              <br>
              NIP.{{ $kpaNip }}
              @else
              {{ $atasanNama}}
              <br>
              NIP.{{ $atasanNip }}
              @endif
              @else
              -
              @endif
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table class="table-borderless">
          <tr>
            <td style="width: 30px">II.</td>
            <td style="width: 150px">Tiba di</td>
            <td>:</td>
            <td style="width: 150px"> .................... </td>
          </tr>
          <tr>
            <td></td>
            <td>Pada tanggal</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>kepala</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <br>
          <br>
          <br>
          <br>
          <br>
          <tr>
            <td></td>
            <td>(...........................)</td>
          </tr>
          <tr>
            <td></td>
            <td>NIP</td>
          </tr>
        </table>
      </td>
      <td>
        <table class="table-borderless">
          <tr>
            <td style="width: 30px"></td>
            <td style="width: 150px">Berangkat dari</td>
            <td>:</td>
            <td style="width: 150px"> .................... </td>
          </tr>
          <tr>
            <td></td>
            <td>(Tempat Kedudukan)</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td>ke</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>pada tanggal</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>kepala</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <br>
          <br>
          <br>
          <tr>
            <td></td>
            <td>(...........................)</td>
          </tr>
          <tr>
            <td></td>
            <td>NIP</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table class="table-borderless">
          <tr>
            <td style="width: 30px">III.</td>
            <td style="width: 150px">Tiba di</td>
            <td>:</td>
            <td style="width: 150px"> .................... </td>
          </tr>
          <tr>
            <td></td>
            <td>Pada tanggal</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>kepala</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <br>
          <br>
          <br>
          <br>
          <br>
          <tr>
            <td></td>
            <td>(...........................)</td>
          </tr>
          <tr>
            <td></td>
            <td>NIP</td>
          </tr>
        </table>
      </td>
      <td>
        <table class="table-borderless">
          <tr>
            <td style="width: 30px"></td>
            <td style="width: 150px">Berangkat dari</td>
            <td>:</td>
            <td style="width: 150px"> .................... </td>
          </tr>
          <tr>
            <td></td>
            <td>(Tempat Kedudukan)</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td>ke</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>pada tanggal</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>kepala</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <br>
          <br>
          <br>
          <tr>
            <td></td>
            <td>(...........................)</td>
          </tr>
          <tr>
            <td></td>
            <td>NIP</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table class="table-borderless">
          <tr>
            <td style="width: 30px">IV.</td>
            <td style="width: 150px">Tiba di</td>
            <td>:</td>
            <td style="width: 150px"> .................... </td>
          </tr>
          <tr>
            <td></td>
            <td>Pada tanggal</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>kepala</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <br>
          <br>
          <br>
          <br>
          <br>
          <tr>
            <td></td>
            <td>(...........................)</td>
          </tr>
          <tr>
            <td></td>
            <td>NIP</td>
          </tr>
        </table>
      </td>
      <td>
        <table class="table-borderless">
          <tr>
            <td style="width: 30px"></td>
            <td style="width: 150px">Berangkat dari</td>
            <td>:</td>
            <td style="width: 150px"> .................... </td>
          </tr>
          <tr>
            <td></td>
            <td>(Tempat Kedudukan)</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td>ke</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>pada tanggal</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>kepala</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <br>
          <br>
          <br>
          <tr>
            <td></td>
            <td>(...........................)</td>
          </tr>
          <tr>
            <td></td>
            <td>NIP</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table class="table-borderless">
          <tr>
            <td style="width: 30px">V.</td>
            <td style="width: 150px">Tiba di</td>
            <td>:</td>
            <td style="width: 150px"> .................... </td>
          </tr>
          <tr>
            <td></td>
            <td>Pada tanggal</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>kepala</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <br>
          <br>
          <br>
          <br>
          <br>
          <tr>
            <td></td>
            <td>(...........................)</td>
          </tr>
          <tr>
            <td></td>
            <td>NIP</td>
          </tr>
        </table>
      </td>
      <td>
        <table class="table-borderless">
          <tr>
            <td style="width: 30px"></td>
            <td style="width: 150px">Berangkat dari</td>
            <td>:</td>
            <td style="width: 150px"> .................... </td>
          </tr>
          <tr>
            <td></td>
            <td>(Tempat Kedudukan)</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td>ke</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>pada tanggal</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>kepala</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <br>
          <br>
          <br>
          <tr>
            <td></td>
            <td>(...........................)</td>
          </tr>
          <tr>
            <td></td>
            <td>NIP</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table class="table-borderless">
          <tr>
            <td style="width: 30px">VI.</td>
            <td style="width: 150px">Tiba di</td>
            <td>:</td>
            <td style="width: 150px"> .................... </td>
          </tr>
          <tr>
            <td></td>
            <td>Pada tanggal</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <tr>
            <td></td>
            <td>kepala</td>
            <td>:</td>
            <td>....................</td>
          </tr>
          <br>
          <br>
          <br>
          <tr>
            <td></td>
            <td colspan="3" style="text-transform: uppercase">
              @if($stPegawai->pegawais->isNotEmpty())
              @php
              $firstPegawai = $stPegawai->pegawais->first();
              $namaParts = explode(' ', $firstPegawai->jabatan);
              $firstName = $namaParts[0];
              $lastName = isset($namaParts[1]) ? $namaParts[1] : '';
              @endphp
              {{-- {{ $firstName }} --}}
              {{-- {{ $lastName }} --}}
              @if ($firstName == 'Kepala')
              {{ $kpaNama}}
              <br>
              NIP.{{ $kpaNip }}
              @else
              {{ $atasanNama}}
              <br>
              NIP.{{ $atasanNip }}
              @endif
              @else
              -
              @endif
            </td>
          </tr>
        </table>
      </td>
      <td style="vertical-align: top; text-align: justify; padding: 10px;">
        Telah diperiksa, dengan keterangan bahwa perjalanan tersebut diatas benar dilakukan atas perintahnya dan
        semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat­-singkatnya
      </td>
    </tr>
    <tr>
      <td>VII. <span style="padding-left: 10px">Catatan lain-lain</span>
      </td>
      <td></td>
    </tr>
    <tr>
      <td colspan="2" style="vertical-align: top; text-align: justify">
        <table class="table-borderless" style="width: 100%">
          <tr>
            <td style="vertical-align:top">
              VIII.
            </td>
            <td style="text-align: justify">
              PERHATIAN <br>
              Pejabat yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan
              tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan-peraturan
              Keuangan Negara apabila negara menderita rugi akibat kesalahan, kelalaian. dan kealpaannva.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <p style="text-align: center;padding-left:400px; font-size: 11pt; margin-top: 20px;">
    {{-- ditetapkan di : <br>
    pada tanggal : <br> --}}
    {{-- Pejabat Pelaksana Teknis Kegiatan (PPTK) <br> --}}
    {{-- Pejabat Pembuat Komitmen (PPK) <br> --}}
    {{-- {{$kpaJabatan}} <br> --}}
    @php
    $jabatanParts = explode(' ', $penilai->jabatan);
    $firstJabatan = $jabatanParts[0];
    @endphp
    {{-- {{$penilai->jabatan}} --}}
    {{$firstJabatan}}
    {{$penilai->unitkerja}}
    <br>
    <br>
    <br>
    <br>
    {{-- <span style="text-transform: uppercase; font-weight: bold;">{{ $kpaNama }}</span> --}}
    <span style="text-transform: uppercase; font-weight: bold;">{{ $penilai->nama }}</span>
    <br>
    {{-- NIP. {{ $kpaNip }} --}}
    NIP. {{ $penilai->nip }}
  </p>
</body>

</html>