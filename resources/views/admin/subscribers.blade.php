@extends('admin.layouts.app')

<!-- hero-section area start here  -->
@section('content')
    <div class="container-fluid">
        <div id="table-url" data-url="http://127.0.0.1:8000/admin/contact-us/index"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Subscribers list</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Subscribers</li>
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
                        <div id="ContactUsTable_wrapper" class="dataTables_wrapper no-footer">
                            <div class="dataTables_length" id="ContactUsTable_length"><label>Show <select
                                        name="ContactUsTable_length" aria-controls="ContactUsTable" class="">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries</label></div>
                            <div id="ContactUsTable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                        class="" placeholder="" aria-controls="ContactUsTable"></label></div>
                            <div id="ContactUsTable_processing" class="dataTables_processing" style="display: none;">
                                Processing...</div>
                            <table id="ContactUsTable"
                                style="width:100%; border-collapse: collapse; background:#ffffff; border-radius:12px; overflow:hidden; font-family:Arial, sans-serif; box-shadow:0 4px 15px rgba(0,0,0,0.08);">

                                <thead>
                                    <tr style="background:#0d6efd; color:#fff; text-align:left;">
                                        <th style="padding:12px 16px;">Sl.</th>
                                        <th style="padding:12px 16px;">Email</th>
                                        <th style="padding:12px 16px;">Created At</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($subscribers as $data)
                                        <tr style="border-bottom:1px solid #e6e6e6; transition:0.2s;">
                                            <td style="padding:12px 16px;">{{ $loop->iteration }}</td>
                                            <td style="padding:12px 16px;">{{ $data->email }}</td>
                                            <td style="padding:12px 16px;">{{ $data->created_at->format('j F, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->

    </div>
@endsection


@push('script')
@endpush
