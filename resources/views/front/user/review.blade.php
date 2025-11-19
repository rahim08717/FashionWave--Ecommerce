@extends('front.layouts.app')
@section('title', 'my review')
@section('description', 'review description')
@section('keywords', 'review keywords')

@section('content')
<!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">My Reviews</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="">Home</a></li>
                    <li class="page-item">My Reviews</li>
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
                                            class="fas fa-user-edit"></i>  {{ __('Logout') }}</a></li>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="user-profile-right-part">
                        <div class="user-profile-content-box my-reviwe-list-box">

                            <div class="d-flex justify-content-between align-items-center text-black mb-5">
                                <h2 class="user-profile-content-title">My Review</h2>
                            </div>

                            @foreach ($reviews as $review )

                            <div class="single-review-item bg-white d-flex align-items-center">
                                <div class="review-left flex-shrink-0">
                                    <a href="{{ route('product.detail',$review->product->slug) }}"><img class="product-thumbnail"
                                            src="{{ asset('front/assets/images/products/' . $review->product->product_image) }}"
                                            alt="product"></a>
                                </div>
                                <div class="review-right flex-grow-1">
                                    <h4 class="product-name"><a
                                            href="{{ route('product.detail',$review->product->slug) }}">{{ $review->product->en_name }}</a></h4>
                                    <!-- This is server side code. User can not modify it. -->
                                    <ul class="product-review">
                                        @for ($i=1;$i<=5;$i++)
                                            @if ($i<=$review->rating)
                                            <li class="review-item active"><i class="flaticon-star"></i></li>
                                            @else
                                            <li class="review-item"><i class="flaticon-star"></i></li>
                                            @endif

                                        @endfor


                                    </ul>
                                    <p>{{ $review->review }}</p>
                                </div>
                            </div>

                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Profile Page area end here  -->





@endsection
