@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Purchsases List</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Purchases List</li>
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
                            <a href="{{ route('admin.purchases.create') }}" class="btn btn-md btn-info">Add Purchases</a>
                        </div>
                    </div>
                    <div class="customers__table">
                        <div class="dataTables_wrapper no-footer">
                            <table class="dataTableHover row-border data-table-filter table-style dataTable no-footer"
                                role="grid" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" style="width: 50px;">S</th>
                                        <th class="sorting" style="width: 150px;">Invoice Number</th>
                                        <th class="sorting_asc" style="width: 250px;">Supplier Name</th>
                                        <th class="sorting" style="width: 150px;">Total Amount</th>
                                        <th class="sorting" style="width: 150px;">Purchases Date</th>
                                        <th class="sorting" style="width: 100px;">Notes</th>
                                        <th class="sorting" style="width: 100px;">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $data)
                                        <tr role="row" class="odd">
                                            <td>{{ $loop->iteration }}</td>

                                            <td class="sorting_1">{{ $data->invoice_number}}</td>
                                            {{-- Display Category Name --}}
                                            <td>{{ $data->supplier->name ?? 'N/A' }}</td>
                                            {{-- Display Brand Name --}}
                                            <td>{{ $data->total_amount ?? 'N/A' }}</td>
                                            <td>{{ $data->purchases_date->format('d M , Y')}}</td>
                                            <td>{{ $data->notes }}</td>
                                            <td>
                                                <div class="action__buttons">
                                                    <a href="{{ route('admin.purchases.edit', $data->id) }}"
                                                        class="btn-action" title="Edit">
                                                        <i class="fas fa-pencil"></i>
                                                    </a>

                                                    <a href="#" class="btn-action">
                                                        <form action="{{ route('admin.purchases.delete', $data->id) }}"
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
