@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="breadcrumb__content mb-3">
                <h2>Current Stoak</h2>
            </div>

            <div class="table-responsive">
                <table id="StockTable"
                       class="table table-hover table-bordered text-center align-middle">

                    <thead class="bg-light">
                        <tr>
                            <th>SL.</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Current Stock</th>
                            <th>Min. Stock</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($products as $key => $product)

                            @php
                                $danger = $product->current_stock <= $product->min_stock;
                            @endphp

                            <tr class="{{ $danger ? 'bg-danger text-white' : '' }}">

                                <td>{{ $key + 1 }}</td>

                                <td class="fw-bold">{{ $product->en_name }}</td>

                                <td>
                                    <span class="text-primary fw-bold" style="text-decoration: underline;">
                                        {{ $product->category->en_category_name ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="fw-bold">
                                    {{ $product->current_stock }}
                                </td>

                                <td class="fw-bold">
                                    {{ $product->min_stock }}
                                </td>

                                <td>
                                    @if($danger)
                                        <span class="badge bg-danger">Low Stock</span>
                                    @else
                                        <span class="badge bg-success">In Stock</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.purchases.create') }}" class="btn btn-warning btn-sm fw-bold px-3">
                                        Reorder
                                    </a>
                                </td>

                            </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#StockTable').DataTable({
        "pageLength": 10,
        "lengthMenu": [10, 25, 50, 100]
    });
});
</script>
@endpush
