@if ($paginator->hasPages())
    <nav>
        <ul class="simple-pagination">
            {{-- Previous Page Link --}}
            <li>
                @if ($paginator->onFirstPage())
                    <span class="page-btn disabled">&laquo;</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-btn">&laquo;</a>
                @endif
            </li>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span class="page-btn disabled">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><span class="page-btn active">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="page-btn">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <li>
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-btn">&raquo;</a>
                @else
                    <span class="page-btn disabled">&raquo;</span>
                @endif
            </li>
        </ul>
    </nav>
@endif 