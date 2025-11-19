@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Trnasaction List</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Transaction List</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="customers__area bg-style mb-30">

                    <div class="customers__table">
                        <div class="dataTables_wrapper no-footer">
                            <table class="dataTableHover row-border data-table-filter table-style dataTable no-footer">
                                <thead>
                                    <tr role="row">
                                        <th>S.N.</th>
                                        <th>Customer Email</th>
                                        <th>Transaction Id</th>
                                        <th>Order Status</th>
                                        <th>Payment Method</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $data)
                                        <tr role="row" class="odd">
                                            <td>{{ $loop->iteration }}</td>

                                            <td>
                                                <span
                                                    class="text-primary font-weight-bold">{{ $data->user->email ?? 'N/A' }}</span>
                                            </td>
                                            <td>{{ $data->transaction_id ?? "N/A" }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $data->payment_status == 'paid' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ ucfirst($data->payment_status) }}
                                                </span>
                                            </td>
                                            <td>{{ ucfirst($data->payment_method) }}</td>
                                             <td>${{ number_format($data->total_amount, 2) }}</td>

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
