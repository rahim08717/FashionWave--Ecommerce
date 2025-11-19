@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Order List</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Order List</li>
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
                            <a href="{{ route('admin.orders.create') }}" class="btn btn-md btn-info">Add New Order</a>
                        </div>
                    </div>

                    <div class="customers__table">
                        <div class="dataTables_wrapper no-footer">
                            <table class="dataTableHover row-border data-table-filter table-style dataTable no-footer">
                                <thead>
                                    <tr role="row">
                                        <th>S.N.</th>
                                        <th>Order ID</th>
                                        <th>Billing Name</th>
                                        <th>Discounted Amount</th>
                                        <th>Tax Amount</th>
                                        <th>Shipping Ammount</th>
                                        <th>Subtotal Amount</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Order Status</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr role="row" class="odd">
                                            <td>{{ $loop->iteration }}</td>

                                            <td>
                                                <span
                                                    class="text-primary font-weight-bold">#{{ $order->order_number }}</span>
                                            </td>

                                            <td>{{ $order->billing_name }}</td>
                                            <td>{{ $order->discounted_amount }}</td>
                                            <td>{{ $order->tax_amount }}</td>
                                            <td>{{ $order->shipping_amount }}</td>
                                            <td>{{ $order->subtotal_amount }}</td>

                                            <td>${{ number_format($order->total_amount, 2) }}</td>
                                            <td>{{ ucfirst($order->payment_method) }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </td>
                                            <td> {{ ucfirst($order->order_status) }}</td>
                                            <td>
                                                <div class="action__buttons" style="display: flex; gap: 10px;">
                                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                                        class="btn-action" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                        class="btn-action" title="Edit Order">
                                                        <i class="fas fa-pencil"></i>
                                                    </a>
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
