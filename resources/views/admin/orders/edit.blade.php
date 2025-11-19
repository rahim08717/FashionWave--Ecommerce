@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="h3 font-weight-bold text-primary">Edit Order #{{ $order->order_number }}</h2>
                    </div>
                    <div>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white font-weight-bold py-3">
                            <i class="fas fa-tasks mr-2 text-primary"></i> Order Status
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Order Status</label>
                                <select name="order_status" class="form-control">
                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                                        Processing</option>
                                    <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>
                                        Delivered</option>
                                    <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                          <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>
                                        shipped</option>
                                </select>
                            </div>
                            <div class="input__group mb-25">
                                <label>Payment Status</label>
                                <select name="payment_status" class="form-control">

                                    {{-- 1. Pending (এটিই মূলত Unpaid হিসেবে কাজ করবে) --}}
                                    <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>
                                        Pending (Unpaid)
                                    </option>

                                    {{-- 2. Paid --}}
                                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>
                                        Paid
                                    </option>

                                    {{-- 3. Failed --}}
                                    <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>
                                        Failed
                                    </option>

                                    {{-- 4. Refunded --}}
                                    <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>
                                        Refunded
                                    </option>

                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Payment Method</label>
                                <select name="payment_method" class="form-control">
                                    <option value="cod" {{ $order->payment_method == 'cod' ? 'selected' : '' }}>Cash on
                                        Delivery</option>
                                    <option value="paypal" {{ $order->payment_method == 'paypal' ? 'selected' : '' }}>
                                        PayPal</option>
                                    <option value="stripe" {{ $order->payment_method == 'stripe' ? 'selected' : '' }}>
                                        Stripe</option>
                                    <option value="sslcommerz"
                                        {{ $order->payment_method == 'sslcommerz' ? 'selected' : '' }}>Sslcommerz</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Tracking Number</label>
                                <input type="text" name="tracking_number" value="{{ $order->tracking_number }}"
                                    class="form-control">
                            </div>

                            <button type="submit" class="btn btn-blue btn-block">Update Order</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white font-weight-bold py-3">
                            <i class="fas fa-map-marker-alt mr-2 text-primary"></i> Update Billing Address
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Full Name</label>
                                    <input type="text" name="billing_name" value="{{ $order->billing_name }}"
                                        class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone</label>
                                    <input type="text" name="billing_phone" value="{{ $order->billing_phone }}"
                                        class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Street Address</label>
                                    <input type="text" name="billing_street_address"
                                        value="{{ $order->billing_street_address }}" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>City</label>
                                    <input type="text" name="billing_city" value="{{ $order->billing_city }}"
                                        class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>State</label>
                                    <select name="billing_state" class="form-control">
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                {{ $order->billing_state == $state->id ? 'selected' : '' }}>
                                                {{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Zipcode</label>
                                    <input type="text" name="billing_zipcode" value="{{ $order->billing_zipcode }}"
                                        class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Country</label>
                                    <select name="billing_country" class="form-control">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ $order->billing_country == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
