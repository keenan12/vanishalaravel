@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination" style="margin: 0; gap: 6px; justify-content: center; flex-wrap: wrap;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" style="padding: 6px 10px; font-size: 12px; cursor: not-allowed; opacity: 0.5;">← Prev</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" style="padding: 6px 10px; font-size: 12px; cursor: pointer;">← Prev</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link" style="padding: 6px 10px; font-size: 12px;">...</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link" style="padding: 6px 10px; font-size: 12px; background: #667eea; color: white; border: 1px solid #667eea; border-radius: 4px;">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}" style="padding: 6px 10px; font-size: 12px; border: 1px solid #ddd; border-radius: 4px; cursor: pointer;">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" style="padding: 6px 10px; font-size: 12px; cursor: pointer;">Next →</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" style="padding: 6px 10px; font-size: 12px; cursor: not-allowed; opacity: 0.5;">Next →</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
