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
                            <h2>Contact Us</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/admin/dashboard">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-3 mb-4">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h5 class="mb-0">Contact Details</h5>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light w-25">Name:</th>
                                    <td>{{ $contact->firstname }} {{ $contact->lastname }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Email:</th>
                                    <td>{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Phone:</th>
                                    <td>{{ $contact->contact_phone }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Message:</th>
                                    <td style="white-space: pre-wrap;">{{ $contact->message }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!--Row-->

    </div>
@endsection


@push('script')
@endpush
