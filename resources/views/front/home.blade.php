@extends('front.template._base')

@section('css')
    <style>
        .bhome_cat img {
            opacity: 0.7
        }
        .top-80 {
            top: 80% !important;
        }
    </style>
@endsection

@section('content')

@if ($home->banners && $home->banner_show)
<!-- banner start -->
<div class="banner-style-01">                
    <div class="banner-slider">
        @foreach ($home->banners as $item)
        <div>
            <div class="banner__bg d-flex align-items-center" style="background: url('{{ asset('storage/' . $item->imageb1) }}') no-repeat center center/cover">
                <div class="container-fluid px-5">
                    <div class="banner-content">
                        <h3 class="subtitle" data-animation-in="fadeInLeft">{{ $item->title }}</h3>
                        <h2 class="title" data-animation-in="fadeInRight">{{ $item->subtitle }}</h2>
                        @if ($item->btn_show && $item->btn_url)
                        <div class="margin-top-50 pl-1">
                            <div class="btn-wrapper" data-animation-in="fadeInDown">
                                <a class="btn btn-white" href="{{ $item->btn_url }}" target="{{ $item->btn_target ? '_blank' : '_self' }}">{{ $item->btn_text}} <i class="icon-arrow-buttom"></i></a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- banner end -->
@endif

@if ($home->about_show)
<!-- about content start  -->
<div class="about-content margin-top-80 padding-bottom-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="content-left">
                    <h3>{{ $home->about_title }}</h3>
                    {!! $home->about_description !!}
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <div class="btn-wrapper text-center margin-top-55 ">
                                <a href="{{ route('about') }}" class="btn btn-white">Ver más +</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="thumb">
                    <img src="{{ asset('storage/' . $home->about_image) }}" alt="{{ $home->about_title}}">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about content end  --> 
@endif

@if ($sectors && $home->sector_show)
<!-- collection banner start  -->
<div class="collection-banner">
    <div class="container">
        <div class="row">
            @foreach ($sectors as $item)
            <div class="col-lg-4">
                <div class="collection-style-01 margin-top-20">
                    <div class="thumb">
                        <img src="{{ asset('storage/' . $item->home_image) }}" alt="Imagen de sector">
                        <div class="content">
                            <h3>{{ $item->name }}</h3>
                            <h6>{{ $item->home_text}}</h6>
                            <a href="{{ route('products', ['sector' => [$item->slug]]) }}">{{ $item->home_btn_text ? :'VER MÁS' }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- collection area end  -->
@endif

@if ($home->product_show && $products)
<!-- arrivals area start  -->
<div class="arrivals-area margin-top-70">
    <div class="container">
        @if ($home->product_title)
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h3>{{ $home->product_title }}</h3>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            @foreach ($products as $product)
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="product-style-01 margin-top-40">
                    <div class="thumb">
                        <div class="thumb-slider">
                            @foreach ($product->image_items as $image)
                            <a href="{{ route('products') }}"><img src="{{ asset('storage/' . $image) }}" alt="{{ $product->title}}"></a>
                            @endforeach
                        </div>
                    </div>
                    <div class="content text-center">
                        <div class="content-hover d-flex justify-content-between">
                            <ul class="product-color">
                                @foreach ($product->colors as $color)
                                <li><a href="#"><span style="background: {{$color->code}}"></span></a></li>
                                @endforeach
                                {{-- <li><a href="#"><span class="red"></span></a></li> --}}
                            </ul>
                            <ul class="product-size">
                                @foreach ($product->sizes as $size)
                                <li><a href="#">{{ $size->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="content-bottom">
                            <span class="brand">MARCA:{{ $product->brand->name }}</span>
                            <h6 class="title"><a href="#">{{ $product->title }}</a></h6>
                            <div class="content-price d-flex align-self-center justify-content-center">
                                <span class="new-price">{{ $info->currency }} {{ $product->price }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            @endforeach
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-wrapper text-center margin-top-55">
                    <a href="{{ route('products')   }}" class="btn btn-more">Ver más +</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- arrivals area end  -->
@endif

@if ($home->offert_show)
<!-- sale area start  -->
<div class="sale-area padding-top-80">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-12">
                <div class="sales-content" style="background: url('{{ asset('storage/' . $home->offert_image) }}') no-repeat center center/cover;">
                    <h2>{{ $home->offert_title }}</h2>
                    <h6>{{ $home->offert_subtitle }}</h6>
                    @if ($home->offert_btn_show)
                    <div class="btn-wrapper">
                        <a href="{{ route('products') }}" target="{{ $home->offert_btn_target ? '_blank' : '_self'}}" class="btn btn-sales">{{ $home->offert_btn_text}} <i class="icon-arrow-buttom"></i></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sale area end  -->
@endif

@if ($categories && $home->category_show)
<!-- collection section start  -->
<div class="collection-section padding-top-70 padding-bottom-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center margin-bottom-40">
                    <h3>{{ $home->category_title }}</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="collection-slider">
                    @foreach ($categories as $category)
                    <div class="collection-item">
                        <div class="thumb bhome_cat">
                            <img src="{{ asset('storage/' . $category->home_image ) }}" alt="{{ $category->name }}">
                            <div class="top-80 thumb-content">
                                <h2>{{ $category->name }}</h2>
                                <div class="btn-wrapper">
                                    <a href="{{ route('products') }}" class="btn btn-white">VER MÁS <i class="icon-arrow-buttom"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- collection section end  -->
@endif

@if ($brands && $home->brands_show)
<!-- brand-area start -->
<div class="brand-area padding-top-30 padding-bottom-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="brand-slider">
                    @foreach ($brands as $brand)
                    <div class="brant-item">
                        <img src="{{ asset('storage/' . $brand->home_image )}}" alt="{{ $brand->name }}">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand-area end -->
@endif

@if ($home->clients_show)
<!-- brand-area start -->
<div class="brand-area padding-top-30 padding-bottom-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="brand-slider">
                    @foreach ($home->clients_items as $item)
                    <div class="brant-item">
                        <img src="{{ asset('storage/' . $item) }}" alt="Cliente">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand-area end -->
@endif

@endsection