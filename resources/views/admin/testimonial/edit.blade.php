@extends('admin.layouts.app')

<!-- hero-section area start here  -->
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Edit testimonial</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit testimonial</li>
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
                                    action="{{ route('admin.testimonial.update', $testimonial->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-vertical__item bg-style">

                                        <div class="item-top mb-30">
                                            <h2>Update testimonial</h2>
                                        </div>

                                        <!-- Title -->
                                        <div class="input__group mb-25">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ $testimonial->name }}"
                                                placeholder="Enter Name">
                                        </div>

                                        <!-- Sub Title -->
                                        <div class="input__group mb-25">
                                            <label>Profession</label>
                                            <input type="text" name="profession" value="{{ $testimonial->profession }}"
                                                placeholder="Enter profession">
                                        </div>

                                        <!-- Description -->
                                        <div class="input__group mb-25">
                                            <label>Description</label>
                                            <textarea name="description" placeholder="Enter Description">{{ $testimonial->description }}</textarea>
                                        </div>



                                        <div class="input__group mb-25">
                                            <label>testimonial Image</label>
                                            <input type="file" name="image" class="putImage">

                                            <img src="{{ asset('front/assets/images/' . $testimonial->image) }}"
                                                class="admin_image" id="previewImage"
                                                style="max-width:180px; margin-top:10px;display: {{ $testimonial->image ? 'block' : 'none' }}; ">
                                        </div>


                                        <!-- Status -->
                                        <div class="input__group mb-25">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1" {{ $testimonial->status == 1 ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0"{{ $testimonial->status == 0 ? 'selected' : '' }}>Inactive
                                                </option>
                                            </select>
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
    <script>
        $(document).ready(function() {
            $('.putImage').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                    $('#previewImage').show();
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
