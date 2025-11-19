@extends('admin.layouts.app')
{{-- Summernote CSS (এখানে বা app.blade.php-তে যোগ করুন) --}}



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Edit Page</h2> </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Page</li> </ul>
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
                                    action="{{ route('admin.pages.update', $page->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-vertical__item bg-style">
                                        <div class="item-top mb-30">
                                            <h2>Edit Page Content</h2> </div>

                                        <div class="input__group mb-25">
                                            <label>Page Title</label>
                                            <input type="text" name="title" value="{{ $page->title }}" placeholder="Enter Page Title">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Slug</label>
                                            <input type="text" name="slug" value="{{ $page->slug }}" placeholder="Enter Slug">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Description</label>
                                            <textarea name="description" id="summernote" class="form-control">{{ $page->description }}</textarea>
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Page Image (Optional)</label>
                                            <input type="file" name="image" class="putImage">
                                            <img src="{{ asset('front/assets/images/page/' . $page->image) }}"
                                                class="admin_image" id="previewImage"
                                                style="max-width:180px; margin-top:10px;display: {{ $page->image ? 'block' : 'none' }}; ">
                                        </div>

                                        <hr>
                                        <h4>SEO Section</h4>

                                        <div class="input__group mb-25">
                                            <label>Meta Title</label>
                                            <input type="text" name="meta_title" value="{{ $page->meta_title }}" placeholder="Enter Meta Title">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Meta Description</label>
                                            <textarea name="meta_description" class="form-control" rows="3">{{ $page->meta_description }}</textarea>
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Meta Keyword</label>
                                            <textarea name="meta_keyword" class="form-control" rows="3">{{ $page->meta_keyword }}</textarea>
                                        </div>


                                        <div class="input__button mt-3">
                                            <button type="submit" class="btn btn-blue">Update Page</button>
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
            // Summernote ইনিশিয়ালাইজেশন
            $('#summernote').summernote({
                placeholder: 'Enter page description...',
                tabsize: 2,
                height: 300
            });

            // ইমেজ প্রিভিউ
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
