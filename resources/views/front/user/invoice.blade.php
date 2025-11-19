@extends('front.layouts.app')
@section('title', 'order Invoice')
@section('description', 'user order invoice description')
@section('keywords', 'user ORDER invoice keywords')

@section('content')

    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">Order Invoice</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="{{ url('/') }}">Home</a></li>
                    <li class="page-item">Order Invoice</li>
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

                    <div class="d-flex justify-content-end mb-3">
                        <button onclick="printInvoice()" class="btn btn-light" style="font-size: 20px;">
                            🖨️ Print Invoice
                        </button>
                    </div>
                    <div class="container my-5" id="invoiceArea">
                        <div class="card shadow-lg border-0">
                            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('front/assets/images/' . getSetting('logo')) }}" alt="Shop Logo"
                                        style="height: 40px;">
                                    <div class="ms-3">
                                        <h3 class="mb-0">{{ getSetting('site_name') ?? 'Sundarban Shop' }}</h3>
                                        <small>{{ getSetting('address') ?? 'Khulna, Bangladesh' }}</small>
                                    </div>
                                </div>

                            </div>

                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <h5 class="text-primary mb-2" style="font-size: 16px;">📦 Sold To</h5>
                                        <p><strong>Name:</strong> {{ $order->shipping_name }}</p>
                                        <p><strong>Email:</strong> {{ $order->shipping_email }}</p>
                                        <p><strong>Phone:</strong> {{ $order->shipping_phone }}</p>
                                        <p><strong>Address:</strong> {{ $order->shipping_street_address }},
                                            {{ $order->shipping_state }}, {{ $order->shipping_zipcode }},
                                            {{ $order->shipping_country }}</p>
                                    </div>

                                    <div class="col-md-6 text-end">
                                        <h5 class="text-primary mb-2" style="font-size: 16px;">🏬 Sold From</h5>
                                        <p><strong>Shop:</strong> {{ getSetting('site_name') ?? 'Sundarban Shop' }}</p>
                                        <p><strong>Email:</strong>
                                            {{ getSetting('email') ?? 'info@sundarbanshopbd.com' }}</p>
                                        <p><strong>Phone:</strong> {{ getSetting('phone') ?? '01409426789' }}</p>
                                        <p><strong>Address:</strong>
                                            {{ getSetting('address') ?? 'Khulna, Bangladesh' }}</p>
                                    </div>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between mb-3">
                                    <h5 style="font-size: 16px;"><strong>Invoice #{{ $order->order_number }}</strong></h5>
                                    <p><strong>Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
                                </div>

                                <table class="table table-bordered text-center align-middle">
                                    <thead class="table-success">
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Qty</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->OrderItems as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->product_name }}</td>
                                                <td>{{ $item->color ?? 'Any' }}</td>
                                                <td>{{ $item->size ?? 'Any' }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ number_format($item->price, 2) }}</td>
                                                <td>${{ number_format($item->total, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-end">
                                    <div class="w-50">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th>Subtotal:</th>
                                                <td>${{ number_format($order->subtotal_amount ?? 0, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping:</th>
                                                <td>${{ number_format($order->shipping_amount ?? 0, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tax:</th>
                                                <td>${{ number_format($order->tax_amount ?? 0, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Discount:</th>
                                                <td>-${{ number_format($order->discounted_amount ?? 0, 2) }}</td>
                                            </tr>
                                            <tr class="table-success">
                                                <th>Total Amount:</th>
                                                <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <p>Thank you for shopping with
                                        <strong>{{ getSetting('site_name') ?? 'Sundarban Shop' }}</strong>!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 🖨️ Print Script --}}
                    <script>
                        function printInvoice() {
                            var printContents = document.getElementById('invoiceArea').innerHTML;
                            var originalContents = document.body.innerHTML;
                            document.body.innerHTML = printContents;
                            window.print();
                            document.body.innerHTML = originalContents;
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <!-- Profile Page area end here  -->





@endsection
