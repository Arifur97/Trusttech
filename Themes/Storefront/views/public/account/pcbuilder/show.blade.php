@extends('public.layout')

@section('title', trans('Pc Builder'))

@section('breadcrumb')
    <li><a href="{{ route('account.dashboard.index') }}">{{ trans('storefront::account.pages.my_account') }}</a></li>
    <li><a href="{{ route('account.pcbuilder.index') }}">{{ trans('My Pc Builder') }}</a></li>
    <li class="active">{{ trans('View Pc Builder') }}</li>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/pcbuilder.css') }}">
@endpush

@section('content')
    <section class="order-details-wrap">
        <div class="container pcb-panel">
            <div class="order-details-top">
                <h3 class="section-title">{{ trans('View Pc Builder') }}</h3>
            </div>
            
            @include('public.account.pcbuilder.partials.pcbuilder_component_table')
        </div>
    </section>
@endsection
