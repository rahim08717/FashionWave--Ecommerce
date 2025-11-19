@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Create Admin</h2> <!-- Title changed -->
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Admin</li> <!-- Changed -->
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

                                <!-- Route changed -->
                                <form enctype="multipart/form-data" method="POST"
                                    action="{{ route('admin.admins.store') }}">
                                    @csrf
                                    <div class="form-vertical__item bg-style">
                                        <div class="item-top mb-30">
                                            <h2>Add New Admin</h2> <!-- Title changed -->
                                        </div>

                                        <!-- Fields updated for Admins -->
                                        <div class="input__group mb-25">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter Name">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Password</label>
                                            <input type="password" name="password" placeholder="Enter Password">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" placeholder="Confirm Password">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Admin Image (Optional)</label>
                                            <input type="file" name="image" class="putImage">
                                            <img class="admin_image " id="previewImage"
                                                style="max-width:180px; margin-top:10px; display:none;">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>

                                        <div class="input__button mt-3">
                                            <button type="submit" class="btn btn-blue">Save</button>
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
