@props(['paginator' => null])
<div class="table-card bg-white">
    <div class="table-responsive">
        {{ $slot }}
    </div>

    @if ($paginator)
        <div class="pagination-footer">
            <div>
                @if ($paginator->total() > 0)
                    {{ __('app.messages.showing_results', ['from' => $paginator->firstItem(), 'to' => $paginator->lastItem(), 'total' => $paginator->total()]) }}
                @else
                    {{ __('app.messages.no_results') }}
                @endif
            </div>
            {{ $paginator->onEachSide(1)->links() }}
        </div>
    @endif
</div>
