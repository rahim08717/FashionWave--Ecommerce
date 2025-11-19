@extends('front.layouts.app')
@section('title',$data->meta_title)
@section('description',$data->meta_description)
@section('keywords',$data->meta_keywords)
<!-- hero-section area start here  -->
@section('content')
 <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">{{ $data->title ?? "" }}</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="http://127.0.0.1:8000">Home</a></li>
                    <li class="page-item">{{ $data->title ?? "" }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end here  -->

    <!-- faq-area area start here  -->

    <div class="faq-area section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="accordion" id="accordionFaq">
                        @foreach ($faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                            {{ $faq->en_question ?? "" }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}"
                                        data-bs-parent="#accordionFaq">
                                        <div class="accordion-body">
                                            <p class="faq-text">{{ $faq->en_answer ?? "" }}</p>
                                        </div>
                                    </div>
                                </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- faq-area area end here  -->
    <div id="AddToCompareItemUrl" data-url="compare.html/add"></div>
    <div id="AddToCartIntoSession" data-url="/cart/add"></div>
    <div id="productWishlistUrl" data-url="wishlist.html/add"></div>
    <div id="currency-price-url" data-url="/currency-price"></div>
    <div id="currency-symbol-url" data-url="/currency-symbol"></div>
    <div id="productImgAsset" data-url="/uploaded_files/product_image"></div>
@endsection
