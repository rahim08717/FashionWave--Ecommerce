@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Create Coupon</h2> </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Coupon</li> </ul>
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
                                    action="{{ route('admin.coupons.store') }}">
                                    @csrf
                                    <div class="form-vertical__item bg-style">
                                        <div class="item-top mb-30">
                                            <h2>Add New Coupon</h2> </div>

                                        <div class="input__group mb-25">
                                            <label>Coupon Code</label>
                                            <input type="text" name="code" value="{{ old('code') }}" placeholder="Enter Coupon Code (e.g., SUMMER25)">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Discount Type</label>
                                            <select name="type" class="form-control">
                                                <option value="percentage">Percentage (%)</option>
                                                <option value="fixed">Fixed Amount ($)</option>
                                            </select>
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Discount Value</label>
                                            <input type="number" step="0.01" name="discount_value" value="{{ old('discount_value') }}" placeholder="Enter value (e.g., 25 or 25.50)">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Minimum Order Amount (Optional)</label>
                                            <input type="number" step="0.01" name="minimum_order_amount" value="{{ old('minimum_order_amount') }}" placeholder="e.g., 100.00">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Usage Limit (Optional)</label>
                                            <input type="number" name="discount_count" value="{{ old('discount_count') }}" placeholder="Enter total usage limit (e.g., 1000)">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Expiry Date (Optional)</label>
                                            <input type="date" name="expiry_date" value="{{ old('expiry_date') }}" class="form-control">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>

                                        <div class="input__button mt-3">
                                            <button type="submit" class="btn btn-blue">Save</button>
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
