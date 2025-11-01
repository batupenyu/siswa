@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ship Services</h1>
    <a href="{{ route('ship_services.create') }}" class="btn btn-primary mb-3">Add Ship Service</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Days</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shipServices as $shipService)
            <tr>
                <td>{{ $shipService->id }}</td>
                <td>{{ $shipService->name }}</td>
                <td>{{ $shipService->days }}</td>
                <td>{{ $shipService->price }}</td>
                <td>
                    <a href="{{ route('ship_services.show', $shipService->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('ship_services.edit', $shipService->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('ship_services.destroy', $shipService->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection