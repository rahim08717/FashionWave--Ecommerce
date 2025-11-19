@extends('admin.layouts.app')

<!-- hero-section area start here  -->
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Edit Country</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Country</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="gallery__area bg-style">
                    <div class="gallery__content">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-one" role="tabpanel"
                                aria-labelledby="nav-one-tab">

                                <form enctype="multipart/form-data" method="POST"
                                    action="{{ route('admin.countries.update', $countries->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-vertical__item bg-style">

                                        <div class="item-top mb-30">
                                            <h2>Add New countries</h2>
                                        </div>

                                        <!-- Title -->
                                        <div class="input__group mb-25">
                                            <label>Country Name</label>
                                            <input type="text" name="name" value="{{ $countries->name }}"
                                                placeholder="Enter Country Name">
                                        </div>

                                        <!-- Sub Title -->
                                        <div class="input__group mb-25">
                                            <label>Country Code</label>
                                            <input type="text" name="code" value="{{ $countries->code }}"
                                                placeholder="Enter Country Code">
                                        </div>

                                        <!-- Description -->
                                        <div class="input__group mb-25">
                                            <label>Vat/Tax</label>
                                            <textarea name="vat_tax" placeholder="Enter Vat (%)">{{ $countries->vat_tax }}</textarea>
                                        </div>

                                        <div class="input__button mt-3">
                                            <button type="submit" class="btn btn-blue">Save</button>
                                        </div>

                                    </div>

                                </form>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




@push('script')

@endpush
