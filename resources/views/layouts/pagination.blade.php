@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class=" w-full md:w-3/4 md:float-right">
    <ul class="flex justify-center text-sm">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li aria-label="@lang('pagination.previous')">
            <span class="px-2 py-1 text-gray-500 block rounded-l" aria-hidden="true">пред</span>
        </li>
        @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}"
               rel="prev"
               class="px-2 py-1 block text-blue-900 rounded-l hover:font-bold focus:outline-none"
               aria-label="@lang('pagination.previous')"
            >
                пред
                </a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li aria-disabled="true">
            <span class="px-2 py-1 block text-gray-500">{{ $element }}</span>
        </li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li aria-current="page">
            <span class="px-2 py-1 block font-bold">{{ $page }}</span>
        </li>
        @else
        <li>
            <a href="{{ $url }}"
               class="px-2 py-1 block text-blue-900 hover:font-bold focus:outline-none"
               aria-label="@lang('pagination.goto_page', ['page' => $page])"
            >
                {{ $page }}
            </a>
        </li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}"
               rel="next"
               class="px-2 py-1 block text-blue-900 rounded-r hover:font-bold focus:outline-none"
               aria-label="@lang('pagination.next')"
            >
                след
            </a>
        </li>
        @else
        <li aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="px-2 py-1 block text-gray-500 rounded-r" aria-hidden="true">пред</span>
        </li>
        @endif
    </ul>
</nav>
@endif

