@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="Navigasi halaman">
        @if ($paginator->onFirstPage())
            <span class="page-disabled"><span><x-icon name="chevron-left" class="w-4 h-4" /></span></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Halaman sebelumnya">
                <x-icon name="chevron-left" class="w-4 h-4" />
            </a>
        @endif

        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
            $pages = collect(range(1, $last))->filter(fn ($p) => $p === 1 || $p === $last || ($p >= $current - 1 && $p <= $current + 1))->values();
            $prevPage = null;
        @endphp

        @foreach ($pages as $p)
            @if ($prevPage !== null && $p - $prevPage > 1)
                <span>&hellip;</span>
            @endif

            @if ($p == $current)
                <span class="page-active"><span>{{ $p }}</span></span>
            @else
                <a href="{{ $paginator->url($p) }}">{{ $p }}</a>
            @endif

            @php $prevPage = $p; @endphp
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Halaman berikutnya">
                <x-icon name="chevron-left" class="w-4 h-4" style="transform:rotate(180deg)" />
            </a>
        @else
            <span class="page-disabled"><span><x-icon name="chevron-left" class="w-4 h-4" style="transform:rotate(180deg)" /></span></span>
        @endif
    </nav>
@endif
