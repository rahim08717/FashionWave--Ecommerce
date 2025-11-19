@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Site Settings</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Site Settings</li>
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
                                    action="{{ route('admin.setting.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-vertical__item bg-style">
                                        <div class="item-top mb-30">
                                            <h2>Update Site Settings</h2>
                                        </div>

                                        <h4>General Information</h4>
                                        <div class="input__group mb-25">
                                            <label>Site Name</label>
                                            <input type="text" name="site_name" value="{{ $setting->site_name }}" placeholder="Enter Site Name">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>Phone</label>
                                            <input type="text" name="phone" value="{{ $setting->phone }}" placeholder="Enter Phone Number">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ $setting->email }}" placeholder="Enter Email Address">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>Address</label>
                                            <textarea name="address" class="form-control" rows="3">{{ $setting->address }}</textarea>
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>Map Iframe Link</label>
                                            <textarea name="map_ifram" class="form-control" rows="3">{{ $setting->map_ifram }}</textarea>
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>Copyright Text</label>
                                            <input type="text" name="copyright" value="{{ $setting->copyright }}" placeholder="Enter Copyright Text">
                                        </div>

                                        <hr>
                                        <h4>Social Media Links</h4>
                                        <div class="input__group mb-25">
                                            <label>Facebook Link</label>
                                            <input type="url" name="fb" value="{{ $setting->fb }}" placeholder="Enter Facebook URL">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>Twitter Link</label>
                                            <input type="url" name="twitter" value="{{ $setting->twitter }}" placeholder="Enter Twitter URL">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>LinkedIn Link</label>
                                            <input type="url" name="linkdin" value="{{ $setting->linkdin }}" placeholder="Enter LinkedIn URL">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>YouTube Link</label>
                                            <input type="url" name="youtube" value="{{ $setting->youtube }}" placeholder="Enter YouTube URL">
                                        </div>

                                        <hr>
                                        <h4>Site Images</h4>

                                        <div class="input__group mb-25">
                                            <label>Logo</label>
                                            <input type="file" name="logo" class="putImageLogo">
                                            <img src="{{ asset('front/assets/images/' . $setting->logo) }}"
                                                class="admin_image" id="previewImageLogo"
                                                style="max-width:180px; margin-top:10px;display: {{ $setting->logo ? 'block' : 'none' }}; ">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Favicon (.ico / .png)</label>
                                            <input type="file" name="favicon" class="putImageFavicon">
                                            <img src="{{ asset('front/assets/images/' . $setting->favicon) }}"
                                                class="admin_image" id="previewImageFavicon"
                                                style="max-width:50px; margin-top:10px;display: {{ $setting->favicon ? 'block' : 'none' }}; ">
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>OG Image (For Social Share)</label>
                                            <input type="file" name="og_image" class="putImageOg">
                                            <img src="{{ asset('front/assets/images/' . $setting->og_image) }}"
                                                class="admin_image" id="previewImageOg"
                                                style="max-width:180px; margin-top:10px;display: {{ $setting->og_image ? 'block' : 'none' }}; ">
                                        </div>

                                        <hr>
                                        <h4>SEO Section</h4>
                                        <div class="input__group mb-25">
                                            <label>Meta Title</label>
                                            <input type="text" name="meta_title" value="{{ $setting->meta_title }}" placeholder="Enter Meta Title">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>Meta Description</label>
                                            <textarea name="meta_description" class="form-control" rows="3">{{ $setting->meta_description }}</textarea>
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>Meta Keywords</label>
                                            <textarea name="meta_keyword" class="form-control" rows="3">{{ $setting->meta_keyword }}</textarea>
                                        </div>

                                        <div class="input__button mt-3">
                                            <button type="submit" class="btn btn-blue">Update Settings</button>
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
            // Logo Preview
            $('.putImageLogo').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImageLogo').attr('src', e.target.result);
                    $('#previewImageLogo').show();
                }
                reader.readAsDataURL(this.files[0]);
            });

            // Favicon Preview
            $('.putImageFavicon').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImageFavicon').attr('src', e.target.result);
                    $('#previewImageFavicon').show();
                }
                reader.readAsDataURL(this.files[0]);
            });

            // OG Image Preview
            $('.putImageOg').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImageOg').attr('src', e.target.result);
                    $('#previewImageOg').show();
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
