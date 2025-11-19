@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- PRINT BUTTON --}}
    <button onclick="window.print()" class="btn btn-info text-white mb-3 no-print">
        <i class="fas fa-print"></i> Print Invoice
    </button>

    <div id="printableArea">

        {{-- HEADER --}}
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <div>
                    <h3 class="font-weight-bold text-primary mb-1" style="font-size: 22px;">Order Details</h3>
                    <p class="text-muted mb-0" style="font-size: 15px;">
                        Order ID: <strong>#{{ $order->order_number }}</strong> |
                        Date: {{ $order->created_at->format('d M, Y h:i A') }}
                    </p>
                </div>

                <div class="no-print">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        {{-- ORDER STATUS --}}
        <div class="row mb-3">
            <div class="col-12">
                <div class="row text-center border rounded py-2">

                    <div class="col-3 border-right">
                        <h6 class="text-muted text-uppercase" style="font-size: 14px;">Order Status</h6>
                        @php
                            $statusColor = 'secondary';
                            if ($order->order_status == 'delivered') $statusColor = 'success';
                            elseif ($order->order_status == 'processing') $statusColor = 'info';
                            elseif ($order->order_status == 'cancelled') $statusColor = 'danger';
                            elseif ($order->order_status == 'pending') $statusColor = 'warning';
                        @endphp
                        <span class="badge bg-{{ $statusColor }} p-1" style="font-size: 14px;">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    </div>

                    <div class="col-3 border-right">
                        <h6 class="text-muted text-uppercase" style="font-size: 14px;">Payment Status</h6>
                        <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-danger' }} p-1" style="font-size: 14px;">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>

                    <div class="col-3 border-right">
                        <h6 class="text-muted text-uppercase" style="font-size: 14px;">Payment Method</h6>
                        <strong style="font-size: 15px;">{{ ucfirst($order->payment_method) }}</strong>
                    </div>

                    <div class="col-3">
                        <h6 class="text-muted text-uppercase" style="font-size: 14px;">Tracking No</h6>
                        <strong class="text-primary" style="font-size: 15px;">{{ $order->tracking_number ?? 'N/A' }}</strong>
                    </div>

                </div>
            </div>
        </div>

        {{-- ADDRESSES --}}
        <div class="row mb-3">
            <div class="col-6 pr-1">
                <div class="border rounded p-2">
                    <h6 class="text-uppercase text-muted" style="font-size: 15px;">Billing Address</h6>
                    <address style="font-size: 15px;">
                        <strong>{{ $order->billing_name }}</strong><br>
                        {{ $order->billing_street_address }}<br>
                        {{ $order->billing_city }}, {{ $order->BillingState->name }} -
                        {{ $order->billing_zipcode }}<br>
                        {{ $order->BillingCountry->name }}<br>
                        <i class="fas fa-envelope"></i> {{ $order->billing_email }}<br>
                        <i class="fas fa-phone"></i> {{ $order->billing_phone }}
                    </address>
                </div>
            </div>

            <div class="col-6 pl-1">
                <div class="border rounded p-2">
                    <h6 class="text-uppercase text-muted" style="font-size: 15px;">Shipping Address</h6>
                    <address style="font-size: 15px;">
                        <strong>{{ $order->shipping_name }}</strong><br>
                        {{ $order->shipping_street_address }}<br>
                        {{ $order->shipping_city }}, {{ $order->ShippingState->name }} -
                        {{ $order->shipping_zipcode }}<br>
                        {{ $order->ShippingCountry->name }}<br>
                        <i class="fas fa-envelope"></i> {{ $order->shipping_email }}<br>
                        <i class="fas fa-phone"></i> {{ $order->shipping_phone }}
                    </address>
                </div>
            </div>
        </div>

        {{-- ORDER ITEMS WITH IMAGE --}}
        <div class="row mb-3">
            <div class="col-12">
                <div class="border rounded">
                    <h6 class="p-2 bg-light mb-0" style="font-size: 16px;">Ordered Items</h6>

                    <table class="table table-sm mb-0" style="font-size: 15px;">
                        <thead class="bg-light">
                            <tr>
                                <th>Product</th>
                                <th>Image</th>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->OrderItems as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->product_name }}</strong><br>
                                        <span class="text-muted">Size: {{ $item->size }} | Color: {{ $item->color }}</span>
                                    </td>

                                    <td class="text-center">
                                        <img src="{{ asset('front/assets/images/products/' . $item->thumb) }}"
                                             width="60" height="60" class="rounded border">
                                    </td>

                                    <td class="text-center">${{ number_format($item->price,2) }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>

                                    <td class="text-right font-weight-bold">
                                        ${{ number_format($item->price * $item->quantity,2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        {{-- ORDER SUMMARY --}}
        <div class="row mb-2">
            <div class="col-12">
                <div class="border rounded p-2" style="font-size: 16px;">

                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <strong>${{ number_format($order->subtotal_amount,2) }}</strong>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Shipping</span>
                        <strong>+ ${{ number_format($order->shipping_amount,2) }}</strong>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Tax / VAT</span>
                        <strong>+ ${{ number_format($order->tax_amount,2) }}</strong>
                    </div>

                    @if($order->discounted_amount > 0)
                        <div class="d-flex justify-content-between text-success">
                            <span>Discount ({{ $order->coupon_code ?? '' }})</span>
                            <strong>- ${{ number_format($order->discounted_amount,2) }}</strong>
                        </div>
                    @endif

                    <hr class="my-1">

                    <div class="d-flex justify-content-between">
                        <h5 class="mb-0">Grand Total</h5>
                        <h5 class="text-primary font-weight-bold mb-0">
                            ${{ number_format($order->total_amount,2) }}
                        </h5>
                    </div>

                </div>
            </div>
        </div>

        <p class="text-muted" style="font-size: 15px;">
            <strong>Customer Note:</strong> No additional notes provided.
        </p>

    </div>
</div>


{{-- PRINT CSS --}}
<style>
@media print {

    body * { visibility: hidden; }
    #printableArea, #printableArea * { visibility: visible; }

    #printableArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 0 !important;
        margin: 0 !important;
    }

    @page {
        size: A4;
        margin: 0.5cm;
    }

    .no-print { display: none !important; }

    .table td, .table th {
        padding: 5px !important;
    }

    h3, h4, h5, h6 {
        margin: 2px 0 !important;
    }

}
</style>

@endsection
