@extends('front.template._base')


@section('content')

@if ($home->main_show)
<!-- breadcrumb start  -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-inner d-flex justify-content-between">
                    <h2 class="page-title">{{ $home->main_title }}</h2>
                    <ul class="page-list">
                        <li><a href="{{ route('home') }}">Inicio</a></li>
                        <li><a href="{{ route('contact') }}">Contáctanos</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end  -->
@endif

@if ($home->form_show)
<!-- contact form start  -->
<div class="contact-form text-center padding-top-80 padding-bottom-80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form id="formulario">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="name" placeholder="Name*">
                      </div>
                      <div class="form-group col-md-6">
                        <input type="number" class="form-control" id="celular" placeholder="Phone*">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <input type="email" class="form-control" id="email" placeholder="Email*">
                      </div>
                      <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="consulta" placeholder="Topic">
                      </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                          <textarea name="message" id="message" rows="8" placeholder="Message"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-contact" id="submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- contact form end  -->
@endif

@if ($home->contact_show)
<!-- contact area start  -->
<div class="contact-info margin-top-80">
    <div class="container">
        @if ($home->contact_title)
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3>{{ $home->contact_title }}</h3>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            @foreach ($home->contact_items as $item)
            <div class="col-md-4">
                <div class="single-contact-box">
                    <div class="icon">
                        <i class="{{ $item['icon'] }}"></i>
                    </div>
                    {!! $item['text1'] !!}
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</div>
<!-- contact area end  -->
@endif

@if ($home->map_show)
<div class="mapouter">
    <div class="gmap_canvas" id="gmap_canvas">
        {{-- <iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe> --}}
        {!! $home->map_iframe !!}
    </div>
</div>
@endif

@endsection

@section('js')
    <script>
        $(function(){
            if ($('#gmap_canvas')) {
                $('#gmap_canvas iframe').addClass('gmap_canvas');
                $('#gmap_canvas iframe').css({
                    'width' : '100%',
                    'height' : '100%',
                });
            }

            $('footer').css({
                'margin-top':'0px'
            })
        });

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

    const formulario = document.querySelector('#formulario');
    const buttonSubmit = document.querySelector('#submit');
    const urlDesktop = 'https://web.whatsapp.com/';
    const urlMobile = 'whatsapp://';
    const telefono = '{{ $info->phone_whatsapp }}';

    formulario.addEventListener('submit', (event) => {
        event.preventDefault()
        event.target.innerHTML = 'REDIRIGIENDO A WHATSAPP';
        buttonSubmit.disabled = true
        setTimeout(() => {
            let nombre = document.querySelector('#name').value
            let celular = document.querySelector('#celular').value
            let email = document.querySelector('#email').value
            let consulta = document.querySelector('#consulta').value
            let message = document.querySelector('#message').value
            let mensaje = 
                'send?phone='+telefono+'&text=*_Formulario de contáctenos DARDOS PERÚ_*%0A*¿Cual es tu nombre y tu Apellido?*%0A'+
                nombre +
                '%0A*¿Cual es tu Nª Celular?*%0A'
                celular +
                '%0A*¿Cuál es tu correo electrónico?*%0A'
                email +
                '%0A*¿Cuál es el tema?*%0A'
                consulta +
                '%0A*¿Cuál es tu consulta?*%0A'+
                message;
                console.log(mensaje)
            if(isMobile()) {
                window.open(urlMobile + mensaje, '_blank')
            }else{
                window.open(urlDesktop + mensaje, '_blank')
            }
            // buttonSubmit.innerHTML = '<i class="fab fa-whatsapp"></i> Enviar'
            buttonSubmit.disabled = false
            buttonSubmit.innerHTML = 'ENVIAR DATOS!'
        }, 3000);
    });
    </script>
@endsection
