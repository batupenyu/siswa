@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Holidays</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('holidays.create') }}" class="btn btn-primary mb-3">Add New Holiday</a>

    @if($holidays->isEmpty())
        <p>No holidays found.</p>
    @else
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;">Date</th>
                    <th style="text-align: center;">Description</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($holidays as $holiday)
                <tr>
                    <td style="text-align: center">{{ \Carbon\Carbon::parse($holiday->date)->format('d-m-Y') }}</td>
                    <td style="text-align: center">{{ $holiday->description }}</td>
                    <td style="text-align: center">
                        <a href="{{ route('holidays.edit', $holiday->id) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('holidays.destroy', $holiday->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this holiday?');" title="Delete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger p-1" style="line-height: 1;">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $holidays->links() }}
    @endif
</div>
@endsection
