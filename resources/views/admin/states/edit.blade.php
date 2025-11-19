@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <h2>Edit State</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.states.update', $state->id) }}" method="POST">
            @csrf
            @method('PUT')
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

            <div class="mb-3">
                <label for="country_id" class="form-label">Country Name</label>
                <select name="country_id" id="country_id" class="form-control">
                    <option value="">-- Select Country --</option>

                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ $country->id == $state->country_id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">State Name</label>
                <input type="text" class="form-control" name="name" id="name"
                    value="{{ old('name', $state->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="shipping_charge" class="form-label">Shipping Charge</label>
                <input type="text" class="form-control" name="shipping_charge" id="shipping_charge"
                    value="{{ old('shipping_charge', $state->shipping_charge) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update State</button>
            <a href="{{ route('admin.states.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
