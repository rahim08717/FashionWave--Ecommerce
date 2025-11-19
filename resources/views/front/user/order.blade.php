@extends('front.layouts.app')
@section('title', 'user order')
@section('description', 'order description')
@section('keywords', 'order keywords')

@section('content')

    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">My Order</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="http://127.0.0.1:8000">Home</a></li>
                    <li class="page-item">My Order</li>
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
                                <li class=""><a href="{{ route('user.profile') }}"><i class="fas fa-user"></i>My
                                        Profile</a></li>
                                <li class="active"><a href="{{ route('user.order') }}"><i class="fas fa-box-open"></i>My
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
                        <div class="user-profile-content-box my-order-page-box">

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-active-order-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-active-order" type="button" role="tab"
                                        aria-controls="pills-active-order" aria-selected="true">
                                        All Order
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-delivered-order-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-delivered-order" type="button" role="tab"
                                        aria-controls="pills-delivered-order" aria-selected="false">
                                        Delivered Order
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-cancelled-order-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-cancelled-order" type="button" role="tab"
                                        aria-controls="pills-cancelled-order" aria-selected="false">
                                        Cancelled Order
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-pending-order-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-pending-order" type="button" role="tab"
                                        aria-controls="pills-pending-order" aria-selected="false">
                                        Pending Order
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-active-order" role="tabpanel"
                                    aria-labelledby="pills-active-order-tab">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>Order Id</th>
                                                    <th>Order Status</th>
                                                    <th>Payment Status</th>
                                                    <th>Total Amount</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>
                                                            <p>Order Id: {{ $order->order_number }}</p>
                                                        </td>
                                                        <td>
                                                            <p>order statuse: {{ $order->order_status }}</p>
                                                        </td>
                                                        <td>Payment Status: {{ $order->payment_status }}</td>
                                                        <td>${{ $order->total_amount }}</td>
                                                        <td>{{ $order->created_at->format('F d, Y') }}</td>
                                                        <td>

                                                            <a
                                                               title="order tracking" href="{{ route('order.tracking', $order->tracking_number) }}"><i
                                                                    class="fas fa-user-cog"></i></a>
                                                            <a title="more detail" href="{{ route('user.order.detail', $order->id) }}"><i
                                                                    class="fas fa-eye"></i></a>
                                                            <a title="invoice" href="{{ route('order.invoice',$order->id)}}"><i class="fas fa-file-invoice"></i></a>
                                                           @if ($order->payment_status =="failed" || $order->payment_status="pending")
                                                           <a title="payment status" href="#"><i class="fas fa-file-invoice-dollar"></i></a>
                                                           @endif
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-delivered-order" role="tabpanel"
                                    aria-labelledby="pills-delivered-order-tab">
                                    <div class="order-table mt-5">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>Order Id</th>
                                                        <th>Order Status</th>
                                                        <th>Payment Status</th>
                                                        <th>Total Amount</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($deleverdOrders as $Dorder)
                                                        <tr>
                                                            <td>
                                                                <p>Order Id: {{ $Dorder->order_number }}</p>
                                                            </td>
                                                            <td>
                                                                <p>order statuse: {{ $Dorder->order_status }}</p>
                                                            </td>
                                                            <td>Payment Status: {{ $Dorder->payment_status }}</td>
                                                            <td>${{ $Dorder->total_amount }}</td>
                                                            <td>{{ $Dorder->created_at->format('F d, Y') }}</td>
                                                            <td><a
                                                                    href="{{ route('order.tracking', $Dorder->tracking_number) }}"><i
                                                                        class="fas fa-user-cog"></i></a>
                                                                <a href="{{ route('user.order.detail', $Dorder->id) }}"><i
                                                                        class="fas fa-eye"></i></a>
                                                                <a href="#"><i class="fas fa-file-invoice"></i></a>
                                                                <a href="#"><i
                                                                        class="fas fa-file-invoice-dollar"></i></a>

                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-cancelled-order" role="tabpanel"
                                    aria-labelledby="pills-cancelled-order-tab">
                                    <div class="order-table mt-5">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>Order Id</th>
                                                        <th>Order Status</th>
                                                        <th>Payment Status</th>
                                                        <th>Total Amount</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($canceledOrders as $Corder)
                                                        <tr>
                                                            <td>
                                                                <p>Order Id: {{ $Corder->order_number }}</p>
                                                            </td>
                                                            <td>
                                                                <p>order statuse: {{ $Corder->order_status }}</p>
                                                            </td>
                                                            <td>Payment Status: {{ $Corder->payment_status }}</td>
                                                            <td>${{ $Corder->total_amount }}</td>
                                                            <td>{{ $Corder->created_at->format('F d, Y') }}</td>
                                                            <td><a
                                                                    href="{{ route('order.tracking', $Corder->tracking_number) }}"><i
                                                                        class="fas fa-user-cog"></i></a>
                                                                <a href="{{ route('user.order.detail', $Corder->id) }}"><i
                                                                        class="fas fa-eye"></i></a>
                                                                <a href="#"><i class="fas fa-file-invoice"></i></a>
                                                                <a href="#"><i
                                                                        class="fas fa-file-invoice-dollar"></i></a>

                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="pills-pending-order" role="tabpanel"
                                    aria-labelledby="pills-pending-order-tab">
                                    <div class="order-table mt-5">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>Order Id</th>
                                                        <th>Order Status</th>
                                                        <th>Payment Status</th>
                                                        <th>Total Amount</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pendingOrders as $Porder)
                                                        <tr>
                                                            <td>
                                                                <p>Order Id: {{ $Porder->order_number }}</p>
                                                            </td>
                                                            <td>
                                                                <p>order statuse: {{ $Porder->order_status }}</p>
                                                            </td>
                                                            <td>Payment Status: {{ $Porder->payment_status }}</td>
                                                            <td>${{ $Porder->total_amount }}</td>
                                                            <td><a
                                                                    href="{{ route('order.tracking', $Porder->tracking_number) }}"><i
                                                                        class="fas fa-user-cog"></i></a>
                                                                <a href="{{ route('user.order.detail', $Porder->id) }}"><i
                                                                        class="fas fa-eye"></i></a>
                                                                <a href="#"><i class="fas fa-file-invoice"></i></a>
                                                                <a href="#"><i
                                                                        class="fas fa-file-invoice-dollar"></i></a>

                                                            </td>
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
            </div>
        </div>
    </div>
    <!-- Profile Page area end here  -->




@endsection
