@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Edit Coupon</h2> </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Coupon</li> </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="gallery__area bg-style">
                    <div class="gallery__content">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-one" role="tabpanel"
                                aria-labelledby="nav-one-tab">

                                <form enctype="multipart/form-data" method="POST"
                                    action="{{ route('admin.coupons.update', $coupon->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-vertical__item bg-style">
                                        <div class="item-top mb-30">
                                            <h2>Edit Coupon</h2> </div>

                                        <div class="input__group mb-25">
                                            <label>Coupon Code</label>
                                            <input type="text" name="code" value="{{ $coupon->code }}" placeholder="Enter Coupon Code">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Discount Type</label>
                                            <select name="type" class="form-control">
                                                <option value="percentage" {{ $coupon->type == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                                <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                                            </select>
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Discount Value</label>
                                            <input type="number" step="0.01" name="discount_value" value="{{ $coupon->discount_value }}" placeholder="Enter value">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Minimum Order Amount (Optional)</label>
                                            <input type="number" step="0.01" name="minimum_order_amount" value="{{ $coupon->minimum_order_amount }}" placeholder="e.g., 100.00">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Usage Limit (Optional)</label>
                                            <input type="number" name="discount_count" value="{{ $coupon->discount_count }}" placeholder="Enter total usage limit">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Expiry Date (Optional)</label>
                                            <input type="date" name="expiry_date" value="{{ $coupon->expiry_date ? $coupon->expiry_date->format('Y-m-d') : '' }}" class="form-control">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1" {{ $coupon->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $coupon->status == 'active' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>

                                        <div class="input__button mt-3">
                                            <button type="submit" class="btn btn-blue">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    @endpush
