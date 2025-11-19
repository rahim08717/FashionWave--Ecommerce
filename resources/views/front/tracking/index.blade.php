@extends('front.layouts.app')
@section('title', 'user order tracking')
@section('description', 'order tracking description')
@section('keywords', 'order tracking keywords')

<style>
.order-progress {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 10px;
    padding: 25px;
    background: #fff;
}

.single-progress {
    flex: 1;
    text-align: center;
    position: relative;
    font-weight: 600;
    color: #6c757d;
}

.single-progress::after {
    content: '';
    position: absolute;
    top: 50%;
    right: -50%;
    transform: translateY(-50%);
    width: 100%;
    height: 4px;
    background: #dee2e6;
    z-index: 0;
}

.single-progress:last-child::after {
    display: none;
}

.single-progress.active span {
    color: #198754;
    font-weight: bold;
}

.single-progress.active::after {
    background: #198754;
}

.single-progress.cancelled span {
    color: #dc3545;
    font-weight: bold;
}
</style>



@section('content')

    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">Order tracking</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="{{ url('/') }}">Home</a></li>
                    <li class="page-item">Tracking Number {{ $order->tracking_number }}</li>
                </ul>
            </div>
        </div>
    </div>


    <!-- Profile Page area start here  -->
    <div class="profile-page-area section">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="user-profile-right-part">
                        <div class="user-profile-content-box my-order-page-box track-my-order-page-box">

                            <div class="d-flex justify-content-between align-items-center text-black mb-5">
                                <h2 class="user-profile-content-title">Track Order</h2>
                            </div>

                            <div class="order-progress bg-white">
                                @if ($order->order_status == 'canceled')
                                    <div class="single-progress cancelled text-center">
                                        <span class="text-danger fw-bold">❌ Order Cancelled</span>
                                    </div>
                                @else
                                    <div
                                        class="single-progress {{ in_array($order->order_status, ['pending', 'processing', 'shipped', 'delivered']) ? 'active' : '' }}">
                                        <span>Pending</span>
                                    </div>

                                    <div
                                        class="single-progress {{ in_array($order->order_status, ['processing', 'shipped', 'delivered']) ? 'active' : '' }}">
                                        <span>Processing</span>
                                    </div>

                                    <div
                                        class="single-progress {{ in_array($order->order_status, ['shipped', 'delivered']) ? 'active' : '' }}">
                                        <span>Shipped</span>
                                    </div>

                                    <div class="single-progress {{ $order->order_status == 'delivered' ? 'active' : '' }}">
                                        <span>Delivered</span>
                                    </div>
                                @endif
                            </div>


                            <div class="order-table mt-5">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->OrderItems as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->product_name }}
                                                    </td>
                                                    <td>
                                                        <div class="item-image-lsit d-flex align-items-center">
                                                            <div class="single-item">
                                                                <img class="order-image"
                                                                    src="{{ asset('front/assets/images/products/' . $item->thumb) }}"
                                                                    alt="images">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="amount">{{ $item->price }}</span>
                                                    </td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $item->total }}</td>
                                                </tr>
                                            @endforeach


                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Subtotal</td>
                                                <td>$ {{ $order->subtotal_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Tax</td>
                                                <td>$ {{ $order->tax_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Delivery Charge</td>
                                                <td>$ {{ $order->shipping_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Discount (-)</td>
                                                <td>$ {{ $order->discounted_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Grand Total</td>
                                                <td>$ {{ $order->total_amount }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
