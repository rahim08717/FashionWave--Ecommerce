@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Coupons List</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Coupons List</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="customers__area bg-style mb-30">
                    <div class="item-title">
                        <div class="col-xs-6">
                            <a href="{{ route('admin.coupons.create') }}" class="btn btn-md btn-info">Add Coupon</a>
                        </div>
                    </div>
                    <div class="customers__table">
                        <div class="dataTables_wrapper no-footer">
                            <table class="dataTableHover row-border data-table-filter table-style dataTable no-footer">
                                <thead>
                                    <tr role="row">
                                        <th>S.N.</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Discount Value</th>
                                        <th>Min. Order</th>
                                        <th>Usage Limit</th>
                                        <th>Expiry Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $coupon)
                                        <tr role="row" class="odd">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ ucfirst($coupon->type) }}</td>
                                            <td>
                                                @if ($coupon->type == 'percentage')
                                                    {{ $coupon->discount_value }}%
                                                @else
                                                    ${{ number_format($coupon->discount_value, 2) }}
                                                @endif
                                            </td>

                                            <td>${{ number_format($coupon->minimum_order_amount, 2) }}</td>
                                            <td>{{ $coupon->discount_count ?? 'Unlimited' }}</td>
                                            <td>{{ $coupon->expiry_date ? $coupon->expiry_date->format('d M, Y') : 'No Expiry' }}
                                            </td>
                                            <td>
                                                @if ($coupon->status == 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="action__buttons" style="display: flex; gap: 10px;">
                                                    <a href="{{ route('admin.coupons.edit', $coupon->id) }}"
                                                        class="btn-action" title="Edit">
                                                        <i class="fas fa-pencil"></i>
                                                    </a>

                                                    <form action="{{ route('admin.coupons.delete', $coupon->id) }}"
                                                        method="POST" style="display: inline-block;"
                                                        onsubmit="return confirm('Are you sure delete?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-action"
                                                            style="border: none; background: transparent; padding: 0; cursor: pointer;"
                                                            title="Delete">
                                                            <i class="fas fa-trash-alt" style="color: red;"></i>
                                                        </button>
                                                    </form>
                                                </div>
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
@endsection

@push('script')
@endpush
