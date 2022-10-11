<div class="table-responsive">
    <table class="table table-borderless my-pcb-table">
        <thead>
            <tr>
                <th>{{ trans('Total Item') }}</th>
                <th>{{ trans('Total Price') }}</th>
                <th>{{ trans('Status') }}</th>
                <th>{{ trans('Date') }}</th>
                @if ($pcbuilder->flag != 'quotation')
                    <th>{{ trans('Action') }}</th>
                @endif
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    {{ $pcbuilder->total_item }}
                </td>
                <td>
                    {{ $pcbuilder->total_price . ' ৳' }}
                </td>
                <td>
                    <span class="badge badge-info">
                        @if ($pcbuilder->flag == 'save')
                            Saved
                        @elseif ($pcbuilder->flag == 'quotation')
                            Quotation Sent
                        @endif
                    </span>
                </td>
                <td>
                    {{ $pcbuilder->created_at->toFormattedDateString() }}
                </td>
                @if ($pcbuilder->flag != 'quotation')
                    <td>
                        <a href="{{ route('account.pcbuilder.flag.change', ['id' => $pcbuilder->id]) }}" class="btn btn-primary">
                            <i class="las la-scroll"></i>
                            {{ trans('Get a Quote') }}
                        </a>
                    </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
<div class="my-4"></div>
<div class="table-responsive">
    <table class="table table-borderless my-pcb-table">
        <thead>
            <tr>
                <th>{{ trans('Component') }}</th>
                <th>{{ trans('Product Image') }}</th>
                <th>{{ trans('Product Name') }}</th>
                <th>{{ trans('Product Price') }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pcbuilder->component as $li)
                <tr>
                    <td>
                        {{ $li->category->name??'' }}
                    </td>
                    <td>
                        @if ($li->product->base_image->exists)
                            <img src="{{ $li->product->base_image->path }}" alt="thumbnail" class="img-placeholder">
                        @else
                            <i class="lar la-image"></i>
                        @endif
                    </td>
                    <td>
                        {{ $li->product->name??'' }}
                    </td>
                    <td>
                        {{ (int)$li->product->selling_price->__toString()??'' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('styles')
<style>
    .img-placeholder {
        width: 70px;
        height: 70px;
        background-size: cover;
    }
    .my-pcb-table td {
        vertical-align: middle !important;
    }
</style>
@endpush
