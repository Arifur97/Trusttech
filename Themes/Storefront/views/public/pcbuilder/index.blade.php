@extends('public.layout')

@section('title', 'PC Builder')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/pcbuilder.css') }}">
@endpush

@section('breadcrumb')
    <li class="active">Pc Builder</li>
@endsection

@section('content')
    <div class="mt-5"></div>
        @if(session('success'))
            <p class="alert alert-success d-none">
                {{ session('success') }}
            </p>
        @endif
        <pcbuilder-index :categories="{{ json_encode($categories) }}" inline-template v-cloak>
            <section class="tool-pc_builder">
                <div class="build-your-pc bg-bt-gray">
                    <div class="container">
                        <form onsubmit="return confirm('Are you sure?');" action="{{ route('pcbuilder.save') }}" method="post" id="pcbForm">
                            @csrf
                            <div class="pcb-container">
                                <div class="pcb-head">
                                    <div class="trusttech-logo">
                                        <a href="{{ route('home') }}" class="header-logo">
                                            @if (is_null($logo))
                                                <h3>{{ setting('store_name') }}</h3>
                                            @else
                                                <img src="{{ $logo }}" alt="logo">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="actions">
                                        <div class="all-actions">
                                            <button type="submit" class="action">
                                                <i class="fz-25 las la-save"></i>
                                                <span class="action-text">Save PC</span>
                                            </button>
                                            <a class="action m-hide" href="{{ route('pcbuilder.preview') }}">
                                                <i class="fz-25 las la-eye"></i>
                                                <span class="action-text">Preview</span>
                                            </a>
                                            <a class="action m-hide" href="{{ route('pcbuilder.print') }}">
                                                <i class="fz-25 las la-print"></i>
                                                <span class="action-text">Print</span>
                                            </a>
                                            <button type="button" class="pcb-btn-primary pcb-st-outline" @click="getAQuote">Get a Quote</button>
                                            <input type="hidden" id="pcbIsQuote" name="pcb_is_qoute" value="">
                                        </div>
                                    </div>
                                </div>
                
                                <div class="pcb-inner-content">
                                    <div class="pcb-top-content">
                                        <div class="left">
                                            <h5 class="pcb-st-outline">Build Your Own Computer with {{ setting('store_name') }}</h5>
                                        </div>
                                        <div class="right">
                                            <div class="total-amount t-price">
                                                <span class="amount"><span v-text="totalAmount">0</span> ৳</span><br>
                                                <span class="items"><span v-text="totalItem">0</span> Items</span>
                                            </div>
                                            <input type="hidden" name="total_item" :value="totalItem">
                                            <input type="hidden" name="total_price" :value="totalAmount">
                                        </div>
                                    </div>
    
                                    <div class="pcb-content">
                                        <div class="content-label">Components</div>
                                            <div v-for="component in components">
                                                <input type="hidden" name="component_product_ids[]" :value="component.pcbuilder.id">
                                                <input type="hidden" name="component_category_ids[]" :value="component.id">
                                                <div class="c-item" 
                                                    :class="{ 'blank': component.pcbuilder.name == null ? true : false }">
                                                    <div class="img">
                                                        <img v-if="component.pcbuilder.image" :src="component.pcbuilder.image" alt="">
                                                        <img v-else-if="component.logo" :src="component.logo.path" alt="">
                                                        <span v-else class="img-ico"></span>
                                                    </div>
                                                    <div class="details">
                                                        <div class="component-name">
                                                            <span v-text="component.name || ''"></span>
                                                        </div>
                                                        <div class="product-name" 
                                                            v-if="component.pcbuilder" 
                                                            v-text="component.pcbuilder.name || ''"></div>
                                                    </div>
                                                    <div class="actions" v-if="component.pcbuilder.name == null ? true : false">
                                                        <a class="pcb-btn-primary pcb-st-outline" 
                                                            :href="'/categories/' + component.slug + '?pcbuild=true&pccomponent=' + component.slug"><i>Choose</i>
                                                        </a>
                                                    </div>
                                                    <div class="actions" v-if="component.pcbuilder.name">
                                                        <a class="pcb-st-outline" 
                                                            :href="'/categories/' + component.slug + '?pcbuild=true&pccomponent=' + component.slug">
                                                            <i class="fz-25 las la-retweet mr-3"></i>
                                                        </a>
                                                        <a class="pcb-st-outline" 
                                                            href="{{ Request::url() }}"
                                                            @click="removeComponent(component.slug)">
                                                            <i class="fz-25 pcb-st-outline las la-times"></i>
                                                        </a>
                                                        <div class="item-price" v-if="component.pcbuilder" v-text="component.pcbuilder.price"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </pcbuilder-index>
    </div>
@endsection