@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- ... Breadcrumb ... --}}
        <div class="row">
            <div class="col-md-12">
                <div class="gallery__area bg-style">
                    <div class="gallery__content">
                        <form enctype="multipart/form-data" method="POST"
                            action="{{ route('admin.product.store') }}">
                            @csrf
                            <div class="form-vertical__item bg-style">
                                <div class="item-top mb-30">
                                    <h2>Add New Product</h2>
                                </div>

                                {{-- Top Fields: Category, Brand, Name, Slug, Price, Quantity --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input__group mb-25">
                                            <label>Category</label>
                                            <select name="category_id" class="form-control" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->en_category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input__group mb-25">
                                            <label>Brand</label>
                                            <select name="brand_id" class="form-control" required>
                                                <option value="">Select Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                        {{ $brand->en_brand_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input__group mb-25"> <label>Product Name (EN)</label>
                                            <input type="text" name="en_name" value="{{ old('en_name') }}" placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input__group mb-25"> <label>Slug</label>
                                            <input type="text" name="slug" value="{{ old('slug') }}" placeholder="Enter Slug">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input__group mb-25"> <label>Price</label>
                                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="Enter Price">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input__group mb-25"> <label>Quantity</label>
                                            <input type="number" name="quantity" value="{{ old('quantity') }}" placeholder="Enter Quantity">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input__group mb-25"> <label>Discount (Optional)</label>
                                            <input type="number" step="0.01" name="discount" value="{{ old('discount', 0) }}" placeholder="Enter Discount Amount">
                                        </div>
                                    </div>
                                </div>

                                {{-- Description and Additional Info (Summernote) --}}
                                <div class="input__group mb-25">
                                    <label>Product Description (EN)</label>
                                    <textarea name="en_description" id="en_description_summernote" class="summernote" placeholder="Enter Description">{{ old('en_description') }}</textarea>
                                </div>
                                <div class="input__group mb-25">
                                    <label>Additional Info (EN)</label>
                                    <textarea name="en_additional_info" id="en_additional_info_summernote" class="summernote" placeholder="Enter Additional Info">{{ old('en_additional_info') }}</textarea>
                                </div>

                                {{-- Image and Status --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input__group mb-25">
                                            <label>Product Image</label>
                                            <input type="file" name="product_image" class="putImage">
                                            <img class="admin_image" id="previewImage" style="max-width:180px; margin-top:10px; display:none;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input__group mb-25">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- Feature Checkboxes --}}
                                <div class="input__group mb-25">
                                    <label>Product Features</label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">Is Featured</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_best_selling" value="1" id="is_best_selling" {{ old('is_best_selling') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_best_selling">Is Best Selling</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_new_arrival" value="1" id="is_new_arrival" {{ old('is_new_arrival') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_new_arrival">Is New Arrival</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_onsale" value="1" id="is_onsale" {{ old('is_onsale') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_onsale">Is Onsale</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- SEO Fields --}}
                                <div class="input__group mb-25"> <label>Meta Title</label>
                                    <input type="text" name="meta_title" value="{{ old('meta_title') }}" placeholder="Meta Title">
                                </div>
                                <div class="input__group mb-25"> <label>Meta Description</label>
                                    <textarea name="meta_description" placeholder="Meta Description">{{ old('meta_description') }}</textarea>
                                </div>
                                <div class="input__group mb-25"> <label>Meta Keyword</label>
                                    <input type="text" name="meta_keyword" value="{{ old('meta_keyword') }}" placeholder="Meta Keyword">
                                </div>
                                <div class="input__group mb-25"> <label>Product Note</label>
                                    <input type="text" name="product_note" value="{{ old('product_note') }}" placeholder="Product Note (e.g., Warranty)">
                                </div>
                                <div class="input__group mb-25"> <label>Estimated Delivery</label>
                                    <input type="text" name="estimated_delivery" value="{{ old('estimated_delivery') }}" placeholder="e.g., 3-5 Business Days">
                                </div>
                                <div class="input__group mb-25"> <label>Shipping Information (EN)</label>
                                    <textarea name="en_shipping" placeholder="Enter Shipping Details">{{ old('en_shipping') }}</textarea>
                                </div>

                                <div class="input__button mt-3">
                                    <button type="submit" class="btn btn-blue">Save Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Image preview script
        $(document).ready(function() {
            $('.putImage').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(this.files[0]);
            });
            // Summernote initialization
            $('.summernote').summernote({
                placeholder: 'Write description here...',
                tabsize: 2,
                height: 150
            });
        });
    </script>
@endpush
