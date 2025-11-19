@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <h2>Create New State</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.states.store') }}" method="POST">
            @csrf
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

                <div class="mb-3">
                    <label for="country_id" class="form-label">Country Name</label>
                    <select name="country_id" id="country_id">
                        required>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">State Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="shipping_charge" class="form-label">Shipping Charge</label>
                    <input type="text" class="form-control" name="shipping_charge" id="shipping_charge"
                        value="{{ old('shipping_charge') }}" required>
                </div>

                <button type="submit" class="btn btn-success">Save State</button>

                <a href="{{ route('admin.states.index') }}" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
@endsection
