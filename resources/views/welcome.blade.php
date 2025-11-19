@extends('front.layouts.app')

<!-- hero-section area start here  -->
@section('content')


    <div class="hero-section">
        <div class="hero-slider">
            @foreach ($sliders as $slider)
      <div class="signle-slide"
                style="background-image: url('{{ asset('front/assets/images/slider/' . $slider->image) }}');">

                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-6 mb-5">
                            <div class="hero-slider-content text-center">
                                <h2 class="slider-sub-title">
                                    {{ $slider->title ?? "" }}</h2>
                                <h1 class="slider-title">
                                    {{ $slider->sub_title ?? "" }}
                                </h1>
                                <p class="slider-text">
                                    {{ $slider->description ?? "" }}</p>
                                <div class="slider-btn">
                                    <a href="{{ $slider->link ?? "" }}" class="secondary-btn">See Collection
                                        <i class="iocn flaticon-right-arrow"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
    <!-- hero-section area end here  -->
    <!-- Popular Categories area start here  -->
    <div class="popular-categories-area section-bg section-top pb-100">
        <div class="container">
            <div class="section-header-area">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="sub-title">
                            Popular Collections
                        </h3>
                        <h2 class="section-title">
                            Popular Categories
                        </h2>
                    </div>
                    <div class="col-md-6 align-self-end text-md-end">
                        <a href="{{ route('products.index') }}" class="primary-btn">View All Products</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($categories as $cat )
                 <div class="col-lg-4 col-md-6">
                    <a class="single-categorie" href="{{ route('category.product', $cat->slug) }}">
                        <div class="categorie-wrap">
                            <div class="categorie-icon">
                                <img src="{{ asset('front/assets/images/' . $cat->icon) }}" alt="icon">

                            </div>
                            <div class="categorie-info">
                                <h3 class="categorie-name">
                                    {{ $cat->en_category_name ?? "" }}</h3>
                                <h4 class="categorie-subtitle">
                                    {{ $cat->en_short_info ?? "" }}</h4>
                            </div>
                        </div>
                        <i class="arrow flaticon-right-arrow"></i>
                    </a>
                </div>
                @endforeach

                <div class="col-md-6 align-self-end text-md-end">
                        <a href="{{ route('category.all') }}" class="primary-btn">View All Categories</a>
                    </div>


            </div>
        </div>
    </div>
    <!-- Popular Categories area end here  -->

    <!-- Featured Products area start here  -->
    <div class="featured-productss-area section-top pb-100">
        <div class="container">
            <div class="section-header-area">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="sub-title">
                            New Products
                        </h3>
                        <h2 class="section-title">
                            Products
                        </h2>
                    </div>
                    <div class="col-md-6 align-self-end text-md-end">
                        <a href="{{ route('products.index') }}" class="see-btn">See All</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product )

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-grid-product">
                        <div class="product-top">
                            <a href="{{ route('product.detail',$product->slug) }}"><img class="product-thumbnal"
                                    src="{{ asset('front/assets/images/products/'.$product->product_image) }}" alt="product" /></a>
                            {{-- <div class="product-flags">
                                <span class="product-flag sale">NEW</span>
                                <span class="product-flag discount">-10.00</span>
                            </div> --}}
                            <ul class="prdouct-btn-wrapper">
                                <li class="single-product-btn">
                                    <a href="{{ route('compare.add',$product->id) }}" class="product-btn CompareList" data-id="11" title="Add To Compare"><i
                                            class="icon flaticon-bar-chart"></i></a>
                                </li>
                                <li class="single-product-btn">
                                    <a href="{{ route('wishlist.add', $product->id) }}" class="product-btn " title="Add To Wishlist"><i
                                            class="icon flaticon-like"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="product-info text-center">
                            <h4 class="product-catagory">{{ $product->brand->en_brand_name}} -{{ $product->brand->en_category_name}}</h4>
                            <input type="hidden" name="quantity" value="1" id="product_quantity">
                            <h3 class="product-name"><a class="product-link"
                                    href="{{ route('product.detail',$product->slug) }}">{{ $product->en_name ?? "" }}</a>
                            </h3>
                            <!-- This is server side code. User can not modify it. -->
                            <ul class="product-review">
                                <li class="review-item"><i class="flaticon-star"></i></li>
                                <li class="review-item"><i class="flaticon-star"></i></li>
                                <li class="review-item"><i class="flaticon-star"></i></li>
                                <li class="review-item"><i class="flaticon-star"></i></li>
                                <li class="review-item"><i class="flaticon-star"></i></li>
                            </ul>
                            <div class="product-price">
                                <span class="regular-price">{{ $product->price ?? "" }}</span>
                                <span class="price">{{ $product->discounted_price ?? "" }}</span>
                            </div>
                            <a href="javascript:void(0)" title="Add To Cart" class="add-cart addCart" data-id="{{ $product->id }}">Add
                                To Cart <i class="icon fas fa-plus-circle"></i></a>
                        </div>
                    </div>
                </div>

                @endforeach


            </div>
        </div>
    </div>
    <!-- Featured Products area end here  -->

    <!-- About Area start here  -->
    <div class="about-area section" style="background-image: url(/uploaded_files/about_us_page/about-home.jpg)">
        <div class="container">
            <div class="section-header-area">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="sub-title">
                            Testimonials
                        </h3>
                        <h2 class="section-title">Popular Testimonials Of<br /> Fashionwave</h2>
                    </div>
                    <div class="col-md-6 align-self-end text-md-end">
                        <a href="/about-us" class="primary-btn">Know More About Us</a>
                    </div>
                </div>
            </div>
            <div class="story-box-slide">
                @foreach ($testimonials as $testimonial)
                 <div class="single-story-box">
                    <img src="{{ asset('front/assets/images/'. $testimonial->image) }}" class="avatar" alt="Testimonial">
                    <h3 class="story-title">{{ $testimonial->name ?? "" }} <span class="story-year">{{ $testimonial->profession ?? "" }}</span>
                    </h3>
                    <p class="story-content">{{ $testimonial->description ?? "" }} </p>
                </div>

                @endforeach

            </div>
        </div>
    </div>
    <!-- About Area  end here  -->

    <!-- Trending Products area start here  -->
    <div class="trending-products-area section-top pb-100">
        <div class="container">
            <div class="section-header-area">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="sub-title">
                            Popular Products
                        </h3>
                        <h2 class="section-title">
                            Trending Products
                        </h2>
                    </div>
                    <div class="col-lg-6 align-self-end text-lg-end">
                        <div class="primary-tabs">
                            <ul class="nav nav-tabs" id="TrendingProducts" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="new-arrival-tab" data-bs-toggle="tab"
                                        data-bs-target="#new-arrival" type="button" role="tab"
                                        aria-controls="new-arrival" aria-selected="true">NEW ARRIVAL</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="best-selling-tab" data-bs-toggle="tab"
                                        data-bs-target="#best-selling" type="button" role="tab"
                                        aria-controls="best-selling" aria-selected="false">BEST SELLING</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="on-sell-tab" data-bs-toggle="tab"
                                        data-bs-target="#on-sell" type="button" role="tab" aria-controls="on-sell"
                                        aria-selected="false">ON SALE</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="featured-items-tab" data-bs-toggle="tab"
                                        data-bs-target="#featured-items" type="button" role="tab"
                                        aria-controls="featured-items" aria-selected="false">FEATURED ITEMS</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="TrendingProductsContent">
                <div class="tab-pane fade show active" id="new-arrival" role="tabpanel"
                    aria-labelledby="new-arrival-tab">
                    <div class="row">
                        @foreach ($newarrivals as $newarrival )
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-grid-product">
                                <div class="product-top">
                                    <a href="{{ route('product.detail',$newarrival->slug) }}"><img class="product-thumbnal"
                                            src="{{ asset('front/assets/images/products/'.$newarrival->product_image) }}" alt="product" /></a>
                                    {{-- <div class="product-flags">
                                        <span class="product-flag sale">NEW</span>
                                        <span class="product-flag discount">-10.00</span>
                                    </div> --}}
                                    <ul class="prdouct-btn-wrapper">
                                        <li class="single-product-btn">
                                            <a href="{{ route('compare.add',$product->id) }}" class="product-btn CompareList" data-id="11" title="Add To Compare"><i
                                                    class="icon flaticon-bar-chart"></i></a>
                                        </li>
                                        <li class="single-product-btn">
                                            <a href="{{ route('wishlist.add', $product->id) }}" class="product-btn " title="Add To Wishlist"><i
                                            class="icon flaticon-like"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-info text-center">
                                    <h4 class="product-catagory">{{ $newarrival->brand->en_brand_name }} - {{ $newarrival->category->en_category_name }}</h4>
                                    <input type="hidden" name="quantity" value="1" id="product_quantity">
                                    <h3 class="product-name"><a class="product-link"
                                            href="{{ route('product.detail',$newarrival->slug) }}">{{ $newarrival->en_name }}</a>
                                    </h3>
                                    <!-- This is server side code. User can not modify it. -->
                                    <ul class="product-review">
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                    </ul>
                                    <div class="product-price">
                                        <span class="regular-price">{{ $newarrival->price }}</span>
                                        <span class="price">{{ $newarrival->discounted_price }}</span>
                                    </div>
                                    <a href="javascript:void(0)" title="Add To Cart" class="add-cart addCart"
                                        data-id="{{ $newarrival->id }}">Add To Cart <i class="icon fas fa-plus-circle"></i></a>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>
                <div class="tab-pane fade " id="best-selling" role="tabpanel" aria-labelledby="best-selling-tab">
                    <div class="row">
                        @foreach ($isbestsellers as $isbestseller )
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-grid-product">
                                <div class="product-top">
                                    <a href="{{ route('product.detail',$isbestseller->slug) }}"><img class="product-thumbnal"
                                            src="{{ asset('front/assets/images/products/'.$isbestseller->product_image) }}" alt="product" /></a>
                                    {{-- <div class="product-flags">
                                        <span class="product-flag sale">NEW</span>
                                        <span class="product-flag discount">-10.00</span>
                                    </div> --}}
                                    <ul class="prdouct-btn-wrapper">
                                        <li class="single-product-btn">
                                            <a href="{{ route('compare.add',$product->id) }}" class="product-btn CompareList" data-id="11" title="Add To Compare"><i
                                                    class="icon flaticon-bar-chart"></i></a>
                                        </li>
                                        <li class="single-product-btn">
                                            <a href="{{ route('wishlist.add', $product->id) }}" class="product-btn " title="Add To Wishlist"><i
                                            class="icon flaticon-like"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-info text-center">
                                    <h4 class="product-catagory">{{ $isbestseller->brand->en_brand_name }} - {{ $isbestseller->category->en_category_name }}</h4>
                                    <input type="hidden" name="quantity" value="1" id="product_quantity">
                                    <h3 class="product-name"><a class="product-link"
                                            href="{{ route('product.detail',$isbestseller->slug) }}">{{ $isbestseller->en_name }}</a>
                                    </h3>
                                    <!-- This is server side code. User can not modify it. -->
                                    <ul class="product-review">
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                    </ul>
                                    <div class="product-price">
                                        <span class="regular-price">{{ $isbestseller->price }}</span>
                                        <span class="price">{{ $isbestseller->discounted_price }}</span>
                                    </div>
                                    <a href="javascript:void(0)" title="Add To Cart" class="add-cart addCart"
                                        data-id="{{ $isbestseller->id }}">Add To Cart <i class="icon fas fa-plus-circle"></i></a>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>
                <div class="tab-pane fade " id="on-sell" role="tabpanel" aria-labelledby="on-sell-tab">
                    <div class="row">
                        @foreach ($onsales as $onsale )
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-grid-product">
                                <div class="product-top">
                                    <a href="{{ route('product.detail',$onsale->slug) }}"><img class="product-thumbnal"
                                            src="{{ asset('front/assets/images/products/'.$onsale->product_image) }}" alt="product" /></a>
                                    {{-- <div class="product-flags">
                                        <span class="product-flag sale">NEW</span>
                                        <span class="product-flag discount">-10.00</span>
                                    </div> --}}
                                    <ul class="prdouct-btn-wrapper">
                                        <li class="single-product-btn">
                                            <a href="{{ route('compare.add',$product->id) }}" class="product-btn CompareList" data-id="11" title="Add To Compare"><i
                                                    class="icon flaticon-bar-chart"></i></a>
                                        </li>
                                        <li class="single-product-btn">
                                            <a href="{{ route('wishlist.add', $product->id) }}" class="product-btn " title="Add To Wishlist"><i
                                            class="icon flaticon-like"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-info text-center">
                                    <h4 class="product-catagory">{{ $onsale->brand->en_brand_name }} - {{ $onsale->category->en_category_name }}</h4>
                                    <input type="hidden" name="quantity" value="1" id="product_quantity">
                                    <h3 class="product-name"><a class="product-link"
                                            href="{{ route('product.detail',$onsale->slug) }}">{{ $onsale->en_name }}</a>
                                    </h3>
                                    <!-- This is server side code. User can not modify it. -->
                                    <ul class="product-review">
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                    </ul>
                                    <div class="product-price">
                                        <span class="regular-price">{{ $onsale->price }}</span>
                                        <span class="price">{{ $onsale->discounted_price }}</span>
                                    </div>
                                    <a href="javascript:void(0)" title="Add To Cart" class="add-cart addCart"
                                        data-id="{{ $onsale->id }}">Add To Cart <i class="icon fas fa-plus-circle"></i></a>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>
                <div class="tab-pane fade " id="featured-items" role="tabpanel" aria-labelledby="featured-items-tab">
                    <div class="row">
                        @foreach ($isfeatureds as $isfeatured )
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-grid-product">
                                <div class="product-top">
                                    <a href="{{ route('product.detail',$isfeatured->slug) }}"><img class="product-thumbnal"
                                            src="{{ asset('front/assets/images/products/'.$isfeatured->product_image) }}" alt="product" /></a>
                                    {{-- <div class="product-flags">
                                        <span class="product-flag sale">NEW</span>
                                        <span class="product-flag discount">-10.00</span>
                                    </div> --}}
                                    <ul class="prdouct-btn-wrapper">
                                        <li class="single-product-btn">
                                            <a href="{{ route('compare.add',$product->id) }}" class="product-btn CompareList" data-id="11" title="Add To Compare"><i
                                                    class="icon flaticon-bar-chart"></i></a>
                                        </li>
                                        <li class="single-product-btn">
                                            <a href="{{ route('wishlist.add', $product->id) }}" class="product-btn " title="Add To Wishlist"><i
                                            class="icon flaticon-like"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-info text-center">
                                    <h4 class="product-catagory">{{ $isfeatured->brand->en_brand_name }} - {{ $isfeatured->category->en_category_name }}</h4>
                                    <input type="hidden" name="quantity" value="1" id="product_quantity">
                                    <h3 class="product-name"><a class="product-link"
                                            href="{{ route('product.detail',$isfeatured->slug) }}">{{ $isfeatured->en_name }}</a>
                                    </h3>
                                    <!-- This is server side code. User can not modify it. -->
                                    <ul class="product-review">
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                    </ul>
                                    <div class="product-price">
                                        <span class="regular-price">{{ $isfeatured->price }}</span>
                                        <span class="price">{{ $isfeatured->discounted_price }}</span>
                                    </div>
                                    <a href="javascript:void(0)" title="Add To Cart" class="add-cart addCart"
                                        data-id="{{ $isfeatured->id }}">Add To Cart <i class="icon fas fa-plus-circle"></i></a>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Products area end here  -->
    <div>
    </div>
    <!-- Image Gallery area end here  -->
    <!-- Testimonial ara end here  -->
    <div id="AddToCompareItemUrl" data-url="compare.html/add"></div>
    <div id="AddToCartIntoSession" data-url="/cart/add"></div>
    <div id="productWishlistUrl" data-url="wishlist.html/add"></div>
    <div id="currency-price-url" data-url="/currency-price"></div>
    <div id="currency-symbol-url" data-url="/currency-symbol"></div>
    <div id="productImgAsset" data-url="/uploaded_files/product_image"></div>
@endsection


@push('script')
    <script>
    $(document).on('click', '.addCart', function () {
        let id = $(this).data('id');


        $.ajax({
            url: "{{ route('cart.add') }}",
            method: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function (res) {
                if (res.status === "success") {
                    toastr.success(res.message);
                    $(".totalCountItem").text(res.cartCount);
                    $(".totalAmount").text("$ " + res.cartTotal);
                }
            }
        });
    });

    // Auto load cart data on page load
    $(document).ready(function () {
        $.get("{{ route('cart.data') }}", function (res) {
            $(".totalCountItem").text(res.cartCount);
            $(".totalAmount").text("$ " + res.cartTotal);
        });
    });
</script>
@endpush
