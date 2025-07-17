@if ($paginator->hasPages())
    <nav class="pagination-nav">
        <ul class="pagination-list">
            {{-- Lien vers la page précédente --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item disabled">
                    <span class="pagination-link previous">&lsaquo;</span>
                </li>
            @else
                <li class="pagination-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link previous" rel="prev">&lsaquo;</a>
                </li>
            @endif

            {{-- Éléments de pagination --}}
            @foreach ($elements as $element)
                {{-- Séparateur "..." --}}
                @if (is_string($element))
                    <li class="pagination-item disabled">
                        <span class="pagination-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Tableau de liens --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-item active">
                                <span class="pagination-link current">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination-item">
                                <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Lien vers la page suivante --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link next" rel="next">&rsaquo;</a>
                </li>
            @else
                <li class="pagination-item disabled">
                    <span class="pagination-link next">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif