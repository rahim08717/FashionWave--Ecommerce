@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Pages List</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pages List</li>
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
                                        <th>Page Title</th>
                                        <th>Slug</th>
                                        <th>Image</th>
                                        <th>Description (Short)</th>
                                        <th>Meta Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pages as $page)
                                        <tr role="row" class="odd">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $page->title }}</td>
                                            <td>{{ $page->slug }}</td>
                                            <td>
                                                <img src="{{ asset('front/assets/images/page/' . $page->image) }}"
                                                    alt="image" width="100">
                                            </td>

                                            <td>
                                                <div
                                                    style="max-height: 150px; overflow-y: auto; border: 1px solid #eee; padding: 5px;">
                                                    {!! $page->description !!}
                                                </div>
                                            </td>

                                            <td>{{ $page->meta_title }}</td>
                                            <td>
                                                <div class="action__buttons" style="display: flex; gap: 10px;">
                                                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn-action"
                                                        title="Edit">
                                                        <i class="fas fa-pencil"></i>
                                                    </a>

                                                    <form action="{{ route('admin.pages.delete', $page->id) }}"
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
