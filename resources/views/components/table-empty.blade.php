@props(['colspan' => 1])
<tr>
    <td colspan="{{ $colspan }}" class="p-0">
        <div class="table-empty-state">
            <i class="bi bi-inbox"></i>
            {{ __('app.messages.no_results') }}
        </div>
    </td>
</tr>
