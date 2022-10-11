@extends('public.account.layout')

@section('title', trans('PC Builder'))

@section('account_breadcrumb')
    <li class="active">{{ trans('PC Builder') }}</li>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/pcbuilder.css') }}">
@endpush

@section('panel')
    <div class="panel pcb-panel">
        <div class="panel-header">
            <h4 class="pcb-h4">{{ trans('PC Builder') }}</h4>
        </div>

        <div class="panel-body">
            @if ($pcbuilder->isEmpty())
                <div class="empty-message">
                    <h3>{{ trans('You haven\'t saved any pc-build yet.') }}</h3>
                </div>
            @else
                @include('public.account.pcbuilder.partials.pcbuilder_table')
            @endif
        </div>

        <div class="panel-footer">
            {!! $pcbuilder->links() !!}
        </div>
    </div>
@endsection
