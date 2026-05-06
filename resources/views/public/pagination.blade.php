@if ($paginator->hasPages())
<style>
.pag { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; justify-content: center; }
.pag a, .pag span {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 36px; height: 36px; padding: 0 10px;
    border-radius: 8px; font-size: .825rem; font-weight: 500;
    text-decoration: none; border: 1.5px solid var(--border);
    color: var(--ink-soft); transition: all .15s;
}
.pag a:hover { background: var(--surface-3); color: var(--ink); border-color: var(--ink-soft); }
.pag span[aria-current="page"] { background: var(--accent); color: #fff; border-color: var(--accent); font-weight: 700; }
.pag span.disabled { color: var(--ink-muted); cursor: not-allowed; background: var(--surface-2); }
</style>
<div class="pag">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span class="disabled">←</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}">←</a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="disabled">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span aria-current="page">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}">→</a>
    @else
        <span class="disabled">→</span>
    @endif
</div>
@endif