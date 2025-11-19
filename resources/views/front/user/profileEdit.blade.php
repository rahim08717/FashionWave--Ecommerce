@extends('front.layouts.app')
@section('title', 'user Profile Edit')
@section('description', 'user profile Edit description')
@section('keywords', 'user Profile Edit keywords')

@section('content')
    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">Update Profile</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="http://127.0.0.1:8000">Home</a></li>
                    <li class="page-item">Update Profile</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end here  -->

    <!-- Profile Page area start here  -->
    <div class="profile-page-area section">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="section-wrap account-page-sidemenu user-profile-sidebar">
                        <nav class="account-page-menu">
                            <ul>
                                <li class="active"><a href="{{ route('user.profile') }}"><i class="fas fa-user"></i>My
                                        Profile</a></li>
                                <li class=""><a href="{{ route('user.order') }}"><i class="fas fa-box-open"></i>My
                                        Order</a></li>
                                <li class=""><a href="{{ route('user.review') }}"><i class="fas fa-user-edit"></i>My
                                        Review</a></li>
                                <li class=""><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                            class="fas fa-user-edit"></i> {{ __('Logout') }}</a></li>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="user-profile-right-part">
                        <div class="user-profile-content-box edit-user-profile-page-box">

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="true">
                                        Change Profile Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-password-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-password" type="button" role="tab"
                                        aria-controls="pills-password" aria-selected="false">
                                        Change Password</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">
                                    <div class="profile-form mt-5">


                                        <form enctype="multipart/form-data" action="{{ route('user.profile.update') }}"
                                            method="POST">
                                            @csrf


                                            <div class="profile-top mb-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="profile-image position-relative">
                                                        <img class="avater-image rounded-circle" id="previewImage"
                                                            src="{{ Auth::user()->image ? asset('front/assets/images/' . Auth::user()->image) : asset('front/assets/images/user-avatar.png') }}"
                                                            alt="Profile Image" width="120" height="120">
                                                        <div class="custom-fileuplode position-absolute bottom-0 end-0">
                                                            <label for="fileUpload"
                                                                class="file-uplode-btn btn btn-sm btn-primary rounded-circle">
                                                                <i class="fas fa-camera"></i>
                                                            </label>
                                                            <input type="file" id="fileUpload" name="image"
                                                                class="d-none" accept="image/*"
                                                                onchange="previewFile(event)">
                                                        </div>
                                                    </div>
                                                    <div class="author-info ms-3">
                                                        <h3 class="mb-0">{{ Auth::user()->name }}</h3>
                                                        <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- Name -->
                                                <div class="col-lg-4 col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="name">Full Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" value="{{ old('name', Auth::user()->name) }}"
                                                            required>
                                                    </div>
                                                </div>

                                                <!-- Email -->
                                                <div class="col-lg-4 col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="email">Email Address</label>
                                                        <input type="email" class="form-control" id="email"
                                                            name="email"
                                                            value="{{ old('email', Auth::user()->email) }}" required>
                                                    </div>
                                                </div>

                                                <!-- Street Address -->
                                                <div class="col-lg-4 col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="street_address">Street Address</label>
                                                        <input type="text" class="form-control" id="street_address"
                                                            name="street_address"
                                                            value="{{ old('street_address', Auth::user()->street_address) }}">
                                                    </div>
                                                </div>

                                                <!-- ✅ Zip Code -->
                                                <div class="col-lg-4 col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="zipcode">Zip Code</label>
                                                        <input type="text" class="form-control" id="zipcode"
                                                            name="zipcode"
                                                            value="{{ old('zipcode', Auth::user()->zipcode) }}"
                                                            placeholder="e.g. 9100">
                                                    </div>
                                                </div>

                                                <!-- Submit -->
                                                <div class="col-lg-12">
                                                    <div class="form-button text-center mt-3">
                                                        <button type="submit" class="btn btn-success btn-lg px-5 py-3 ">
                                                            Update Profile
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        {{-- Preview uploaded image --}}
                                        <script>
                                            function previewFile(event) {
                                                const output = document.getElementById('previewImage');
                                                output.src = URL.createObjectURL(event.target.files[0]);
                                                output.onload = function() {
                                                    URL.revokeObjectURL(output.src);
                                                }
                                            }
                                        </script>



                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-password" role="tabpanel"
                                    aria-labelledby="pills-password-tab">
                                    <form class="change-password-form mt-5" method="POST"
                                        action="{{ route('user.changePassword') }}">
                                        @csrf

                                        <div class="row g-3">
                                            <!-- Current Password -->
                                            <div class="col-md-12">
                                                <label for="CurrentPassword" class="form-label fw-semibold">Current
                                                    Password</label>
                                                <input type="password" class="form-control" id="CurrentPassword"
                                                    name="current_password" placeholder="Enter your current password"
                                                    required>
                                            </div>

                                            <!-- New Password -->
                                            <div class="col-md-12">
                                                <label for="NewPassword" class="form-label fw-semibold">New
                                                    Password</label>
                                                <input type="password" class="form-control" id="NewPassword"
                                                    name="new_password" placeholder="Enter a new password" required>
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="col-md-12">
                                                <label for="ConfirmPassword" class="form-label fw-semibold">Confirm
                                                    Password</label>
                                                <input type="password" class="form-control" id="ConfirmPassword"
                                                    name="confirm_password" placeholder="Re-enter your new password"
                                                    required>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-12 text-center mt-4">
                                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-3">
                                                    <i class="bi bi-shield-lock-fill me-2"></i> Update Password
                                                </button>
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
    </div>
    <!-- Profile Page area end here  -->




@endsection
