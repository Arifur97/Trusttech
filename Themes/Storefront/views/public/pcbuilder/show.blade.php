@extends('public.layout')

@section('title', 'PC Builder')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/pcbuilder.css') }}">
@endpush

@section('content')

    <pcbuilder-index :categories="{{ json_encode($categories) }}" inline-template v-cloak>
        <div id="print-pcb">
            <div class="wrapper-pcb">
                <div class="top-area">
                    <div class="logo">
                        @if ($logo)
                            <img src="{{ $logo }}" alt="logo" class="pcb-w">
                        @endif
                    </div>
                    <div class="company-info">
                        <h1>{{ setting('store_name') }}</h1>
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
                                <td class="component-name"><b>Component</b></td>
                                <td class="product-name"><b>Product Name</b></td>
                                <td class="price"><b>Price</b></td>
                            </tr>
                            <tr class="details" v-for="component in components">
                                <td class="component" v-text="component.name || ''"></td>
                                <td class="name" v-if="component.pcbuilder" v-text="component.pcbuilder.name || ''"></td>
                                <td class="price">
                                    <div class="price" v-if="component.pcbuilder" v-text="component.pcbuilder.price"></div>
                                </td>
                            </tr>
                            <tr class="details total-amount">
                                <td colspan="2" class="amount-label"><b>Total:</b></td>
                                <td class="amount"><span v-text="totalAmount">0</span> ৳</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </pcbuilder-index>
@endsection

@push('scripts')
    <script>
        function printPcBuilder() {
            var printContents = document.getElementById('print-pcb').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
        }
        window.addEventListener("load", function(){
            printPcBuilder();
        });
    </script>
@endpush