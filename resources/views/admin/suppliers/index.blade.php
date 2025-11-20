@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Supplier List</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Supplier List</li>
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
                            <a href="{{ route('admin.supplier.create') }}" class="btn btn-md btn-info">Add Supplier</a>
                        </div>
                    </div>
                    <div class="customers__table">
                        <div class="dataTables_wrapper no-footer">
                            <table id="SupplierTable"
                                class="dataTableHover row-border data-table-filter table-style dataTable no-footer"
                                role="grid" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 50px;">S</th>
                                        <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 200px;">Name</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 250px;">Email</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 150px;">Phone</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 300px;">Address</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $supplier)
                                        <tr role="row" class="odd">
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="sorting_1">{{ $supplier->name }}</td>
                                            <td>{{ $supplier->email }}</td>
                                            <td>{{ $supplier->phone }}</td>
                                            <td>{{ $supplier->address }}</td>
                                            <td>
                                                <div class="action__buttons">
                                                    <a href="{{ route('admin.supplier.edit', $supplier->id) }}"
                                                        class="btn-action" title="Edit">
                                                        <i class="fas fa-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn-action">
                                                        <form action="{{ route('admin.suppliers.delete', $supplier->id) }}"
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

@push('script')
@endpush
