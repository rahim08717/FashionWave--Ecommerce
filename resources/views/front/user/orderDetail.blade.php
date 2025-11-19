@extends('front.layouts.app')
@section('title', 'user Order Detail')
@section('description', 'user order description')
@section('keywords', 'user ORDER keywords')

@section('content')

    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">Order Detail</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="{{ url('/') }}">Home</a></li>
                    <li class="page-item">Order Detail</li>
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
                    <div class="container my-5">
                        <div class="card shadow-lg border-0">
                            <div class="card-header bg-success text-white">
                                <h4 class="mb-0 fs-2">Order Details (Order #{{ $order->order_number }})</h4>
                            </div>

                            <div class="card-body">
                                <!-- Shipping Information -->
                                <h5 class="text-primary mb-3 fs-3">🏠 Shipping Information</h5>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <p><strong>Name:</strong> {{ $order->shipping_name }}</p>
                                        <p><strong>Email:</strong> {{ $order->shipping_email }}</p>
                                        <p><strong>Phone:</strong> {{ $order->shipping_phone }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Address:</strong> {{ $order->shipping_street_address }}</p>
                                         <p><strong>State: </strong>{{ $order->shipping_state }}</p>
                                        <p><strong>Zip Code:</strong> {{ $order->shipping_zipcode }}</p>
                                        <p><strong>Country:</strong> {{ $order->shipping_country }}</p>
                                    </div>
                                </div>

                                <hr>

                                <!-- Billing Information -->
                                <h5 class="text-primary mb-3 fs-3">🧾 Billing Information</h5>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <p><strong>Name:</strong> {{ $order->billing_name }}</p>
                                        <p><strong>Email:</strong> {{ $order->billing_email }}</p>
                                        <p><strong>Phone:</strong> {{ $order->billing_phone }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Address:</strong> {{ $order->billing_street_address }}</p>
                                        <p><strong>State: </strong>{{ $order->billing_state }}</p>
                                        <p><strong>Zip Code:</strong> {{ $order->billing_zipcode }}</p>
                                        <p><strong>Country:</strong> {{ $order->billing_country }}</p>
                                    </div>
                                </div>

                                <hr>

                                <!-- Additional Information -->
                                <h5 class="text-primary mb-3 fs-3">✍️ Additional Information</h5>
                                <p>{{ 'No additional information provided.' }}</p>

                                <hr>

                                <!-- Payment Method -->
                                <h5 class="text-primary mb-3 fs-3">💳 Payment Method</h5>
                                <p><strong>Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                                <p><strong>Status:</strong>{{ ucfirst($order->payment_status) }} </p>



                                <hr>

                                <!-- Order Items -->
                                <h5 class="text-primary mb-3 fs-3">🛍️ Ordered Items</h5>
                                <table class="table table-bordered">
                                    <thead class="table-success">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->OrderItems as $item)
                                            <tr>
                                                <td>{{ $item->product_name }}</td>
                                                <td>{{ $item->color??"Any color" }}</td>
                                                <td>{{ $item->size ??"Any Size" }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ number_format($item->price, 2) }}</td>
                                                <td>${{ number_format($item->total, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Profile Page area end here  -->





@endsection
