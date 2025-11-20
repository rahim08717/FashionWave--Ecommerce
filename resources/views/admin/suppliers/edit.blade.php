@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Edit Supplier</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Supplier</li>
                            </ul>
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

                                <form method="POST" action="{{ route('admin.supplier.update', $supplier->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-vertical__item bg-style">

                                        <div class="item-top mb-30">
                                            <h2>Edit Supplier: {{ $supplier->name }}</h2>
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Supplier Name</label>
                                            <input type="text" name="name" value="{{ old('name', $supplier->name) }}"
                                                placeholder="Enter Supplier Name" required>
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Email (Optional)</label>
                                            <input type="email" name="email" value="{{ old('email', $supplier->email) }}"
                                                placeholder="Enter Email">
                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Phone (Optional)</label>
                                            <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}"
                                                placeholder="Enter Phone Number">
                                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Address (Optional)</label>
                                            <textarea name="address" placeholder="Enter Address">{{ old('address', $supplier->address) }}</textarea>
                                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="input__button mt-3">
                                            <button type="submit" class="btn btn-blue">Save Changes</button>
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
