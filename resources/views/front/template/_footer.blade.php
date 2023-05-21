<!-- footer area start -->
<footer class="footer-area footer-style-1 padding-top-70 margin-top-70">
    <div class="footer-top padding-bottom-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="widget widget_nav_menu">
                        <h4 class="widget-title">CATEGORIAS</h4>
                        <ul>
                            @foreach ($footer_categories as $item)
                            <li><a href="{{ route('products', ['categories' => $item->slug]) }}">{{ $item->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget widget_nav_menu">
                        <h4 class="widget-title">TAMBIÉN PUEDER VER</h4>
                        <ul>
                            <li><a href="{{ route('products') }}">Productos</a></li>
                            <li><a href="{{ route('products') }}">Marcas</a></li>
                            <li><a href="{{ route('about') }}">Nosotros</a></li>
                            <li><a href="{{ route('contact') }}">Contáctanos</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="widget contact-widget">
                        <h4 class="widget-title">PONTE EN CONTACTO</h4>
                        <ul class="contact_info_list">
                            <li class="single-info-item">
                                <div class="icon">
                                    <i class="icon-home-foother"></i>
                                </div>
                                <div class="details">
                                    <span>{{ $info->address }}</span>
                                    {{-- <span>Davis Patrick<br>P.O. Box 147 2546 Sociosqu Rd. <br>Bethlehem Utah 02913</span> --}}
                                </div>
                            </li>
                            <li class="single-info-item">
                                <div class="icon">
                                    <i class="icon-email-subscribe"></i>
                                </div>
                                <div class="details">
                                    {{ $info->email }}
                                </div>
                            </li>
                            <li class="single-info-item">
                                <div class="icon">
                                    <i class="icon-call-footer"></i>
                                </div>
                                <div class="details">
                                    @foreach ($info->phone_items as $phone)
                                    <a href="tel:+{{$info->onlynumbers($phone) }}">{{ $phone }}</a><br>
                                    @endforeach
                                    {{-- <a href="tel:+496170961709">(939) 353-1107</a>
                                    <a href="tel:+496170961709">(939) 353-1107</a> --}}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="widget widget_nav_menu">
                        <h4 class="widget-title">Siguenos</h4>
                        <ul>
                            @if ( $info->url_facebook)
                            <li><a href="{{ $info->url_facebook}}" target="_blank"><i class="icon-facebook"></i>Facebook</a></li>
                            @endif
                            @if ($info->url_twiter)
                            <li><a href="{{ $info->url_twiter}}" target="_blank"><i class="icon-twitter"></i>Twitter</a></li>
                            @endif
                            @if ($info->url_instagram)
                            <li><a href="{{ $info->url_instagram}}" target="_blank"><i class="icon-instagram">Instagram</i></a></li>
                            @endif
                            @if ($info->url_pinterest)
                            <li><a href="{{ $info->url_pinterest}}" target="_blank"><i class="icon-pinterest"></i>Pinterest</a></li>
                            @endif
                            @if ($info->url_youtube)
                            <li><a href="{{ $info->url_youtube}}" target="_blank"><i class="icon-youtube"></i>Youtube</a></li>
                            @endif
                            @if ($info->url_skype)
                            <li><a href="{{ $info->url_skype}}" target="_blank"><i class="icon-skype"></i>Skype</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p>© Stoon 2020. Powered with <i class="fa fa-heart"></i> by <a href="#">Zwin</a>.</p>
                </div>
                <div class="col-md-6">
                    <ul>
                        @foreach ($info->credit_card_items as $item)
                        <li><a href="#"><img src="{{ asset('storage/'. $item) }}" width="35px" alt="Tarjeta de crédito"></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->

<!-- back to top area start -->
<div class="back-to-top">
    <span class="back-top"><i class="fa fa-angle-up"></i></span>
</div>
<!-- back to top area end -->