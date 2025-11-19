@extends('front.layouts.app')



@section('title', $product->meta_title)
@section('description', $product->meta_description)
@section('keywords', $product->meta_keywords)

@push('meta')
    <meta property="og:title" content="{{ $product->en_name }}" />
    <meta property="og:description" content="{{ $product->meta_description ?? 'Best Product' }}" />
    <meta property="og:image" content="{{ asset('front/assets/images/products/' . $product->image) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="product" />
@endpush


@section('content')

    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">{{ $product->en_name }}</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="http://127.0.0.1:8000">Home</a>
                    </li>
                    <li class="page-item">{{ $product->en_name }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end here  -->

    <!-- product-single-area start here  -->
    <div class="product-single-area section-top">
        <div class="container">
            <div class="product-single-details">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-single-left">
                            <div class="product-thumbnail-image">
                                <ul class="product-thumb-silide slider slider-nav">
                                    @foreach ($images as $img)
                                        <li class="single-item"><img class="single-item-image"
                                                src="{{ asset('front/assets/images/products/' . $img->image) }}"
                                                alt="product" /></li>
                                    @endforeach


                                </ul>
                            </div>
                            <div class="product-slier-big-image">
                                <div class="product-priview-slide slider slider-for">

                                    @foreach ($images as $img)
                                        <div class="single-slide">
                                            <img class="slide-image"
                                                src="{{ asset('front/assets/images/products/' . $img->image) }}"
                                                alt="product" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-single-right">
                            <div class="product-info">
                                <h4 class="product-catagory">{{ $product->brand->en_brand_name }} -
                                    {{ $product->category->en_category_name }}</h4>

                                <h3 class="product-name">
                                    {{ $product->en_name }}</h3>
                                <!-- This is server side code. User can not modify it. -->
                                <ul class="product-review">
                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                </ul>

                                <div class="product-price">
                                    <span class="price">{{ $product->price }}</span>
                                    <span class="regular-price">{{ $product->discounted_price }}</span>
                                </div>

                                <p class="note-text">{{ $product->product_note }}
                                </p>

                                <div class="product-color-area">
                                    <div class="variable-single-item color-switch">
                                        <div class="product-variable-color">
                                            @foreach ($product->colors as $color)
                                                <label>

                                                    <input name="productColor" class="color-select" type="radio"
                                                        value="{{ $color->color }}">
                                                    <span style="background: {{ $color->color_code }};"></span>
                                                </label>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>

                                <div class="product-size-area">
                                    <h4 class="size-title">Type: Physical
                                    </h4>

                                    <ul class="size-switch">
                                        @foreach ($product->sizes as $size)
                                            <input type="hidden" class="sizeValue" name="productSize"
                                                value="{{ $size->size }}">
                                            <li class="single-size activeSize" data-size="{{ $size->size }}">
                                                {{ $size->size }}</li>
                                        @endforeach
                                    </ul>


                                </div>

                                <div class="prdouct-btn-wrapper d-flex align-items-center">
                                    <div class="cart-plus-minus">
                                        <div class="dec qtybutton btn">-</div>
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton"
                                            id="product_quantity" value="1" readonly />
                                        <div class="inc qtybutton btn">+</div>
                                    </div>
                                    <a href="{{ route('wishlist.add', $product->id) }}" class="product-btn "
                                        title="Add To Wishlist"><i class="icon flaticon-like"></i></a>
                                    <a class="product-btn CompareList" data-id="5" title="Add To Compare"><i
                                            class="icon flaticon-bar-chart"></i></a>
                                </div>
                                <div class="product-bottom-button d-flex">
                                    <a href="javascript:void(0)" class="primary-btn buyNow" data-id="5">Buy Now</a>
                                    <a href="javascript:void(0)" title="Add To Cart" class="add-cart addCart"
                                        data-id="{{ $product->id }}">Add To Cart
                                        <i class="icon fas fa-plus-circle"></i></a>
                                </div>
                            </div>
                            <div class="product-right-bottom">
                                <ul class="features">
                                    <li class="single-feature"><img class="icon"
                                            src="{{ asset('front/assets/images/delivery-van-icon.svg') }}"
                                            alt="icon" /><strong class="feature-title">Estimated
                                            Delivery:</strong><span
                                            class="feature-text">{{ $product->estimated_delivery }}</span></li>
                                    <li class="single-feature"><img class="icon"
                                            src="{{ asset('front/assets/images/shipping-return.svg') }}"
                                            alt="icon" /><strong class="feature-title">Shipping Charge:</strong><span
                                            class="feature-text">
                                            $ 60

                                        </span>
                                    </li>
                                </ul>

                                <div class="guarantee-checkout-area">
                                    <h3 class="guarantee-title">Guarantee safe &amp; secure checkout</h3>
                                    <img src="{{ asset('front/assets/images/we_accept.webp') }}"
                                        alt="payment-method-image" />
                                </div>

                                <div class="share-area mt-30">
                                    <h3 class="share-title">SHARE:</h3>
                                    <ul class="social-media a2a_kit">
                                        <li class="media-item"><a class="media-link facebook a2a_button_facebook"
                                                href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="media-item"><a class="media-link twitter a2a_button_twitter"
                                                href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
                                        <li class="media-item"><a class="media-link linkedin a2a_button_linkedin"
                                                href="javascript:void(0)"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li class="media-item"><a class="media-link pinterest a2a_button_pinterest"
                                                href="javascript:void(0)"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-bottom-info mt-50">
                <div class="nav-tabs-menu">
                    <ul class="nav nav-tabs" id="ProductTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                data-bs-target="#Description" type="button" role="tab" aria-controls="Description"
                                aria-selected="true">
                                Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Reviews-tab" data-bs-toggle="tab" data-bs-target="#Reviews"
                                type="button" role="tab" aria-controls="Reviews" aria-selected="false">
                                Reviews</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Shipping-Return-tab" data-bs-toggle="tab"
                                data-bs-target="#Shipping-Return" type="button" role="tab"
                                aria-controls="Shipping-Return" aria-selected="false">
                                Shipping &amp; Return</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Additional-Information-tab" data-bs-toggle="tab"
                                data-bs-target="#Additional-Information" type="button" role="tab"
                                aria-controls="Additional-Information" aria-selected="false">
                                Additional Information</button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="ProductTabContent">

                    <div class="tab-pane fade show active" id="Description" role="tabpanel"
                        aria-labelledby="Description-tab">
                        <div class="product-description">
                            <p class="description-text">{{ $product->en_description }} </p>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                        <div class="product-reviews">
                            <div class="review-top">
                                <div class="review-top-left">
                                    <span class="review-point">{{ $average_rating }}</span>
                                    <!-- This is server side code. User can not modify it. -->
                                    <ul class="product-review">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $average_rating)
                                                <li class="review-item active"><i class="flaticon-star"></i></li>
                                            @else
                                                <li class="review-item"><i class="flaticon-star"></i></li>
                                            @endif
                                        @endfor



                                    </ul>
                                    <span class="review-count">{{ $product->reviews->count() }}
                                        Reviews</span>
                                </div>
                            </div>
                            @if (Auth::check() && $has_order)
                                <div class="reviewform">
                                    <div class="col-6">

                                        <form id="reviewForm" method="POST" action="{{ route('review.store') }}">
                                            @csrf

                                            <!-- Hidden Fields -->
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="order_id" value="{{ $order->id ?? '' }}">

                                            <!-- Rating -->
                                            <div class="mb-3">

                                                <div class="mb-3">
                                                    <label for="rating" class="form-label fw-semibold fs-3">Your
                                                        Rating:</label>
                                                    <select name="rating" id="rating" class="form-control fs-4"
                                                        required>
                                                        <option value="">-- Select Rating --</option>
                                                        <option value="5">⭐⭐⭐⭐⭐ (Excellent)</option>
                                                        <option value="4">⭐⭐⭐⭐ (Very Good)</option>
                                                        <option value="3">⭐⭐⭐ (Good)</option>
                                                        <option value="2">⭐⭐ (Fair)</option>
                                                        <option value="1">⭐ (Poor)</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <!-- Review Text -->
                                            <div class="mb-3">
                                                <label for="review" class="form-label fw-semibold">Your Review:</label>
                                                <textarea class="form-control fs-3" id="review" name="review" rows="4"
                                                    placeholder="Write your experience about this product..." required></textarea>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-success px-4 btn-lg fs-2">Submit
                                                    Review</button>
                                            </div>

                                            <!-- Message -->
                                            <div id="reviewMessage" class="mt-3"></div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <div class="reviews-list mt-5">
                                @if (isset($product->reviews) && $product->reviews->count() > 0)
                                    <h3 style="border-bottom:1px dotted #ddd; width:150px;">Customer Reviews</h3>

                                    @foreach ($product->reviews as $review)
                                        <div class="review">
                                            <strong>{{ $review->user->name ?? 'Anonymous' }}</strong>
                                            -
                                            <small>{{ $review->created_at ? $review->created_at->format('F j, Y') : '' }}</small>
                                            <p>
                                                Rating: {{ $review->rating }}
                                            <ul
                                                style="display:inline-flex; list-style:none; padding:0; margin:0; vertical-align:middle;">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                        <li style="margin-right:3px;">
                                                            <i class="flaticon-star"
                                                                style="color:#f5b50a; font-size:18px;"></i>
                                                        </li>
                                                    @else
                                                        <li style="margin-right:3px;">
                                                            <i class="flaticon-star"
                                                                style="color:#ccc; font-size:18px;"></i>
                                                        </li>
                                                    @endif
                                                @endfor
                                            </ul>
                                            </p>

                                            <p>Review: {{ $review->review }}</p>


                                        </div>
                                        <hr>
                                    @endforeach
                                @else
                                    <p>No reviews yet. Be the first to review this product!</p>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="Shipping-Return" role="tabpanel"
                        aria-labelledby="Shipping-Return-tab">
                        <div class="shipping-return-area">
                            <p class="return-text">{{ $product->en_shipping }}</p>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="Additional-Information" role="tabpanel"
                        aria-labelledby="Additional-Information-tab">
                        <p class="additional-information-text">{{ $product->en_additional_info }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product-single-area end here  -->

    <!-- Featured Products area start here  -->
    <div class="featured-productss-area section-top pb-100">
        <div class="container">
            <div class="section-header-area">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="sub-title">Similar Products</h3>
                        <h2 class="section-title">Related Products</h2>
                    </div>
                    <div class="col-md-6 align-self-end text-md-end">
                        <a href="/product/all" class="see-btn">See All</a>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($related_products as $related_product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-grid-product">
                            <div class="product-top">
                                <a href="{{ route('product.detail', $related_product->slug) }}"><img
                                        class="product-thumbnal"
                                        src="{{ asset('front/assets/images/products/' . $related_product->product_image) }}"
                                        alt="product" /></a>
                                <div class="product-flags">
                                    <span class="product-flag sale">NEW</span>
                                    <span class="product-flag discount">-10.00</span>
                                </div>
                                <ul class="prdouct-btn-wrapper">
                                    <li class="single-product-btn">
                                        <a href="{{ route('compare.add', $product->id) }}"
                                            class="addToWishlist product-btn MyWishList" href="javascript:void(0)"
                                            title="Add To Compare"><i class="icon flaticon-bar-chart"></i></a>
                                    </li>
                                    <li class="single-product-btn">
                                        <a href="{{ route('wishlist.add', $product->id) }}" class="product-btn "
                                            title="Add To Wishlist"><i class="icon flaticon-like"></i></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-info text-center">
                                <h4 class="product-catagory">{{ $related_product->brand->en_brand_name }} -
                                    {{ $related_product->category->en_category_name }}</h4>
                                <h3 class="product-name"><a class="product-link"
                                        href="/product/single/plaid-cotton-shirt">{{ $related_product->en_name }}</a>
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
                                    <span class="regular-price">{{ $related_product->price }}</span>
                                    <span class="price">{{ $related_product->discounted_price }}</span>
                                </div>
                                <a href="javascript:void(0)" title="Add To Cart" class="add-cart addCart"
                                    data-id="{{ $product->id }}">Add To
                                    Cart <i class="icon fas fa-plus-circle"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>






@endsection
@push('script')
    <script>
        $(document).on('click', '.addCart', function() {
            let id = $(this).data('id');
            let selectColor = $('input[name="productColor"]:checked').val();
            let selectSize = $('.size-switch li.active').data('size');



            $.ajax({
                url: "{{ route('cart.add') }}",
                method: "POST",
                data: {
                    id: id,
                    size: selectColor,
                    color: selectColor,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.status === "success") {
                        toastr.success(res.message);
                        $(".totalCountItem").text(res.cartCount);
                        $(".totalAmount").text("$ " + res.cartTotal);
                    }
                }
            });
        });

        // Auto load cart data on page load
        $(document).ready(function() {
            $.get("{{ route('cart.data') }}", function(res) {
                $(".totalCountItem").text(res.cartCount);
                $(".totalAmount").text("$ " + res.cartTotal);
            });
        });
    </script>
@endpush
