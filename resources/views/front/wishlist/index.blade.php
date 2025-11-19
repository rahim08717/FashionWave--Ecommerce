@extends('front.layouts.app')

<!-- hero-section area start here  -->
@section('content')

<!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">Wish List</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="http://127.0.0.1:8000">Home</a></li>
                    <li class="page-item">Wish List</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end here  -->

    <!-- wish-list area start here  -->
    <div class="wish-list-area section">
        <div class="container">
            <div class="row">

                <div class="col-12 wish-list-table">
                    <div class="table-responsive">
                        <div id="wishlistTable">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($wishlistproduct as $wishlist )

                                        <td>
                                            <div class="product-image">
                                                <a href="{{ route('product.detail',$wishlist->product->id) }}"><img class="product-thumbnal"
                                                        src="{{ asset('front/assets/images/products/'. $wishlist->product->product_image) }}"
                                                        alt="product" /></a>
                                                <div class="product-flags">

                                                    <span class="product-flag sale">HOT</span>
                                                    <span class="product-flag discount">-10.00</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-info text-center">
                                                <h3 class="product-name"><a class="product-link"
                                                        href="{{ route('product.detail',$wishlist->product->id) }}">{{$wishlist->product->en_name  }}</a>
                                                </h3>
                                                <!-- This is server side code. User can not modify it. -->
                                                {{-- <ul class="product-review">
                                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                                </ul> --}}
                                                <div class="variable-single-item color-switch">
                                                    <div class="product-variable-color">
                                                        <input type="hidden" name="quantity" value="1"
                                                            id="product_quantity">

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-price text-center">
                                                <span class="regular-price">${{$wishlist->product->discounted_price  }}</span>
                                                <span class="price">$ {{$wishlist->product->price  }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-area">
                                                <a href="javascript:void(0)" title="Add To Cart" data-id="{{$wishlist->product->id  }}"
                                                    class="add-cart action-btn addCart">Add To Cart <i
                                                        class="icon fas fa-plus-circle"></i></a>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="delet-btn deleteWishlist" data-id="{{$wishlist->product->id  }}" title="Delete Item">
                                                <img src="{{ asset('front/assets/images/close.svg') }}" alt="close" /></button>
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
    <!-- wish-list area end here  -->

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

//delete wishlist

    $(document).on('click', '.deleteWishlist', function(e) {
    e.preventDefault();

    let product_id = $(this).data('id');

    if (confirm('Are you sure you want to remove this product?')) {
        $.ajax({
            url: "{{ route('wishlist.remove') }}",
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
