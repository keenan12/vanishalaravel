@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0;">
        <div style="flex: 1;">
            @if ($paginator->onFirstPage())
                <span style="display: inline-block; padding: 8px 16px; color: #ccc; border: 1px solid #dee2e6; border-radius: 5px; font-size: 14px;">
                    ← Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" style="display: inline-block; padding: 8px 16px; color: #667eea; border: 1px solid #667eea; border-radius: 5px; text-decoration: none; font-size: 14px; transition: all 0.3s;" onmouseover="this.style.background='#667eea'; this.style.color='white';" onmouseout="this.style.background='transparent'; this.style.color='#667eea';">
                    ← Previous
                </a>
            @endif
        </div>

        <div style="flex: 2; text-align: center;">
            <span style="color: #666; font-size: 14px;">
                Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
            </span>
        </div>

        <div style="flex: 1; text-align: right; display: flex; gap: 5px; justify-content: flex-end; align-items: center;">
            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span style="padding: 8px 12px; color: #666;">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span style="display: inline-block; padding: 8px 12px; background: #667eea; color: white; border: 1px solid #667eea; border-radius: 5px; font-weight: bold; font-size: 14px;">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" style="display: inline-block; padding: 8px 12px; color: #667eea; border: 1px solid #dee2e6; border-radius: 5px; text-decoration: none; font-size: 14px; transition: all 0.3s;" onmouseover="this.style.background='#667eea'; this.style.color='white'; this.style.borderColor='#667eea';" onmouseout="this.style.background='transparent'; this.style.color='#667eea'; this.style.borderColor='#dee2e6';">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" style="display: inline-block; padding: 8px 16px; color: #667eea; border: 1px solid #667eea; border-radius: 5px; text-decoration: none; font-size: 14px; margin-left: 5px; transition: all 0.3s;" onmouseover="this.style.background='#667eea'; this.style.color='white';" onmouseout="this.style.background='transparent'; this.style.color='#667eea';">
                    Next →
                </a>
            @else
                <span style="display: inline-block; padding: 8px 16px; color: #ccc; border: 1px solid #dee2e6; border-radius: 5px; font-size: 14px; margin-left: 5px;">
                    Next →
                </span>
            @endif
        </div>
    </nav>
@endif
