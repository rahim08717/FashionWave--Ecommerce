@extends('front.layouts.app')

<!-- hero-section area start here  -->
@section('content')
    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">Checkout</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="http://127.0.0.1:8000">Home</a>
                    </li>
                    <li class="page-item">Checkout</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end here  -->

    <!-- checkout page area start here  -->
    <section class="page-content section">
        <div class="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="checkout-form">
                            <form method="post" action="{{ route('order.store') }}">
                                @csrf

                                @guest
                                    <div class="col-lg-12 mb-3">
                                        <div
                                            class="checkout-page-login-box d-flex justify-content-between align-items-center mb-30">
                                            <h2 class="mb-0 text-capitalize fw-bold">Returning buyer? Please login:</h2>
                                            <a class="primary-btn" href="{{ route('login') }}">login</a>
                                        </div>
                                    </div>
                                @endguest

                                <div class="pt-5"></div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 class="checkout-title">Shipping Address</h2>
                                    </div>

                                    <div class="pt-2"></div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="shipping_name"> Your Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="shipping_name"
                                                name="shipping_name" placeholder="Your Name Here" value="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="shipping_email"> Your Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="shipping_email"
                                                name="shipping_email" placeholder="Email Address" value="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="shipping_street_address"> Street Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="shipping_street_address"
                                                name="shipping_street_address" placeholder="Street Address"
                                                value="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <select class="form-select" id="shipping_country" name="shipping_country">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6">
                                        <select class="form-select" id="shipping_state" name="shipping_state">
                                            <option value="">Select State</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-6 mt-4">
                                        <div class="form-group">
                                            <label for="shipping_zipcode"> Zip/Postal Code <span
                                                    class="text-danger">*</span></label>

                                            <input type="text" class="form-control" id="shipping_zipcode"
                                                name="shipping_zipcode" placeholder="Zip/Postal Code" value="" />
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group form-check terms-agree">
                                    <input type="checkbox" class="form-check-input " id="copy_address" />
                                    <label class="form-check-label" for="copy_address">different as billing
                                        address</label>
                                </div>
                                <div class="row d-none" id="billingform">
                                    <div class="col-lg-12">
                                        <h2 class="checkout-title">Billing Address</h2>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="billing_name"> Your Name Here <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="billing_name" name="billing_name"
                                                placeholder="Your Name Here" value=""  />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="billing_email"> Your Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="billing_email"
                                                name="billing_email" placeholder="Email Address" value=""
                                                 />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="billing_street_address"> Street Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="billing_street_address"
                                                name="billing_street_address" placeholder="Street Address" value=""
                                                 />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <select class="form-select" id="billing_country" name="billing_country" >
                                            <option>Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-lg-6">
                                        <select class="form-select" id="billing_state" name="billing_state" >
                                             <option value="">Select State</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <div class="form-group">
                                            <label for="billing_zipcode"> Zip/Postal Code <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="billing_zipcode"
                                                name="billing_zipcode" placeholder="Zip/Postal Code" value=""
                                                />
                                        </div>
                                    </div>
                                </div>

                                <div class="payment-method">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h2 class="checkout-title">Payment Method</h2>
                                        </div>
                                        <div class="col-lg-12">
                                            @if($gateways['PayPal']->status==1)
                                            <div class="form-group">
                                                <div class="form-check card-check">
                                                    <input class="form-check-input" type="radio" name="payment"
                                                        id="paypal" value="paypal" />
                                                    <label class="form-check-label" for="paypal">PayPal</label>
                                                    <div class="input-icon">
                                                        <img src="{{ asset('front/assets/images/payment-gateway/paypal.png') }}"
                                                            alt="paypal" />
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if($gateways['Stripe']->status==1)
                                            <div class="form-group">
                                                <div class="form-check card-check">
                                                    <input class="form-check-input" type="radio" name="payment"
                                                        id="creditcard" value="creditcard" />
                                                    <label class="form-check-label" for="creditcard">
                                                        Stripe</label>
                                                    <div class="input-icon">
                                                        <img src="{{asset('front/assets/images/payment-gateway/payment-method.png') }}"
                                                            alt="payment-method" />
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <input type="hidden" name="payment_platform" id="payment_platform">
                                            <div class="card-infor-box mb-3 d-none" id="stripe-area">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label class="mt-3" for="card-element">
                                                            Card details:
                                                        </label>

                                                        <div id="cardElement"></div>

                                                        <small class="form-text text-muted" id="cardErrors"
                                                            role="alert"></small>

                                                        <input type="hidden" name="payment_method" id="paymentMethod">
                                                    </div>
                                                </div>
                                            </div>
                                            @if($gateways['Razorpay']->status==1)
                                            <div class="form-group">
                                                <div class="form-check card-check">
                                                    <input class="form-check-input" type="radio" name="payment"
                                                        id="razorpay" value="razorpay" />
                                                    <label class="form-check-label" for="razorpay">Razorpay</label>
                                                    <div class="input-icon">
                                                        <img src="{{asset('front/assets/images/payment-gateway/razorpay.png') }}"
                                                            alt="razorpay" />
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <input type="hidden" name="pay_to_razorpay" id="pay-to-razorpay"
                                                value="44634">
                                            <input type="hidden" name="razorpay_key" id="razorpay-key" value="">
                                            <input type="hidden" name="razorpay_payment_id" id="razorpay-payment-id">
                                            {{-- <div class="form-group">
                                                <div class="form-check card-check">
                                                    <input class="form-check-input" type="radio" name="payment"
                                                        id="bank" value="bank" />
                                                    <label class="form-check-label" for="bank">
                                                        Bank</label>
                                                    <div class="input-icon">
                                                        <img src="{{asset('front/assets/images/payment-gateway/bank.png') }}"
                                                            alt="payment-method" />
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="card-infor-box mb-3 d-none" id="bank-area">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label class="mt-3" for="bank-trans-num">
                                                                Transaction Number:
                                                            </label>
                                                            <input type="text" name="bank_transaction_number"
                                                                id="bank-trans-num" class="form-control"
                                                                placeholder="Enter Your Transaction Number" />
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="mt-3">
                                                                <b>Bank Account Details:</b> <br>
                                                                Bank Name:
                                                                bank
                                                                <br>
                                                                Account Number:
                                                                <br>
                                                                Account Holder:
                                                                <br>
                                                                Branch:
                                                                us <br>
                                                                Swift Code:
                                                                <br>
                                                                Routing Number:
                                                                asdf <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($gateways['SSLCommerce']->status==1)
                                            <div class="form-group">
                                                <div class="form-check card-check">
                                                    <input class="form-check-input" type="radio" name="payment"
                                                        id="sslcommerz" value="sslcommerz" />
                                                    <label class="form-check-label" for="sslcommerz">Sslcommerz</label>
                                                    <div class="input-icon">
                                                        <img src="{{asset('front/assets/images/payment-gateway/sslcommerz.png') }}"
                                                            alt="sslcommerz" />
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if($gateways['COD']->status==1)
                                            <div class="form-group">
                                                <div class="form-check card-check">
                                                    <input class="form-check-input" type="radio" name="payment"
                                                        id="COD" value="COD" />
                                                    <label class="form-check-label" for="COD">Cash On
                                                        Delivey</label>
                                                    <div class="input-icon">
                                                        <img src="{{ asset('front/assets/images/payment-gateway/cod.jpg') }}"
                                                            alt="Cash On Delivey" />
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="form-group form-check terms-agree">
                                                <input type="checkbox" class="form-check-input" id="agree"
                                                    required />
                                                <label class="form-check-label" for="agree">By clicking the button
                                                    you
                                                    agree to our
                                                    <a href="terms.html">Terms &amp; Conditions</a></label>
                                            </div>
                                            @guest
                                                <a href="{{ route('login') }}" class="checkout-btn text-center pt-4">Please
                                                    first login</a>
                                            @else
                                                <button type="submit" class="checkout-btn">Place Order</button>
                                            @endguest



                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade common-modal" id="show-razor-thanks" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                    Razorpay Confirmation</h5>
                                            </div>
                                            <div class="modal-body">
                                                Your payment is authorized. For capturing your order click
                                                <b>Place Order</b>
                                                <div class="modal-btn-wrap text-end">
                                                    <button type="submit" class="primary-btn">Place Order</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="cart-summary">
                            <div class="summary-top d-flex">
                                <h2>Cart Summary</h2>
                                <a class="edite-btn" href="/cart/content">Edit</a>
                            </div>
                            <ul class="cart-product-list">
                                @foreach (session('cart', []) as $id => $item)
                                    <li class="single-cart-product d-flex justify-content-between">
                                        <div class="product-info">
                                            <h3>{{ $loop->iteration }}. {{ $item['name'] }}</h3>
                                            <p>Size:
                                                {{ $item['size'] }}
                                            </p>
                                            <p class="checkout-page-color-show">Color: {{ $item['color'] }}
                                            </p>
                                        </div>
                                        <div class="price-area">
                                            <h3 class="price">
                                                $ {{ $item['price'] }}
                                            </h3>
                                        </div>
                                    </li>
                                @endforeach



                            </ul>
                            <!-- Cart page bottom box -->
                            <div class="col-lg-12 col-md-12">
                                <div class="checkout-discount-box">
                                    <h2 class="mb-3">Discount Codes</h2>
                                    <form id="applyCouponForm">
                                        @csrf
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="coupon_code"
                                                name="coupon_code" placeholder="Enter your coupon code" required />
                                            <button type="submit" class="border-0 px-4 btn btn-primary">Apply
                                                Coupon</button>
                                        </div>
                                    </form>
                                    <!-- Show result here -->
                                    <div id="couponMessage" class="mt-2"></div>
                                </div>
                            </div>
                            <ul class="summary-list">
                                <li>
                                    Subtotal
                                    <span id="subtotal-amount">
                                        ${{ session('cart') ? collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']) : 0 }}.00
                                    </span>
                                </li>

                                <li>
                                    Coupon Discount
                                    <span id="coupon_charge_show">- $ 0.00</span>
                                </li>

                                <li>
                                    Shipping Cost
                                    <span id="shipping_charge_show">$ 0.00</span>
                                </li>

                                <li>
                                    VAT/Tax
                                    <span id="vat_tax_show">$ 0.00</span>
                                </li>
                            </ul>

                            <div class="total-amount">
                                <h3>
                                    Grand Total
                                    <span class="float-right "
                                        id="total_cost_show">${{ session('cart') ? collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']) : 0 }}</span>
                                </h3>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="stripe-collapse" data-stripe="/stripe-collapse"></div>
    <div id="stripe-key" data-key=""></div>
    <div id="user-name" data-key="Guest User"></div>
    <div id="user-email" data-key="guest@gmail.com"></div>
    <div id="get-tax-amount" data-url="checkout.html/get-tax-amount"></div>
    <!-- checkout page area end here  -->
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            // 🧾 Subtotal amount
            let subtotal = parseFloat($('#subtotal-amount').text().replace('$', '').trim());
            let shippingCost = 0;
            let vatTax = 0;

            // ✅ Copy address checkbox
            $('#copy_address').change(function() {
                if ($(this).is(':checked')) {
                    $('#billingform').removeClass('d-none');
                } else {
                    $('#billingform').addClass('d-none');
                }
            });

            // ✅ Country change → Fetch states + VAT
            $('#shipping_country,#billing_country').on('change', function() {
                let country_id = $(this).val();
                let stateDropdown = $('#shipping_state,#billing_state');


                if (country_id) {

                    // 🟢 1️⃣ Fetch States
                    $.ajax({
                        url: `/get-states/${country_id}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            stateDropdown.empty().append(
                                '<option value="">Select State</option>');
                            $.each(response, function(key, state) {
                                stateDropdown.append('<option value="' + state.id +
                                    '">' + state.name + '</option>');
                            });

                        },
                        error: function() {
                            console.log('❌ Failed to fetch states');
                        }
                    });

                    // 🟢 2️⃣ Fetch VAT/Tax
                    $.ajax({
                        url: `/get-country-vat/${country_id}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            vatTax = parseFloat(response.vat_tax).toFixed(2);
                            $('#vat_tax_show').text('$ ' + vatTax);
                            updateTotal();
                        },
                        error: function() {
                            console.log('❌ Failed to fetch VAT');
                        }
                    });

                } else {
                    stateDropdown.empty().append('<option value="">Select State</option>');
                    $('#vat_tax_show').text('$ 0.00');
                    $('#shipping_charge_show').text('$ 0.00');
                    updateTotal();
                }
            });

            // ✅ State change → Fetch Shipping Charge
            $('#shipping_state').on('change', function() {
                let state_id = $(this).val();

                if (state_id) {
                    $.ajax({
                        url: `/get-shipping-charge/${state_id}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            shippingCost = parseFloat(response.shipping_charge).toFixed(2);
                            $('#shipping_charge_show').text('$ ' + shippingCost);
                            updateTotal();
                        },
                        error: function() {
                            console.log('❌ Failed to fetch shipping charge');
                        }
                    });
                } else {
                    $('#shipping_charge_show').text('$ 0.00');
                    updateTotal();
                }
            });

            // ✅ Function to update Grand Total
            function updateTotal() {
                let subtotal = parseFloat($('#subtotal-amount').text().replace('$', '').trim()) || 0;
                let vat = parseFloat($('#vat_tax_show').text().replace('$', '').trim()) || 0;
                let ship = parseFloat($('#shipping_charge_show').text().replace('$', '').trim()) || 0;
                let couponText = $('#coupon_charge_show').text().replace('$', '').replace('%', '').trim();

                // চেক করবো কুপনটা percentage নাকি fixed amount
                let couponDiscount = 0;
                if ($('#coupon_charge_show').text().includes('%')) {
                    // percent হলে subtotal এর ওপর হিসাব হবে
                    couponDiscount = (subtotal * parseFloat(couponText)) / 100;
                    $('#coupon_charge_show').text(`$ ${couponDiscount.toFixed(2)}`);

                } else {
                    couponDiscount = parseFloat(couponText) || 0;
                }

                let grandTotal = subtotal - couponDiscount + ship + vat;
                $('#total_cost_show').text(`$ ${grandTotal.toFixed(2)}`);
            }

            $('#applyCouponForm').on('submit', function(e) {
                e.preventDefault(); // Prevent form reload

                let coupon_code = $('#coupon_code').val();

                $.ajax({
                    url: "{{ route('coupon.apply') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        coupon_code: coupon_code
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#couponMessage').html(
                                `<div class="alert alert-success">${response.message}</div>`
                            );

                            // discount_type অনুযায়ী value দেখানো
                            if (response.discount_type === 'percentage') {
                                $('#coupon_charge_show').text(
                                    `${parseFloat(response.discount_value).toFixed(2)}%`);
                            } else {
                                $('#coupon_charge_show').text(
                                    `$ ${parseFloat(response.discount_value).toFixed(2)}`);
                            }

                            updateTotal();
                        } else {
                            $('#couponMessage').html(
                                `<div class="alert alert-danger">${response.message}</div>`
                            );
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        $('#couponMessage').html(
                            `<div class="alert alert-danger">Something went wrong!</div>`
                        );
                    }
                });
            });
        });
    </script>
@endpush
