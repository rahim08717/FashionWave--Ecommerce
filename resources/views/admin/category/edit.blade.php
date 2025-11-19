@extends('admin.layouts.app')

<!-- hero-section area start here  -->
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Edit Category</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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
                                    action="{{ route('admin.category.update', $category->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-vertical__item bg-style">

                                        <div class="item-top mb-30">
                                            <h2>Update Category</h2>
                                        </div>

                                        <!-- Title -->
                                        <div class="input__group mb-25">
                                            <label>Category Name</label>
                                            <input type="text" name="name" value="{{ $category->en_category_name }}"
                                                placeholder="Enter Category Name">
                                        </div>

                                        <!-- Sub Title -->
                                        <div class="input__group mb-25">
                                            <label>Short Info</label>
                                            <input type="text" name="short_info" value="{{ $category->en_short_info }}"
                                                placeholder="Enter Short Info">
                                        </div>
                                         {{-- <div class="input__group mb-25">
                                            <label>Slug</label>
                                            <input type="text" name="slug" value="{{ $category->slug  }}"
                                                placeholder="Enter Slug">
                                        </div> --}}
                                         <div class="input__group mb-25">
                                            <label>Meta Title</label>
                                            <input type="text" name="meta_title" value="{{ $category->meta_title }}"
                                                placeholder="Enter Meta Title">
                                        </div>
                                         <div class="input__group mb-25">
                                            <label>Meta Keyword</label>
                                            <input type="text" name="meta_keyword" value="{{ $category->meta_keyword }}"
                                                placeholder="Enter Meta Keyword">
                                        </div>
                                         <div class="input__group mb-25">
                                            <label>Meta Description</label>
                                            <input type="text" name="meta_description" value="{{ $category->meta_description }}"
                                                placeholder="Enter Meta Description">
                                        </div>

                                        <!-- Description -->
                                        <div class="input__group mb-25">
                                            <label>Description</label>
                                            <textarea name="description" placeholder="Enter Description">{{ $category->description }}</textarea>
                                        </div>



                                        <div class="input__group mb-25">
                                            <label>Category Image</label>
                                            <input type="file" name="icon" class="putImage">

                                            <img src="{{ asset('front/assets/images/' . $category->icon) }}"
                                                class="admin_image" id="previewImage"
                                                style="max-width:180px; margin-top:10px;display: {{ $category->icon ? 'block' : 'none' }}; ">
                                        </div>


                                        <!-- Status -->
                                        <div class="input__group mb-25">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0"{{ $category->status == 0 ? 'selected' : '' }}>Inactive
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
