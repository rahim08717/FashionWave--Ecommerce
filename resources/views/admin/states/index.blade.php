@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>States List</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.states.create') }}" class="btn btn-primary">Add State</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<br>
<br>
<br>
<br>
<br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SL.</th>
                <th>Country Name</th>
                <th>Name</th>
                <th>Shipping Charge</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($states as $state)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $state->CountryName->name }}</td>
                <td>{{ $state->name }}</td>
                <td>{{ $state->shipping_charge }}</td>
                <td>
                    <a href="{{ route('admin.states.edit', $state->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.states.destroy', $state->id) }}"
                          method="POST"
                          style="display: inline-block;"
                          onsubmit="return confirm('Are you sure you want to delete this state?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
