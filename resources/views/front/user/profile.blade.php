@extends('front.layouts.app')
@section('title', 'user Profile')
@section('description', 'user description')
@section('keywords', 'user keywords')

@section('content')

    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">User Profile</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="http://127.0.0.1:8000">Home</a></li>
                    <li class="page-item">User Profile</li>
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
                                            class="fas fa-sign-out-alt"></i>  {{ __('Logout') }}</a></li>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="user-profile-right-part">
                        <div class="user-profile-content-box">
                            <div class="d-flex justify-content-between align-items-center text-black mb-5">
                                <h2 class="user-profile-content-title">My Profile</h2>
                                <a href="{{ route('user.profileEdit') }}" class="text-black">Edit My Profile</a>
                            </div>

                            <div class="row">
                                <!-- profile address box -->
                                <div class="col-md-4">
                                    <div class="address-box card">
                                        <h3 class="text-black">Personal Information</h3>
                                        <ul>
                                            <li>Name: {{ auth()->user()->name }}</li>
                                            <li>Email: {{ auth()->user()->email }}</li>
                                            <li>Address: {{ auth()->user()->street_address }}</li>
                                            <li>Zipcode: {{ auth()->user()->zipcode }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- order status box -->

                                <div class="col-md-4">
                                    <div class="address-box card">
                                        <h3 class="text-black">Address &amp; Order Status</h3>
                                        <ul>
                                            <li>Pending: {{  pendingstatus('pending') }}</li>
                                            <li>Processing: {{ processingstatus('processing') }}</li>
                                            <li>Shipped: {{ shippedstatus('shipped') }}</li>
                                            <li>Delivered: {{ deliveredstatus('delivered') }}</li>
                                            <li>Cancelled: {{ cancelledstatus('canceled') }}</li>

                                        </ul>
                                    </div>
                                </div>
                                <!-- profile address box -->
                                <div class="col-md-4">
                                    <div class="address-box card">
                                        <h3 class="text-black">Joining Date</h3>
                                        <ul>
                                            <li> Joined: {{ auth()->user()->created_at->format('d M,Y') }}</li>
                                            <li>Not to update yet</li>
                                        </ul>
                                    </div>
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
