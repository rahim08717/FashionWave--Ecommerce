@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <h2>Edit Purchase</h2>
                    </div>
                    <div class="breadcrumb__content__right">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Purchase</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="gallery__area bg-style">
                    <div class="gallery__content">

                        <form method="POST" action="{{ route('admin.purchases.update', $purchase->id) }}">
                            @csrf
                            @method('PUT')

                            {{-- Purchase Header --}}
                            <div class="form-vertical__item bg-style mb-30 p-4">
                                <h3>Purchase Details</h3>

                                <div class="input__group mb-25">
                                    <label>Supplier *</label>
                                    <select name="supplier_id" class="form-control" required>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ $supplier->id == $purchase->supplier_id ? 'selected' : '' }}>
                                                {{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input__group mb-25">
                                    <label>Invoice Number *</label>
                                    <input type="text" name="invoice_number" value="{{ $purchase->invoice_number }}"
                                        required>
                                </div>

                                <div class="input__group mb-25">
                                    <label>Purchase Date *</label>
                                    <input type="date" name="purchases_date"
                                        value="{{ $purchase->purchases_date }}" required>
                                </div>

                                <div class="input__group mb-25">
                                    <label>Notes</label>
                                    <textarea name="notes">{{ $purchase->notes }}</textarea>
                                </div>
                            </div>

                            {{-- Purchase Items --}}
                            <div class="form-vertical__item bg-style mt-30 p-4">

                                <div class="d-flex justify-content-between">
                                    <h3>Purchase Items</h3>
                                    <button type="button" class="btn btn-primary" id="add-row">+</button>
                                </div>

                                <div id="product-items">
                                    @foreach ($purchase->items as $item)
                                        <div class="item-row mt-3">
                                            <div class="row">

                                                <div class="col-md-2">
                                                    <label>Product</label>
                                                    <select name="product_id[]" class="form-control">
                                                        @foreach ($product as $p)
                                                            <option value="{{ $p->id }}"
                                                                {{ $p->id == $item->product_id ? 'selected' : '' }}>
                                                                {{ $p->en_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Quantity</label>
                                                    <input type="number" name="quantity[]" value="{{ $item->quantity }}"
                                                        class="qty form-control" min="1">
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Purchase Price</label>
                                                    <input type="number" name="purchase_price[]" class="price form-control"
                                                        value="{{ $item->purchase_price }}" step="0.01">
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Sub Total</label>
                                                    <input type="number" name="subtotal[]" class="subtotal form-control"
                                                        value="{{ $item->subtotal }}" readonly>
                                                </div>

                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger remove-item"
                                                        style="margin-top:30px;">X</button>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="input_group mb-25 mt-3">
                                    <label>Total Amount</label>
                                    <input readonly type="text" id="total_amount" name="total_amount"
                                        value="{{ $purchase->total_amount }}" class="form-control">
                                </div>

                            </div>

                            <button type="submit" class="btn btn-blue mt-3">Update Purchase</button>

                        </form>

                    </div>
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

            $('#add-row').on('click', function() {
                let newRow = $('.item-row').first().clone();

                newRow.find('input[type="number"]').val('');
                newRow.find('.qty').val(1);
                newRow.find('.subtotal').val('');

                $('#product-items').append(newRow);
            });

            $(document).on('click', '.remove-item', function() {
                if ($('.item-row').length > 1) {
                    $(this).closest('.item-row').remove();
                    calculateTotal();
                }
            });

            calculateTotal();
        });
    </script>
@endpush
