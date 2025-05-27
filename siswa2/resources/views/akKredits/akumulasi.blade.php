<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pegawai Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Predikat</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($akKredits as $akKredit)
            <tr>
                <td>{{ $akKredit->id }}</td>
                <td>{{ $akKredit->pegawai->nama ?? 'N/A' }}</td>
                <td>{{ $akKredit->startDate }}</td>
                <td>{{ $akKredit->endDate }}</td>
                <td>{{ $akKredit->predikat ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No AkKredit records found.</td>
            </tr>
        @endforelse
    </tbody>
</table>