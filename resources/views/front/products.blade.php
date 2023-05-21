@extends('front.template._base')

@section('css')
    <style>
        .size-click {
            background-color: #000000;
            color: #fff;
        }
        .color-click {
            width: 28px !important;
            height: 28px !important;
        }
        .pagination li.active {
            background-color: #000;
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <!-- breadcrumb start  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-inner d-flex justify-content-between">
                        <h2 class="page-title">Shop</h2>
                        <ul class="page-list">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('products') }}">Ropa</a></li>
                            {{-- <li><a href="{{ route('products') }}">Benjamin</a></li> --}}
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
            <div class="row flex-row-reverse">
                <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12 pb-5">
                    <div class="row">
                        <div class="col-lg-8 col-5">
                            <ul class="nav nav-pills shop-tab">
                                <li><a data-toggle="pill" href="#one" class="active"><i class="fa fa-th-large"></i></a>
                                </li>
                                <li><a data-toggle="pill" href="#two"><i class="fa fa-bars"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-7">
                            <form action="#">
                                <select class="form-control sort-select" id="order-products">
                                    <option value="">Orden por defecto</option>
                                    <option value="AZ">Orden por alfabeto: A - Z</option>
                                    <option value="ZA">Orden por alfabeto: Z - A</option>
                                    <option value="09">Orden por precio: menor a mayor</option>
                                    <option value="90">Orden por precio: mayor a menos</option>
                                </select>
                                <i class="fa fa-chevron-down"></i>
                            </form>
                        </div>
                    </div>
                    <div id="contenedor-productos">
                        
                        @include('front.ajax.products')
                        
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 margin-top-20">
                    <div class="widget search-widget">
                        <form action="#">
                            <button type="submit"><i class="icon-search"></i></button>
                            <input type="text" id="search-product" placeholder="Buscar producto" name="search">
                        </form>
                    </div>
                    <div class="widget categories-widget">
                        <div class="accordion-style-2" id="accordionExample1">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <p class="mb-0">
                                        <a href="#" role="button" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">Categorias</a>
                                    </p>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample1">
                                    <div class="card-body">
                                        <form action="#">
                                            @foreach ($categories as $category)
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" class="custom-control-input category-check" value="{{ $category->slug }}"
                                                        id="{{ 'cat_' . $category->slug }}">
                                                    <label class="custom-control-label"
                                                        for="{{ 'cat_' . $category->slug }}">{{ $category->name }}
                                                        <!--[124]-->
                                                    </label>
                                                </div>
                                            @endforeach
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget brand-widget">
                        <div class="accordion-style-2" id="accordionExample2">
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <p class="mb-0">
                                        <a href="#" role="button" data-toggle="collapse" data-target="#collapseTwo"
                                            aria-expanded="true" aria-controls="collapseTwo">Marca de ropa</a>
                                    </p>
                                </div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample2">
                                    <div class="card-body">
                                        <form action="#">
                                            @foreach ($brands as $brand)
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" class="custom-control-input brand-check" id="brand_{{ $brand->slug}}" value="{{ $brand->slug }}">
                                                    <label class="custom-control-label" for="brand_{{ $brand->slug}}">{{ $brand->name }}
                                                        <!--[124]--></label>
                                                </div>
                                            @endforeach
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget ptype-widget">
                        <div class="accordion-style-2" id="accordionExample3">
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <p class="mb-0">
                                        <a href="#" role="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="true"
                                            aria-controls="collapseThree">Sectores</a>
                                    </p>
                                </div>
                                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree"
                                    data-parent="#accordionExample3">
                                    <div class="card-body">
                                        <form action="#">
                                            @foreach ($sectors as $sector)
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input sector-check" id="sector_{{ $sector->slug }}" value="{{ $sector->slug }}">
                                                <label class="custom-control-label" for="sector_{{ $sector->slug }}">{{ $sector->name }} <!--[203]--></label>
                                            </div>
                                            @endforeach
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget price-widget">
                        <div class="accordion-style-2" id="accordionExample4">
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <p class="mb-0">
                                        <a href="#" role="button" data-toggle="collapse"
                                            data-target="#collapseFour" aria-expanded="true"
                                            aria-controls="collapseFour">Filtrar por precio</a>
                                    </p>
                                </div>
                                <div id="collapseFour" class="collapse show" aria-labelledby="headingFour"
                                    data-parent="#accordionExample4">
                                    <div class="price_filter">
                                        <div class="price_slider_amount">
                                            <input type="submit" value="Price:" id="price-min-product"/>
                                            <input type="text" id="amount" name="price" id="price-max-product" />
                                        </div>
                                        <div id="slider-range"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget color-widget">
                        <div class="accordion-style-2" id="accordionExample5">
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                    <p class="mb-0">
                                        <a href="#" role="button" data-toggle="collapse"
                                            data-target="#collapseFive" aria-expanded="true"
                                            aria-controls="collapseFive">Color</a>
                                    </p>
                                </div>
                                <div id="collapseFive" class="collapse show" aria-labelledby="headingFive"
                                    data-parent="#accordionExample5">
                                    <ul class="color-list">
                                        @foreach ($colors as $color)
                                            <li title="{{ $color->name }}"  data-input="{{ $color->slug }}" style="background-color:{{$color->code}};">
                                                <a class="color-ajax"  href="#"></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget size-widget">
                        <div class="accordion-style-2" id="accordionExample6">
                            <div class="card">
                                <div class="card-header" id="headingSix">
                                    <p class="mb-0">
                                        <a href="#" role="button" data-toggle="collapse"
                                            data-target="#collapseSix" aria-expanded="true"
                                            aria-controls="collapseSix">Size</a>
                                    </p>
                                </div>
                                <div id="collapseSix" class="collapse show" aria-labelledby="headingSix"
                                    data-parent="#accordionExample6">
                                    <div class="card-body">
                                        <ul class="size-list">
                                            @foreach ($sizes as $size)
                                                <li title="Talla {{ $size->name }}" data-input="{{ $size->slug }}">
                                                    <a href="#">{{ $size->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- collection area end  -->
@endsection

@section('js')
    <script>
        Array.prototype.remove = function remove(item) {
            var index = this.indexOf(item);
            if (this !== -1){
                this.splice(index, 1);
            }
            return this;
        };

        const CURRENCY  = "{{ $info->currency }}";
        const PRICEMIN = parseInt({{ $precio_minimo }});
        const PRICEMAX = parseInt({{ $precio_maximo}});
        const PARAMS = { 
            categories: [],
            colors: [],
            brands: [],
            sectors: [],
            sizes: [],
            order: '',
            search: '',
            page: 1,
            price_min: PRICEMIN,
            price_max: PRICEMAX,
        };

        $(() => {

            //START
            $('input.category-check').change((e) => {
                e.preventDefault()
                e.target.checked ?
                    PARAMS.categories.push(e.target.value) :
                    PARAMS.categories.remove(e.target.value);
                getPaginator();
            })

            $('input.brand-check').change((e) => {
                e.preventDefault()
                e.target.checked ?
                    PARAMS.brands.push(e.target.value) :
                    PARAMS.brands.remove(e.target.value);
                getPaginator();
            })

            $('input.sector-check').change((e) => {
                e.preventDefault()
                e.target.checked ?
                    PARAMS.sectors.push(e.target.value) :
                    PARAMS.sectors.remove(e.target.value);
                getPaginator();
            })

            $('.color-list li').click(function(e) {
                e.preventDefault()
                if ($(this).hasClass('color-click')) {
                    $(this).removeClass('color-click');
                    PARAMS.colors.remove(e.target.dataset.input);
                } else {
                    $(this).addClass('color-click');
                    PARAMS.colors.push(e.target.dataset.input);
                }
                    console.log(PARAMS.colors)
                getPaginator();
            })

            $('.size-list li').click(function(e) {
                e.preventDefault()
                if ($(this).hasClass('size-click')) {
                    $(this).removeClass('size-click');
                    PARAMS.sizes.remove(e.target.parentElement.dataset.input);
                } else {
                    $(this).addClass('size-click');
                    PARAMS.sizes.push(e.target.parentElement.dataset.input);
                }
                getPaginator();
            })

            $('select#order-products').change((e) => {
                e.preventDefault()
                PARAMS.order = e.target.value;
                getPaginator();
            })

            $('#contenedor-productos').on('click', '.paginator-ajax', function(e) {
                e.preventDefault();
                $('.paginator-ajax').parent().removeClass('active')
                $(this).parent().addClass('active')
                PARAMS.page = e.target.dataset.page;
                getPaginator();
            })

            $('#search-product').on( "keyup", function(e) {
                PARAMS.search = e.target.value;
                getPaginator();
            } );

            const getPaginator = () => {
                let page = document.querySelector('a.paginator-ajax.active');
                page = page ? page.dataset.value : 1;
                $.ajax({
                    type: "GET",
                    url: '{{ route('ajax.products') }}',
                    data: PARAMS,
                    dataType: "json",
                    success: function (response) {
                        PARAMS.page =  1;
                        if(response.success == true) {
                            $('#contenedor-productos').html(response.html);
                        }
                    }
                });
            }

            $( "#slider-range" ).slider({
                range: true,
                min: PARAMS.price_min ,
                max: PARAMS.price_max ,
                values: [ PARAMS.price_min, PARAMS.price_max ],
                slide: function( event, ui ) {
                    $( "#amount" ).val( CURRENCY + ui.values[ 0 ] + " - " + CURRENCY + ui.values[ 1 ] );
                    PARAMS.price_max = ui.values[ 1];
                    PARAMS.price_min = ui.values[ 0 ];
                },
                change: (event, ui) => {
                    getPaginator();
                },
            });

            //
            $("[type=checkbox]").attr("autocomplete", "off");
            $( '#amount' ).val( CURRENCY  + PARAMS.price_min + ' - ' + CURRENCY +  PARAMS.price_max); 
            document.querySelectorAll('input[type=checkbox]').forEach((i,e) => e.checked = false);
        });

    </script>
@endsection
