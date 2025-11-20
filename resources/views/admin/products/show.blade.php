{{-- resources/views/products/show.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            {{-- Product Title + Edit Button --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>{{ $product->en_name }} Details</h2>
                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-pencil-alt"></i> Edit
                </a>
            </div>

            {{-- Product Image --}}
            @if($product->product_image)
                <div class="text-center mb-4">
                    <img src="{{ asset('front/assets/images/products/' . $product->product_image) }}"
                         alt="{{ $product->en_name }}"
                         class="img-fluid rounded shadow-sm"
                         style="max-height:400px; object-fit:cover;">
                </div>
            @endif

            {{-- Basic Info + Pricing Side by Side --}}
            <div class="row mb-4">
                {{-- Basic Information --}}
                <div class="col-lg-6 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">🏷️ Basic Information</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $product->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name (English)</th>
                                        <td>{{ $product->en_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Slug</th>
                                        <td>{{ $product->slug }}</td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td>{{ $product->category->category_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Brand</th>
                                        <td>{{ $product->brand->brand_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Estimated Delivery</th>
                                        <td>{{ $product->estimated_delivery }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <span class="badge {{ $product->status ? 'bg-success' : 'bg-danger' }}">
                                                {{ $product->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Pricing & Inventory --}}
                <div class="col-lg-6 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">💰 Pricing & Inventory</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th>Price</th>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Discount</th>
                                        <td>{{ $product->discount }}</td>
                                    </tr>
                                    <tr>
                                        <th>Discount Price</th>
                                        <td>${{ $product->discounted_price }}</td>
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <td>{{ $product->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <th>Featured</th>
                                        <td>{{ $product->is_featured ? 'Yes' : 'No' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Best Selling</th>
                                        <td>{{ $product->is_best_selling ? 'Yes' : 'No' }}</td>
                                    </tr>
                                    <tr>
                                        <th>New Arrival</th>
                                        <td>{{ $product->is_new_arrival ? 'Yes' : 'No' }}</td>
                                    </tr>
                                    <tr>
                                        <th>On Sale</th>
                                        <td>{{ $product->is_onsale ? 'Yes' : 'No' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">📝 Description</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <p class="fw-bold mb-1">English Description:</p>
                                <div class="border p-2 rounded bg-white">{!! $product->en_description !!}</div>
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-1">Shipping Info:</p>
                                <div class="border p-2 rounded bg-white">{!! $product->en_shipping !!}</div>
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-1">Additional Info:</p>
                                <div class="border p-2 rounded bg-white">{!! $product->en_additional_info !!}</div>
                            </div>
                            @if($product->product_note)
                            <p><strong>Product Note:</strong> {{ $product->product_note }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEO --}}
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">🔍 SEO (Search Engine Optimization)</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Meta Title:</strong> {{ $product->meta_title }}</li>
                                <li class="list-group-item"><strong>Meta Description:</strong> {{ $product->meta_description }}</li>
                                <li class="list-group-item"><strong>Meta Keyword:</strong> {{ $product->meta_keyword }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Back Button --}}
            <div class="mb-5">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
