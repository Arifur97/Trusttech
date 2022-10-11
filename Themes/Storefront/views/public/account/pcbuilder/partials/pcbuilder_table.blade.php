<div class="table-responsive">
    <table class="table table-borderless my-pcb-table">
        <thead>
            <tr>
                <th>{{ trans('#') }}</th>
                <th>{{ trans('Total Item') }}</th>
                <th>{{ trans('Total Price') }}</th>
                <th>{{ trans('Status') }}</th>
                <th>{{ trans('Date') }}</th>
                <th>{{ trans('Action') }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pcbuilder as $li)
                <tr>
                    <td>
                        {{ $li->id }}
                    </td>
                    <td>
                        {{ $li->total_item }}
                    </td>
                    <td>
                        {{ $li->total_price . ' ৳' }}
                    </td>
                    <td>
                        <span class="badge badge-info">
                            @if ($li->flag == 'save')
                                Saved
                            @elseif ($li->flag == 'quotation')
                                Quotation Sent
                            @endif
                        </span>
                    </td>
                    <td>
                        {{ $li->created_at->toFormattedDateString() }}
                    </td>
                    <td>
                        <a href="{{ route('account.pcbuilder.show', ['id' => $li->id]) }}" class="btn btn-view">
                            <i class="las la-eye"></i>
                            {{ trans('View') }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
