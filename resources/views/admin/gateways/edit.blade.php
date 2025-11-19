@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Edit Gateway</h2> </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.gateways.index') }}">Gateways</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Gateway</li> </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="gallery__area bg-style">
                    <div class="gallery__content">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-one" role="tabpanel"
                                aria-labelledby="nav-one-tab">

                                <form method="POST"
                                    action="{{ route('admin.gateways.update', $gateway->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-vertical__item bg-style">
                                        <div class="item-top mb-30">
                                            <h2>Edit Gateway: {{ $gateway->name }}</h2> </div>

                                        <div class="input__group mb-25">
                                            <label>Gateway Name</label>
                                            <input type="text" name="name" value="{{ $gateway->name }}" class="form-control" readonly>
                                        </div>

                                        <hr>
                                        <h4>Credentials</h4>

                                        @foreach ($gateway->credentials as $key => $value)
                                            <div class="input__group mb-25">
                                                <label>{{ ucwords(str_replace('_', ' ', $key)) }}</label>
                                                <input type="text" name="credentials[{{ $key }}]" value="{{ $value }}" class="form-control" placeholder="Enter {{ $key }}">
                                            </div>
                                        @endforeach

                                        <hr>

                                        <div class="input__group mb-25">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1" {{ $gateway->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $gateway->status == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                         <div class="input__group mb-25">
                                            <label>Mode</label>
                                            <select name="mode" class="form-control">
                                                <option value="1" {{ $gateway->mode == 1 ? 'selected' : '' }}>Live</option>
                                                <option value="0" {{ $gateway->mode == 0 ? 'selected' : '' }}>Sandbox</option>
                                            </select>
                                        </div>

                                        <div class="input__button mt-3">
                                            <button type="submit" class="btn btn-blue">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    @endpush
