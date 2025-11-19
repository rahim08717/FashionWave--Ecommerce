@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Admins List</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Admins List</li> <!-- Changed -->
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
                            <!-- Route and text changed -->
                            <a href="{{ route('admin.admins.create') }}" class="btn btn-md btn-info">Add Admin</a>
                        </div>
                    </div>
                    <div class="customers__table">
                        <div class="dataTables_wrapper no-footer">
                            <table class="dataTableHover row-border data-table-filter table-style dataTable no-footer">
                                <thead>
                                    <tr role="row">
                                        <th>S.N.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr role="row" class="odd">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>

                                            <td>
                                                <!-- Path changed -->
                                                <img src="{{ asset('front/assets/images/' . $admin->image) }}" alt="image" width="100" height="100">
                                            </td>

                                            <td>
                                                @if ($admin->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="action__buttons" style="display: flex; gap: 10px;">
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('admin.admins.edit', $admin->id) }}"
                                                        class="btn-action" title="Edit">
                                                        <i class="fas fa-pencil"></i>
                                                    </a>

                                                    <!-- Delete Button (Form) -->
                                                    <form action="{{ route('admin.admins.delete', $admin->id) }}"
                                                          method="POST" style="display: inline-block;"
                                                          onsubmit="return confirm('Are you sure delete?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-action"
                                                                style="border: none; background: transparent; padding: 0; cursor: pointer;"
                                                                title="Delete">
                                                            <i class="fas fa-trash-alt" style="color: red;"></i>
                                                        </button>
                                                    </form>
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
