@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Create New Purchase</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Create Purchase</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        {{-- MAIN BODY --}}
        <div class="row">
            <div class="col-md-12">
                <div class="gallery__area bg-style p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.purchases.store') }}">
                        @csrf

                        {{-- PURCHASE DETAILS --}}
                        <div class="form-vertical__item bg-style p-4 mb-25">
                            <h3 class="mb-3">Purchases Details</h3>
                            

                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label>Supplier *</label>
                                    <select name="supplier_id" class="form-control" required>
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Invoice Number *</label>
                                    <input type="text" name="invoice_number" class="form-control" placeholder="INV-101">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Purchase Date *</label>
                                    <input type="date" name="purchases_date" value="{{ date('Y-m-d') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Notes</label>
                                    <textarea name="notes" class="form-control" placeholder="Notes"></textarea>
                                </div>

                            </div>
                        </div>

                        {{-- PURCHASE ITEMS --}}
                        <div class="form-vertical__item bg-style p-4">

                            <h3 class="mb-3">Purchase Items</h3>

                            {{-- ADD BUTTON --}}
                            <div class="text-right mb-3">
                                <button type="button" class="btn btn-primary" id="add-row">+ Add Item</button>
                            </div>

                            <div id="product-items">
                                <div class="item-row mb-3 p-3 border rounded">

                                    <div class="row align-items-end">

                                        <div class="col-md-3">
                                            <label>Choose Product</label>
                                            <select name="product_id[]" class="form-control">
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->en_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label>Qty</label>
                                            <input type="number" name="quantity[]" class="form-control qty" value="1"
                                                min="1">
                                        </div>

                                        <div class="col-md-3">
                                            <label>Purchase Price</label>
                                            <input type="number" name="purchase_price[]" class="form-control price"
                                                step="0.01">
                                        </div>

                                        <div class="col-md-3">
                                            <label>Sub Total</label>
                                            <input type="number" name="subtotal[]" class="form-control subtotal" readonly>
                                        </div>

                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger remove-item">X</button>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="mt-3">
                                <label>Total Amount</label>
                                <input readonly type="text" id="total_amount" name="total_amount" class="form-control"
                                    placeholder="Total Amount">
                            </div>

                        </div>

                        <button type="submit" class="btn btn-blue mt-3">Create</button>

                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            function calculateTotal() {
                let total = 0;

                $('.item-row').each(function() {
                    let qty = parseFloat($(this).find('.qty').val()) || 0;
                    let price = parseFloat($(this).find('.price').val()) || 0;
                    let subtotal = qty * price;

                    $(this).find('.subtotal').val(subtotal.toFixed(2));
                    total += subtotal;
                });

                $('#total_amount').val(total.toFixed(2));
            }

            $(document).on('input', '.qty, .price', calculateTotal);

            $(document).on('click', '.remove-item', function() {
                if ($('.item-row').length > 1) {
                    $(this).closest('.item-row').remove();
                    calculateTotal();
                }
            });

            $('#add-row').on('click', function() {
                let newRow = $('.item-row').first().clone();
                newRow.find("input").val("");
                newRow.find('.qty').val(1);
                newRow.find('.subtotal').val("");
                $('#product-items').append(newRow);
            });

        });
    </script>
@endpush
