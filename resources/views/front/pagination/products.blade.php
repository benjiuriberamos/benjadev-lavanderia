@if ($paginator->hasPages())
    <div class="col-md-12">
        <div class="d-flex justify-content-between pagination">
            <h6>Showing 1 to 12 of 19 products</h6>
            <ul>
                @foreach ($elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active"><a href="#" class="paginator-ajax "
                                        data-page="{{ $page }}">{{ $page }}</a></li>
                            @else
                                <li><a href="#" class="paginator-ajax"
                                        data-page="{{ $page }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

@endif
