@extends('front.template._base')

@section('css')
    <style>
        .container {
            padding-top: 50px;
        }
    </style>
@endsection

@section('content')

@if ($home->main_show)
 <!-- breadcrumb start  -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-inner d-flex justify-content-between">
                    <h2 class="page-title">{{ $home->main_title}}</h2>
                    <ul class="page-list">
                        <li><a href="{{ route('home') }}">Inicio</a></li>
                        <li><a href="{{ route('about') }}">Nosotros</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end  -->   
@endif

@if ($home->history_show)
<!-- about content start  -->
<div class="about-content margin-top-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="content-left">
                    <h3>{{ $home->history_title }}</h3>
                    {!! $home->history_description !!}
                    <span>{{ $home->history_mark}}</span>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="thumb">
                    <img src="{{ asset('storage/' . $home->history_image) }}" alt="{{ $home->history_title}}">
                    @if ($home->history_video_show && $home->history_video_url)
                    <div class="video-btn-style-01">
                        <a href="{{ $home->history_video_url }}"><i class="fa fa-play"></i></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about content end  --> 
@endif
{{-- 
@if ($home->about_show)
<!-- about start  -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="accordion-area">
                <h3 class="text-center">{{ $home->about_title }}</h3>
                <div class="accordion-style" id="accordionExample1">

                    @foreach ($home->about_items as $item)
                    <div class="card">
                        <div class="card-header" id="heading{{ $loop->index }}">
                            <p class="mb-0">
                                <a href="#" role="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="false" aria-controls="collapse{{ $loop->index }}" class="{{ $loop->first ? 'collapsed' : ''}}">{{ $item['title'] }}</a>
                            </p>
                        </div>
                        <div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordionExample1" style="">
                            <div class="card-body">
                                {!! $item['text'] !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about start  -->  
@endif --}}

@if ($home->about_show)
<!-- collection area start  -->
<div class="collection-area margin-top-10">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="text-center">{{ $home->about_title }}</h3>
                        <div class="product-tab">
                            <ul class="nav nav-pills">
                                @foreach ($home->about_items as $item)
                                    <li><a data-toggle="pill" href="#part_{{$loop->index}}"
                                            class="{{ $loop->first ? 'active' : '' }}">{{ $item['title'] }}</a></li>
                                @endforeach
                            </ul>

                            <div class="tab-content">
                                @foreach ($home->about_items as $item)
                                <div id="part_{{$loop->index}}" class="tab-pane fade  {{ $loop->first ? 'in show active' : '' }}">
                                    {!! $item['text'] !!}
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- collection area end  -->
@endif

@if ($home->team_show)
<!-- team start  -->
<div class="team-area margin-top-80">
    <div class="container">
        @if ($home->team_title)
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3>{{ $home->team_title }}</h3>
                </div>
            </div>
        </div>
        @endif
        
        <div class="row">
            <div class="col-md-12">
                <div class="team-slider">
                    @foreach ($home->members as $item)7
                        @if ($item->active)
                        <div class="single-team-item">
                            <div class="thumb">
                                <img class="rounded-circle" src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}">
                            </div>
                            <div class="content">
                                <h4 class="title">{{ $item->name }}</h4>
                                <span class="designation">{{ $item->charge }}</span>
                                <ul class="team-social">
                                    @if ($item->facebook)
                                    <li><a href="{{ $item->facebook }}" target="_blank"><i class="icon-facebook"></i></a></li>
                                    @endif
                                    @if ($item->instagram)
                                    <li><a href="{{ $item->instagram }}" target="_blank"><i class="icon-instagram"></i></a></li>
                                    @endif
                                    @if ($item->twitter)
                                    <li><a href="{{ $item->twiter }}" target="_blank"><i class="icon-twitter"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- team end  -->
@endif


@endsection

@section('js')
    <script>

    </script>
@endsection