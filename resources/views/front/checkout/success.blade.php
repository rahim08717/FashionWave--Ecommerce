@extends('front.layouts.app')

<!-- hero-section area start here  -->
@section('content')
    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">Order succss</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="http://127.0.0.1:8000">Home</a>
                    </li>
                    <li class="page-item">Your Order Success</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end here  -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center mt-5">
                    <div class="card-header bg-success text-white">
                        <h4>Thank You for Your Order!</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Your order has been placed successfully. We will process your order
                            shortly.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- checkout page area start here  -->

@endsection


