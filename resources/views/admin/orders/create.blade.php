@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="h3 font-weight-bold text-primary">Create New Order</h2>
                    </div>
                    <div>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.orders.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white font-weight-bold py-3">
                            <i class="fas fa-user mr-2 text-primary"></i> Billing Information
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label>Select Customer (Optional)</label>
                                    <select name="user_id" class="form-control">
                                        <option value="">Guest Customer</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Full Name *</label>
                                    <input type="text" name="billing_name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email Address *</label>
                                    <input type="email" name="billing_email" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone *</label>
                                    <input type="text" name="billing_phone" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Street Address *</label>
                                    <input type="text" name="billing_street_address" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>City *</label>
                                    <input type="text" name="billing_city" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Zipcode *</label>
                                    <input type="text" name="billing_zipcode" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Country *</label>
                                    <select name="billing_country" class="form-control" required>
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>State *</label>
                                    <select name="billing_state" class="form-control" required>
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                         <div class="card-header bg-white font-weight-bold py-3">
                            <i class="fas fa-truck mr-2 text-primary"></i> Shipping Information
                        </div>
                         <div class="card-body">
                             <p class="text-muted">Leave blank if same as billing.</p>
                             <div class="row">
                                 <div class="col-md-6 mb-3">
                                     <label>Shipping Name</label>
                                     <input type="text" name="shipping_name" class="form-control">
                                 </div>
                                 <div class="col-md-6 mb-3">
                                     <label>Shipping Address</label>
                                     <input type="text" name="shipping_street_address" class="form-control">
                                 </div>
                             </div>
                         </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white font-weight-bold py-3">
                            <i class="fas fa-file-invoice-dollar mr-2 text-primary"></i> Payment & Status
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Payment Method</label>
                                <select name="payment_method" class="form-control">
                                    <option value="COD">Cash on Delivery</option>
                                    <option value="PayPal">PayPal</option>
                                    <option value="Stripe">Stripe</option>
                                     <option value="Razorpay">Razorpay</option>
                                     <option value="SSLCommerce">SSLcommerce</option>


                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Payment Status</label>
                                <select name="payment_status" class="form-control">
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Order Status</label>
                                <select name="order_status" class="form-control">
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Tracking Number</label>
                                <input type="text" name="tracking_number" class="form-control" placeholder="Optional">
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                         <div class="card-header bg-white font-weight-bold py-3">
                            <i class="fas fa-calculator mr-2 text-primary"></i> Order Totals
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label>Subtotal</label>
                                <input type="number" step="0.01" name="subtotal_amount" class="form-control" placeholder="0.00">
                            </div>
                            <div class="form-group mb-2">
                                <label>Shipping Cost</label>
                                <input type="number" step="0.01" name="shipping_amount" class="form-control" placeholder="0.00">
                            </div>
                             <div class="form-group mb-2">
                                <label>Tax</label>
                                <input type="number" step="0.01" name="tax_amount" class="form-control" placeholder="0.00">
                            </div>
                            <div class="form-group mb-2">
                                <label>Discount</label>
                                <input type="number" step="0.01" name="discounted_amount" class="form-control" placeholder="0.00">
                            </div>
                             <div class="form-group mb-2">
                                <label>Total Amount *</label>
                                <input type="number" step="0.01" name="total_amount" class="form-control" required placeholder="0.00">
                            </div>

                            <button type="submit" class="btn btn-blue btn-block mt-3">Create Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
