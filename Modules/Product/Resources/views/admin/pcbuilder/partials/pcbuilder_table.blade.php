<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-borderless my-orders-table">
                <thead>
                    <tr>
                        <th>{{ trans('Name') }}</th>
                        <th>{{ trans('Email') }}</th>
                        <th>{{ trans('Phone') }}</th>
                        <th>{{ trans('ITEM') }}</th>
                        <th>{{ trans('PRICE') }}</th>
                        <th>{{ trans('DATE') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ $pcbuilder->user->first_name }} {{ $pcbuilder->user->last_name }}
                        </td>
                        <td>
                            {{ $pcbuilder->user->email }}
                        </td>
                        <td>
                            {{$pcbuilder->user->phone }}
                        </td>
                        <td>
                            {{ $pcbuilder->total_item }}
                        </td>
                        <td>
                            {{ $pcbuilder->total_price . ' ৳' }}
                        </td>
                        <td>
                            {{ $pcbuilder->created_at->toFormattedDateString() }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="my-4"></div>
        <div class="table-responsive">
            <table class="table my-pcb-table">
                <thead>
                    <tr>
                        <th>{{ trans('COMPONENT') }}</th>
                        <th>{{ trans('PRODUCT Image') }}</th>
                        <th>{{ trans('PRODUCT NAME') }}</th>
                        <th>{{ trans('PRODUCT PRICE') }}</th>
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
                                    <i class="fa fa-picture-o"></i>
                                @endif
                            </td>
                            <td>
                                {{ $li->product->name??'' }}
                            </td>
                            <td>
                                {{ $li->product->selling_price??'' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> 