@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Edit Customer</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Customer</li>
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

                                <form enctype="multipart/form-data" method="POST"
                                    action="{{ route('admin.customers.update', $customer->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-vertical__item bg-style">
                                        <div class="item-top mb-30">
                                            <h2>Edit Customer</h2>
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ $customer->name }}" placeholder="Enter Name">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ $customer->email }}" placeholder="Enter Email">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Password</label>
                                            <input type="password" name="password" placeholder="Leave blank to keep unchanged">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" placeholder="Confirm new password">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Street Address</label>
                                            <input type="text" name="street_address" value="{{ $customer->street_address }}" placeholder="Enter Street Address">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Zipcode</label>
                                            <input type="text" name="zipcode" value="{{ $customer->zipcode }}" placeholder="Enter Zipcode">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Customer Image (Optional)</label>
                                            <input type="file" name="image" class="putImage">
                                            <img src="{{ asset('front/assets/images/' . $customer->image) }}"
                                                class="admin_image" id="previewImage"
                                                style="max-width:180px; margin-top:10px;display: {{ $customer->image ? 'block' : 'none' }}; ">
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
    <script>
        $(document).ready(function() {
            $('.putImage').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                    $('#previewImage').show();
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
