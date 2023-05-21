@if ($products->count())
    <div class="tab-content" id="div-products">
        <div class="tab-pane fade in show active" id="one">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="product-style-03 margin-top-40">
                            <div class="thumb">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}">
                            </div>
                            <div class="content text-center">
                                <span class="brand">Marca: {{ $product->brand->name }}</span>
                                <h6 class="title"><a href="{{ route('product', ['slug' => $product->slug]) }}">{{ $product->title }}</a></h6>
                                <div class="content-price d-flex align-self-center justify-content-center">
                                    <span class="new-price">{{ $info->currency }} {{ $product->price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade list-item" id="two">
            @foreach ($products as $product)
                <div class="row product-style-03 margin-top-40">
                    <div class="col-md-4 col-sm-12 col-12">
                        <div class="thumb">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}">
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 col-12">
                        <div class="content">
                            <h6 class="title"><a href="{{ route('product', ['slug' => $product->slug]) }}">{{ $product->title }}</a></h6>
                            <div class="content-price d-flex align-self-center">
                                <span class="new-price">{{ $info->currency }} {{ $product->price }}</span>
                            </div>
                            <p>{{ $product->description }}</p>
                            <div class="btn-wrapper margin-top-20">
                                <div class="add-to-cart">
                                    <a href="{{ route('product', ['slug' => $product->slug] ) }}"><i class="icon-left-arrow-slider"></i> VER MÁS</a>
                                </div>
                                {{-- <div class="add-to-wishlist">
                                    <a href="#"><i class="icon-heart"></i> Add to Wishlist</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row" id="div-paginator">
        {{ $products->links('front.pagination.products') }}
    </div>
@else
    <div class="col-md-12">
        <div class="d-flex justify-content-between pagination">
            <h3>No se obtuvo resultados</h6>
        </div>
    </div>
@endif
