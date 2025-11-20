@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Product List</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Product List</li>
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
                            <a href="{{ route('admin.product.create') }}" class="btn btn-md btn-info">Add Product</a>
                        </div>
                    </div>
                    <div class="customers__table">
                        <div class="dataTables_wrapper no-footer">
                            <table class="dataTableHover row-border data-table-filter table-style dataTable no-footer"
                                role="grid" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" style="width: 50px;">S</th>
                                        <th class="sorting" style="width: 150px;">Image</th>
                                        <th class="sorting_asc" style="width: 250px;">Product Name</th>
                                        <th class="sorting" style="width: 150px;">Category</th>
                                        <th class="sorting" style="width: 150px;">Brand</th>
                                        <th class="sorting" style="width: 100px;">Price</th>
                                        <th class="sorting" style="width: 80px;">Status</th>
                                        <th class="sorting_disabled" style="width: 150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr role="row" class="odd">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('front/assets/images/products/' . $product->product_image) }}" alt="image" style="width: 60px; height: 60px; object-fit: cover;">
                                            </td>
                                            <td class="sorting_1">{{ $product->en_name }}</td>
                                            {{-- Display Category Name --}}
                                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                                            {{-- Display Brand Name --}}
                                            <td>{{ $product->brand->name ?? 'N/A' }}</td>
                                            <td>{{ number_format($product->discounted_price, 2) }}</td>
                                            <td>
                                                @if ($product->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action__buttons">
                                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                                        class="btn-action" title="Edit">
                                                        <i class="fas fa-pencil"></i>
                                                    </a>
                                                    <a href="{{ route('admin.product.show', $product->id) }}"
                                                        class="btn-action" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn-action">
                                                        <form action="{{ route('admin.products.delete', $product->id) }}"
                                                            method="POST" style="display: inline-block;"
                                                            onsubmit="return confirm('Are you sure delete?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-action"
                                                                style="border: none; background: transparent;">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
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
