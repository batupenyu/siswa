@extends('layouts.app')

@section('content')
<style>
    .bulan-table td {
        width: 8.33%;
        /* 100% / 12 months */
    }
</style>
<div class="container">
    <h1>Donasi Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Siswa: {{ $ipp->siswa->name ?? 'N/A' }}</h5>

            @php
            $allMonths = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $selectedMonths = explode(',', $ipp->bulan);
            @endphp

            <table class="table table-bordered bulan-table">
                <thead>
                    <tr>
                        @foreach($allMonths as $month)
                        <th>{{ $month }}</th>
                        @endforeach
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($allMonths as $month)
                        <td class="text-center">
                            @if(in_array($month, $selectedMonths))
                            <span style="color: green;">&#10003;</span> {{-- Checkmark --}}
                            @else
                            <span style="color: red;">&#10007;</span> {{-- Cross --}}
                            @endif
                        </td>
                        @endforeach
                        <td class="text-center">{{ count($selectedMonths) }}</td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>

    <a href="{{ route('ipps.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    <a href="{{ route('ipps.edit', $ipp->id) }}" class="btn btn-primary mt-3">Edit</a>

    <p class="mt-3"><strong>Nominal:</strong> {{ number_format($ipp->nominal, 2, ',', '.') }}</p>
    <p><strong>Terbilang:</strong> <em>{{ ucfirst(\App\Helpers\NumberHelper::terbilang($ipp->nominal)) }} rupiah</em></p>
</div>
@endsection