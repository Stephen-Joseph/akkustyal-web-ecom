{{-- Admin-themed paginator view: $items->links('admin.partials.pagination') --}}
@if ($paginator->hasPages())
  <nav class="pagination-bar" role="navigation" aria-label="Pagination">
    <p class="pagination-summary">
      Showing <strong>{{ $paginator->firstItem() }}</strong>&ndash;<strong>{{ $paginator->lastItem() }}</strong>
      of <strong>{{ $paginator->total() }}</strong>
    </p>

    <ul class="pagination">
      <li>
        @if ($paginator->onFirstPage())
          <span class="page-link is-disabled" aria-disabled="true" aria-label="Previous page">
            @include('admin.partials.icon', ['name' => 'chevron-left'])
          </span>
        @else
          <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page">
            @include('admin.partials.icon', ['name' => 'chevron-left'])
          </a>
        @endif
      </li>

      @foreach ($elements as $element)
        @if (is_string($element))
          <li><span class="page-link is-gap" aria-hidden="true">{{ $element }}</span></li>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            <li>
              @if ($page == $paginator->currentPage())
                <span class="page-link is-active" aria-current="page">{{ $page }}</span>
              @else
                <a class="page-link" href="{{ $url }}" aria-label="Go to page {{ $page }}">{{ $page }}</a>
              @endif
            </li>
          @endforeach
        @endif
      @endforeach

      <li>
        @if ($paginator->hasMorePages())
          <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page">
            @include('admin.partials.icon', ['name' => 'chevron'])
          </a>
        @else
          <span class="page-link is-disabled" aria-disabled="true" aria-label="Next page">
            @include('admin.partials.icon', ['name' => 'chevron'])
          </span>
        @endif
      </li>
    </ul>
  </nav>
@endif
