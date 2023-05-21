<!-- preloader area start -->
<div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>
<!-- preloader area end -->

<!-- search Popup -->
<div class="body-overlay" id="body-overlay"></div>
<div class="search-popup" id="search-popup">
    <form action="index.html" class="search-form">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search.....">
        </div>
        <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
    </form>
</div>
<!-- search Popup end -->

<!--sidebar menu start-->
<div class="sidebar-menu" id="sidebar-menu">
    <button class="sidebar-menu-close">X</button>
    <div class="sidebar-inner">
        @if ($info->logo)
        <div class="sidebar-logo">
            <img src="{{ asset('storage/' . $info->logo) }}" alt="Logo">
        </div>
        @endif
        <div class="sidemenu-text">
            {!! $info->descriplogo !!}
        </div>
        <div class="sidebar-contact">
            <h4>Contáctanos</h4>
            <ul>
                @if ($info->address )
                <li><i class="fa fa-map-marker"></i>{{ $info->address }}</li>
                @endif
                @if ($info->email )
                <li><i class="fa fa-envelope"></i>{{ $info->email }}</li>
                @endif
                @if ($info->phone_items[0] )
                <li><i class="fa fa-phone"></i>{{ $info->phone_items[0] }}</li>
                @endif
            </ul>
        </div>
        <div class="social-link">
            <ul>
                @if ( $info->url_facebook)
                <li><a href="{{ $info->url_facebook}}" target="_blank"><i class="fa fa-facebook-f"></i></a></li>
                @endif
                @if ($info->url_twiter)
                <li><a href="{{ $info->url_twiter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                @endif
                @if ($info->url_instagram)
                <li><a href="{{ $info->url_instagram}}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                @endif
                @if ($info->url_pinterest)
                <li><a href="{{ $info->url_pinterest}}" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                @endif
                @if ($info->url_youtube)
                <li><a href="{{ $info->url_youtube}}" target="_blank"><i class="fa fa-youtube"></i></a></li>
                @endif
                @if ($info->url_skype)
                <li><a href="{{ $info->url_skype}}" target="_blank"><i class="fa fa-skype"></i></a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!--sidebar menu end-->

<!-- navbar start -->
<div class="stoon-navbar">
    <div class="header-top d-none d-sm-block">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-4 col-8">
                    <div class="contact">
                        @if ($info->phone_items)
                        <a href="tel:+{{ $info->onlynumbers($info->phone_items[0]) }}"><i class="icon-call-header"></i> {{ $info->phone_items[0] }}</a>
                        @endif
                        @if ($info->email)
                        <a href="mailto:{{ $info->trim($info->email) }}"><i class="icon-email-subscribe"></i> {{ $info->email }}</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="shipping text-center">
                        {{-- <p>FREE SHIPPING - <span>on all orders over $35*</span></p> --}}
                    </div>
                </div>
                <div class="col-lg-4 col-4">
                    <div class="social">
                        <ul class="nav-social justify-content-end">
                            @if ( $info->url_facebook)
                            <li><a href="{{ $info->url_facebook}}" target="_blank"><i class="icon-facebook"></i></a></li>
                            @endif
                            @if ($info->url_twiter)
                            <li><a href="{{ $info->url_twiter}}" target="_blank"><i class="icon-twitter"></i></a></li>
                            @endif
                            @if ($info->url_instagram)
                            <li><a href="{{ $info->url_instagram}}" target="_blank"><i class="icon-instagram"></i></a></li>
                            @endif
                            @if ($info->url_pinterest)
                            <li><a href="{{ $info->url_pinterest}}" target="_blank"><i class="icon-pinterest"></i></a></li>
                            @endif
                            @if ($info->url_youtube)
                            <li><a href="{{ $info->url_youtube}}" target="_blank"><i class="icon-youtube"></i></a></li>
                            @endif
                            @if ($info->url_skype)
                            <li><a href="{{ $info->url_skype}}" target="_blank"><i class="icon-skype"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-area navbar-expand-lg nav-style-01">
        <div class="container-fluid nav-container">
            <div class="row">
                <div class="col-lg-3 col-4 order-1 align-self-center">
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('storage/' . $info->logo) }}" alt="Logo" width="110"></a>
                    </div>
                </div>
                <div class="col-lg-6 order-3 order-lg-2">
                    <div class="collapse navbar-collapse" id="shop-menu">
                        <ul class="navbar-nav menu-open">
                            <li><a href="{{ route('home') }}">Inicio</a></li>
                            <li><a href="{{ route('about') }}">Nosotros</a></li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('products') }}">Productos <i class="fa fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    @foreach ($header_categories as $item)
                                    <li><a href="{{ route('products', ['category' => [$item->slug]]) }}">{{ $item->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{ route('contact') }}">CONTÁCTANOS</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-8 justify-content-end d-flex order-2 order-lg-3">
                    <div class="nav-right-part">
                        <ul>
                            <li class="d-none d-lg-block">
                                <a href="#" id="navigation-button"><i class="icon-bar-icon"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="responsive-mobile-menu">
                        <div class="menu toggle-btn d-block d-lg-none" data-toggle="collapse" data-target="#shop-menu" aria-expanded="false" role="button">
                            <div class="icon-left"></div>
                            <div class="icon-right"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- navbar end -->