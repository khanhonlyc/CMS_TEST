@if ($paginator->hasPages())
<ul class="pagination d-flex justify-content-center">
  {{-- Previous Page Link --}}
  @if ($paginator->onFirstPage())
  <li class="page-item disabled"><span class="page-link text-dark">Previous</span></li>
  @else
  <li><a class="page-link text-dark" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a></li>
  @endif
  {{-- Pagination Elements --}}
  @foreach ($elements as $element)
  {{-- "Three Dots" Separator --}}
  @if (is_string($element))
  <li class="page-item disabled"><span class="page-link text-dark">{{ $element }}</span></li>
  @endif
  {{-- Array Of Links --}}
  @if (is_array($element))
  @foreach ($element as $page => $url)
  @if ($page == $paginator->currentPage())
  <li class="page-item active my-active"><a class="page-link text-dark" href="{{ $url }}">{{ $page }}</a></span></li>
  @else
  <li class="page-item"><a class="page-link text-dark" href="{{ $url }}">{{ $page }}</a></li>
  @endif
  @endforeach
  @endif
  @endforeach
  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
  <li class="page-item"><a class="page-link text-dark" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
  @else
  <li class="page-item disabled"><span class="page-link text-dark">Next</span></li>
  @endif
</ul>
@endif
