@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('PC Builders'))

    <li class="active">{{ trans('PC Builder') }}</li>
@endcomponent

@component('admin::components.page.index_table')
    @slot('resource', 'pcbuilder')
    @slot('name', trans('PC Builder'))

    @slot('thead')
        <tr>
            @include('admin::partials.table.select_all')

            <th>{{ trans('ID') }}</th>
            <th>{{ trans('User Name') }}</th>
            <th>{{ trans('User Email') }}</th>
            <th>{{ trans('User Phone') }}</th>
            <th>{{ trans('Total Item') }}</th>
            <th>{{ trans('Total Price') }}</th>
            <th>{{ trans('Status') }}</th>
            <th data-sort>{{ trans('admin::admin.table.date') }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
        new DataTable('#pcbuilder-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'id', width: '5%' },
                { data: 'user.first_name'},
                { data: 'user.email' },
                { data: 'user.phone' },
                { data: 'total_item' },
                { data: 'total_price' },
                { data: 'status' },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush