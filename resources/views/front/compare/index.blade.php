@extends('front.layouts.app')

<!-- hero-section area start here  -->
@section('content')
    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">Compare</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="http://127.0.0.1:8000">Home</a></li>
                    <li class="page-item">Compare</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end here  -->

    <!-- Checkout-Area -->
    <section class="compare-page-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_page table-responsive compare-table">
                        <div id="compareListTable">
                            <table class="table">
                                <tbody>

                                    <tr>
                                        <td class="first-column">Product</td>
                                        @foreach ($compareproduct as $compare)
                                            <td class="product-image-title">
                                                <div class="product-top">
                                                    <a href="/product/single/rosmo-namino-2" class="image"><img
                                                            src="{{ asset('front/assets/images/products/' . $compare->product->product_image) }}"
                                                            alt="Compare Product"></a>
                                                </div>
                                                <div>
                                                    <h5><a href="/product/single/rosmo-namino-2"
                                                            class="title">{{ $compare->product->en_name }}</a>
                                                    </h5>
                                                </div>
                                            </td>
                                        @endforeach



                                    </tr>
                                    <tr>
                                        <td class="first-column">Description</td>
                                        @foreach ($compareproduct as $compare)
                                            <td class="pro-desc">
                                                <p>{{ $compare->product->en_description }}
                                                </p>
                                            </td>
                                        @endforeach

                                    </tr>
                                    <tr>
                                        <td class="first-column">Price</td>

                                        @foreach ($compareproduct as $compare)
                                            <td class="pro-price">{{ $compare->product->price }}
                                            </td>
                                        @endforeach
                                    </tr>
                                    {{-- <tr>
                                        <td class="first-column">Color</td>
                                        <td class="pro-color">
                                        </td>
                                        <td class="pro-color">
                                            Red
                                        </td>
                                    </tr> --}}
                                    {{-- <tr>
                                        <td class="first-column">Stock</td>
                                        <input type="hidden" name="quantity" value="1" id="product_quantity">
                                        <td class="pro-stock">In Stock</td>
                                        <td class="pro-stock">In Stock</td>
                                    </tr> --}}
                                    <tr>

                                        <td class="first-column">Add To Cart</td>
                                        @foreach ($compareproduct as $compare)
                                            <td class="pro-addtocart">

                                                <a href="javascript:void(0)" title="Add To Cart"
                                                    data-id="{{ $compare->product->id }}"
                                                    class=" addCart add-cart action-btn addCart primary-btn">Add To Cart</a>
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="first-column">Delete</td>
                                        @foreach ($compareproduct as $compare)
                                            <td class="pro-remove"><button class="bg-transparent border-0 deleteCompareList"
                                                    data-id="{{ $compare->product->id }}" title="Delete Item"><i
                                                        class="fas fa-times"></i></button>
                                            </td>
                                        @endforeach
                                    </tr>
                                    {{-- <tr>
                                        <td class="first-column">Rating</td>
                                        <td class="pro-ratting">
                                            <!-- This is server side code. User can not modify it. -->
                                            <ul class="product-review">
                                                <li class="review-item"><i class="flaticon-star"></i></li>
                                                <li class="review-item"><i class="flaticon-star"></i></li>
                                                <li class="review-item"><i class="flaticon-star"></i></li>
                                                <li class="review-item"><i class="flaticon-star"></i></li>
                                                <li class="review-item"><i class="flaticon-star"></i></li>
                                            </ul>
                                        </td>
                                        <td class="pro-ratting">
                                            <!-- This is server side code. User can not modify it. -->
                                            <ul class="product-review">
                                                <li class="review-item"><i class="flaticon-star"></i></li>
                                                <li class="review-item"><i class="flaticon-star"></i></li>
                                                <li class="review-item"><i class="flaticon-star"></i></li>
                                                <li class="review-item"><i class="flaticon-star"></i></li>
                                                <li class="review-item"><i class="flaticon-star"></i></li>
                                            </ul>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="deleteCompareListUrl" data-url="compare.html/delete"></div>
    <div id="AddToCartIntoSession" data-url="/cart/add"></div>
    <div id="productImgAsset" data-url="/uploaded_files/product_image"></div>
    <div id="AddToCompareItemUrl" data-url="compare.html/add"></div>
    <div id="AddToCartIntoSession" data-url="/cart/add"></div>
    <div id="productWishlistUrl" data-url="wishlist.html/add"></div>
    <div id="currency-price-url" data-url="/currency-price"></div>
    <div id="currency-symbol-url" data-url="/currency-symbol"></div>
    <div id="productImgAsset" data-url="/uploaded_files/product_image"></div>
@endsection

@push('script')
<script>
$(document).on('click', '.addCart', function() {
    let id = $(this).data('id');

    $.ajax({
        url: "{{ route('cart.add') }}",
        method: "POST",
        data: {
            id: id,
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



    $(document).on('click', '.deleteCompareList', function(e) {
    e.preventDefault();

    let product_id = $(this).data('id');

    if (confirm('Are you sure you want to remove this product?')) {
        $.ajax({
            url: "{{ route('compare.remove') }}",
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: product_id
            },
            success: function(res) {
                if (res.status === 'success') {
                    toastr.success(res.message);
                    $('button[data-id="' + product_id + '"]').closest('tr').remove();
                    setTimeout(function()
                {
                    window.location.reload();
                },1500);
                } else {
                    toastr.error(res.message);

                }
            },
            error: function(err) {
                toastr.error('Something went wrong!');
                console.log(err.responseText);
            }
        });
    }
});

});
</script>
@endpush
