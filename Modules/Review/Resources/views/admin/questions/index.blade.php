@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('Questions'))

    <li class="active">{{ trans('Questions') }}</li>
@endcomponent

@component('admin::components.page.index_table')
    @slot('resource', 'questions')
    @slot('name', trans('Questions'))

    @slot('thead')
        <tr>
            @include('admin::partials.table.select_all')

            <th>{{ trans('admin::admin.table.id') }}</th>
            <th>{{ trans('Product') }}</th>
            <th>{{ trans('User Name') }}</th>
            <th>{{ trans('User Email') }}</th>
            <th>{{ trans('Question') }}</th>
            <th data-sort>{{ trans('admin::admin.table.date') }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
        new DataTable('#questions-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'id', width: '5%' },
                { data: 'product_name' },
                { data: 'user_name' },
                { data: 'user_email' },
                { data: 'question' },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush

