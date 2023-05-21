@extends('front.template._base')

@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('/') }}packages/lightgallery/css/lightgallery-bundle.css" />
@endsection

@section('content')
    <!-- breadcrumb start  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-inner d-flex justify-content-between">
                        <h2 class="page-title">{{ $detail->title }}</h2>
                        <ul class="page-list">
                            <li><a href="{{ route('home') }}">Inicio</a></li>
                            <li><a href="{{ route('products') }}">Productos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end  -->

    <!-- collection area start  -->
    <div class="collection-area margin-top-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            {{-- <button type="button" id="dynamic-gallery-demo">Open Gallery</button> --}}
                            <!--Galleria -->
                            <div class="gallery_item_images" style="display:none;z-index:10000;">
                                @foreach ($detail->image_items as $item)
                                <a href="{{ asset('storage/' . $item) }}" class="gallery_item_link">
                                    <img src="{{ asset('storage/' . $item) }}">
                                </a>
                                @endforeach
                            </div>
                            <!--Galleria -->
                            <div class="slider-tabfor margin-top-20 ">
                                @foreach ($detail->image_items as $item)
                                    <div class="single-item">
                                        <a href="#" class="gallery_item">
                                            <img src="{{ asset('storage/' . $item) }}" alt="Producto">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="slider-tabnav">
                                @foreach ($detail->image_items as $item)
                                    <div class="single-item">
                                        <div class="img">
                                            <img src="{{ asset('storage/' . $item) }}" alt="Producto">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="content-part margin-top-20">
                                <h3 class="product-title">{{ $detail->name }}</h3>
                                <p class="price">{{ $info->currency }}{{ $detail->price }}</p>
                                <p class="specifications">SKU: <b>{{ $detail->sku }}</b></p>
                                <p class="specifications">MARCA: <b>{{ $detail->brand->name }}</b></p>
                                <p class="specifications">STOCK: <b class="color-green">Disponible</b></p>
                                <div class="d-flex">
                                    <span class="specifications">SIZE: </span>
                                    <ul class="size-list align-self-center pl-3">
                                        @foreach ($detail->sizes as $item)
                                            <li><a href="#">{{ $item->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="d-flex">
                                    <span class="specifications">COLOR: </span>
                                    <ul class="color-list align-self-center">
                                        @foreach ($detail->colors as $item)
                                            <li><a href="#"></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <p class="specifications">MATERIAL: {{ $detail->material_text }}</p>
                                <div class="btn-wrapper d-flex">
                                    <div class="input-group">
                                        <div class="input-group-prepend align-self-center">
                                            <a class="btn btn-sm" id="minus-btn"><i class="fa fa-minus"></i></a>
                                        </div>
                                        <input type="number" id="qty_input" class="form-control text-right form-control-sm"
                                            value="1" min="1" max="{{ $detail->quantity }}">
                                        <div class="input-group-prepend align-self-center">
                                            <a class="btn btn-sm" id="plus-btn"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                    {{-- <div class="add-to-cart">
                                        <a href="#" target="_blank"><i class="icon-add-to-cat"></i> Whatsapp</a>
                                    </div> --}}
                                </div>
                                <div class="btn-wrapper">
                                    <a href="#" id="btnsend" class="btn btn-buy">Comprar ahora</a>
                                </div>

                                @php($categories_text = '')
                                @foreach ($detail->categories as $item)
                                    @if ($loop->last)
                                        @php($categories_text = $categories_text . $item->name . '.')
                                    @else
                                        @php($categories_text = $categories_text . $item->name . ', ')
                                    @endif
                                @endforeach

                                @php($sectors_text = '')
                                @foreach ($detail->sectors as $item)
                                    @if ($loop->last)
                                        @php($sectors_text = $sectors_text . $item->name . '.')
                                    @else
                                        @php($sectors_text = $sectors_text . $item->name . ', ')
                                    @endif
                                @endforeach

                                <p class="specifications">CATEGORIAS: <b>{{ $categories_text }}</b></p>
                                <p class="specifications">TAG: <b>{{ $sectors_text }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-tab">

                                <ul class="nav nav-pills">
                                    @foreach ($detail->description_items as $item)
                                        <li><a data-toggle="pill" href="#part_{{$loop->index}}"
                                                class="{{ $loop->first ? 'active' : '' }}">{{ $item['title'] }}</a></li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach ($detail->description_items as $item)
                                    <div id="part_{{$loop->index}}" class="tab-pane fade  {{ $loop->first ? 'in show active' : '' }}">
                                        {!! $item['text'] !!}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="widget delivery-widget margin-top-20">
                        @foreach ($info->delivery_items as $item)
                        <div class="single-delivery-item">
                            <div class="d-flex">
                                <i class="{{ $item['icono'] }}"></i>
                                <h4>{{ $item['title'] }}</h4>
                            </div>
                            <span>{{ $item['subtitle'] }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="widget checkout-widget">
                        <h4 class="widget-title">{{ $detail->credit_card_title}}</h4>
                        <ul class="checkout-list">
                            @foreach ($info->credit_card_items as $item)
                            <li><a href="#"><img src="{{ asset('storage/' .$item) }}"
                                alt="Tarjeta bancaria"></a></li>
                            @endforeach
                        </ul>
                    </div>
                    @if ($products_top)
                    <div class="widget seller-widget">
                        <h4 class="widget-title">Productos top</h4>
                        <div class="seller-content">
                            @foreach ($products_top as $item)
                            <div class="single-seller-content d-flex">
                                <div class="thumb">
                                    <img src="{{ asset('storage/'. $item->image) }}" alt="{{ $item->title }}" width="70px" height="83px">
                                </div>
                                <div class="content">
                                    <h6>{{ $item->title }}</h6>
                                    <span>{{ $info->currency }}{{ $item->price}}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- collection area end  -->

    @if ($detail->related_show)
    <!-- related product start  -->
    <div class="related-product-section">
        <div class="container">
            <div class="related-product">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title">
                            <h2>{{ $detail->related_title }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="related-slider">
                            @foreach ($detail->products as $item)
                            <div class="product-style-03 margin-top-30">
                                <div class="thumb text-center">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                </div>
                                <div class="content text-center">
                                    <span class="brand">Marca: {{ $item->brand->name }}</span>
                                    <h6 class="title"><a href="#">{{ $item->title }}</a></h6>
                                    <span class="price">{{ $info->currency }}{{ $item->price}}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- related product end  -->
    @endif
    
@endsection

@section('js')
    <script src="{{ asset('/') }}packages/lightgallery/lightgallery.umd.js"></script>
    <script src="{{ asset('/') }}packages/lightgallery/plugins/video/lg-video.umd.js"></script>
    <script src="{{ asset('/') }}packages/lightgallery/plugins/thumbnail/lg-thumbnail.umd.js"></script>
    <!-- lightgallery plugins -->
    {{-- <script src="{{ asset('/') }}packages/lightgallery.js/dist/js/lg-thumbnail.min.js"></script>
    <script src="{{ asset('/') }}packages/lightgallery.js/dist/js/lg-fullscreen.min.js"></script> --}}
    <script>

        function isMobile() {
                if (sessionStorage.desktop)
                    return false;
                else if (localStorage.mobile)
                    return true;
                var mobile = ['iphone', 'ipad', 'android', 'blackberry', 'nokia', 'opera mini', 'windows mobile', 'windows phone', 'iemobile'];
                for (var i in mobile)
                    if (navigator.userAgent.toLowerCase().indexOf(mobile[i].toLowerCase()) > 0) return true;
                return false;
        }

        const btn = document.querySelector('#btnsend');
        const urlDesktop = 'https://web.whatsapp.com/';
        const urlMobile = 'whatsapp://';
        const telefono = '{{ $info->phone_whatsapp }}';

        btn.addEventListener('click', (event) => {
            event.preventDefault()
            event.target.innerHTML = 'REDIRIGIENDO A WHATSAPP';
            event.target.disabled = true;
            // event.target.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>'
            setTimeout(() => {
                let qty_input = document.querySelector('#qty_input').value
                let mensaje = 
                    'send?phone='+telefono+'&text=*_Formulario de contáctenos_*%0A*¿Hola tiene disponible el siguiente producto?*%0A'+
                    "{{ $detail->title }}" + ' - SKU:' + "{{ $detail->sku }}" +
                    '%0A*¿Qué cantidad desea adquirir?*%0A' +
                    qty_input ;
                if(isMobile()) {
                    window.open(urlMobile + mensaje, '_blank')
                }else{
                    window.open(urlDesktop + mensaje, '_blank')
                }
                // buttonSubmit.innerHTML = '<i class="fab fa-whatsapp"></i> Enviar'
                event.target.disabled= false
                event.target.innerHTML = 'COMPRAR AHORA.';
            }, 3000);
        });

        $(() => {
            let elementGllery = document.querySelectorAll('.gallery_item_images');
                elementGllery.forEach(element => {
                    lightGallery(element, {
                        plugins: [lgVideo, lgThumbnail],
                        // licenseKey: '000-0000-000-0000`'
                    });
                });
                
            let itemSelector = document.querySelectorAll('.gallery_item');
            itemSelector.forEach((item) => {
                item.addEventListener('click', function(e){
                    e.preventDefault();
                    document.querySelector('.gallery_item_images').querySelector('.gallery_item_link').click();
                })
            });
        });
    </script>
@endsection
