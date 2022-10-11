@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('PC Builder'))

    <li><a href="{{ route('admin.pcbuilder.index') }}">{{ trans('PC Builders') }}</a></li>
    <li class="active">{{ trans('PC Builder', ['resource' => trans('PC Builder')]) }}</li>
@endcomponent

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/pcbuilder.css') }}">
    <style>
        strong, b {
            font-weight: 500;
        }
    </style>
@endpush

@section('content')

<div id="print-pcb">
    <div class="wrapper-pcb">
        <div class="top-area">
            <div class="logo">
                @if ($logo)
                    <img src="{{ $logo }}" alt="logo" width="200px">
                @endif
            </div>
            <div class="company-info">
                <h2>{{ setting('store_name') }}</h2>
                <div class="address text-center">
                    <p><strong>Phone: </strong>{{ setting('store_phone') }}, <strong>Email:</strong>{{ setting('store_email') }}</p>
                    <p class="web"></p>
                </div>
            </div>
        </div>
        <div class="all-printed-component">
            <table>
                <tbody>
                    <tr class="component-info">
                        <td><b>Component</b></td>
                        <td><b>Product Name</b></td>
                        <td><b>Price</b></td>
                    </tr>
                    @foreach ($pcbuilder->component as $li)
                        <tr class="details">
                            <td class="component">
                                {{ $li->category->name??'' }}
                            </td>
                            <td class="name">
                                {{ $li->product->name??'' }}
                            </td>
                            <td class="price">
                                {{ $li->product->selling_price??'' }} ৳
                            </td>
                        </tr>
                    @endforeach
                    <tr class="details total-amount">
                        <td colspan="2" class="amount-label"><b>Total:</b></td>
                        <td class="amount">{{ $pcbuilder->total_price . ' ৳' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function printPcBuilder() {
        var printContents = document.getElementById('print-pcb').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents; 
        window.print();
    }
    window.addEventListener("load", function(){
        printPcBuilder();
    });
</script>
@endpush
