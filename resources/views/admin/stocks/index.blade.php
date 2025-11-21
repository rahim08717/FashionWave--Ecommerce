@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Stock History List</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Stock History List</li>
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
                        {{-- Assuming you will add Create/Adjust button later if needed --}}
                        <div class="col-xs-6">
                            {{-- <a href="#" class="btn btn-md btn-info">Stock Adjustment</a> --}}
                        </div>
                    </div>
                    <div class="customers__table">
                        <div class="dataTables_wrapper no-footer">
                            {{-- Table structure for stock entries --}}
                            <table class="dataTableHover row-border data-table-filter table-style dataTable no-footer"
                                role="grid" aria-describedby="ContactUsTable_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">S</th>
                                        <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1">Product</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Stock Type</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Quantity</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Reference Type</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Reference ID</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Notes</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stocks as $stock)
                                        <tr role="row" class="odd">
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- Access Product Name using the relationship --}}
                                            <td>{{ $stock->ProductName->en_name ?? 'N/A' }}</td>
                                            <td>
                                                {{-- Display stock type with color context --}}
                                                @if ($stock->stock_type == 'in')
                                                    <span style="color: green; font-weight: bold;">{{ $stock->stock_type }}</span>
                                                @elseif ($stock->stock_type == 'out')
                                                    <span style="color: red; font-weight: bold;">{{ $stock->stock_type }}</span>
                                                @else
                                                    {{ $stock->stock_type }}
                                                @endif
                                            </td>
                                            <td>{{ $stock->quantity }}</td>
                                            <td>{{ $stock->reference_type }}</td>
                                            <td>
                                                {{-- Link to the reference resource (e.g., /admin/purchases/1) --}}
                                                @if($stock->reference_id)
                                                    <a href="{{ route('admin.purchases.edit',$stock->reference_id) }}">#{{ $stock->reference_id }}</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $stock->notes }}</td>
                                            <td>{{ $stock->created_at->format('d M Y h:i A') }}</td>
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
    {{-- Add any necessary scripts here, e.g., for DataTables --}}
@endpush
