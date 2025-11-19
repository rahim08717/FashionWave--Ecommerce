@extends('front.layouts.app')
@section('title',$data->meta_title)
@section('description',$data->meta_description)
@section('keywords',$data->meta_keywords)

@section('content')
<div class="row">
    @foreach ($categories as $cat )
        <div class="col-lg-4 col-md-6 mb-4">
            <a class="single-categorie" href="{{ route('category.product', $cat->slug) }}">
                <div class="categorie-wrap p-4 text-center shadow-sm border rounded h-100">
                    <img src="{{ asset('front/assets/images/' . $cat->icon) }}" alt="icon">
                    <div class="categorie-info">
                        <h3 class="categorie-name mb-2" style="font-size: 20px; font-weight: 600;">
                            {{ $cat->en_category_name ?? "" }}
                        </h3>
                        <h4 class="categorie-subtitle text-muted" style="font-size: 14px;">
                            {{ $cat->en_short_info ?? "product short" }}
                        </h4>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

@endsection
