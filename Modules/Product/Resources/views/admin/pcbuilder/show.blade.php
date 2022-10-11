@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('PC Builder'))

    <li><a href="{{ route('admin.pcbuilder.index') }}">{{ trans('PC Builders') }}</a></li>
    <li class="active">{{ trans('PC Builder', ['resource' => trans('PC Builder')]) }}</li>
@endcomponent

@section('content')
<div style="text-align: end; margin: 10px 0;">
    <a href="{{ route('admin.pcbuilder.print', ['id' => $pcbuilder->id]) }}"
        class="btn btn-primary">
        <i class="fa fa-print"></i> Print
    </a>
</div>
@include('product::admin.pcbuilder.partials.pcbuilder_table')

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
@endsection