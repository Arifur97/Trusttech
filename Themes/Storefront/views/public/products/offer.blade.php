@extends('public.layout')

@section('title')
    @if (request()->has('query'))
        {{ trans('storefront::products.search_results_for') }}: "{{ request('query') }}"
    @else
        {{ $categoryName ?? ($brandName ?? trans('storefront::products.shop')) }}
    @endif
@endsection

@push('meta')
    <meta name="title" content="{{ $categoryMetaTitle ?? '' }}">
    <meta name="description" content="{{ $categoryMetaDesc ?? '' }}">
    <meta name="keyword" content="{{ $categoryKeyword ?? '' }}">
@endpush

@push('globals')
    <script>
        TrustTech.langs['storefront::products.showing_results'] = '{{ trans('storefront::products.showing_results') }}';
        TrustTech.langs['storefront::products.show_more'] = '{{ trans('storefront::products.show_more') }}';
        TrustTech.langs['storefront::products.show_less'] = '{{ trans('storefront::products.show_less') }}';
    </script>
@endpush

@section('content')
    <product-index initial-query="{{ request('query') }}" initial-brand-name="{{ $brandName ?? '' }}"
        initial-brand-banner="{{ $brandBanner ?? '' }}" initial-brand-slug="{{ request('brand') }}"
        initial-category-name="{{ $categoryName ?? '' }}" initial-category-banner="{{ $categoryBanner ?? '' }}"
        initial-category-slug="{{ request('category') }}" initial-tag-name="{{ $tagName ?? '' }}"
        initial-tag-slug="{{ request('tag') }}" :initial-attribute="{{ json_encode(request('attribute', [])) }}"
        :max-price="{{ $maxPrice ?? 3000000 }}" initial-sort="{{ request('sort', 'latest') }}"
        :initial-per-page="{{ request('perPage', 20) }}" :initial-page="{{ request('page', 1) }}"
        initial-view-mode="{{ request('viewMode', 'grid') }}" :has-offer="true" inline-template>
        <section class="product-search-wrap mt-0">
            @if ($offerPageBanner)
                <div class="d-none d-lg-block categories-banner mb-4">
                    <img class="w-100" src="{{ $offerPageBanner }}" alt="Brand banner">
                </div>
            @endif
            <div class="container">
                <div class="product-search">
                    <div class="product-search-left" style="display: none;">
                        @include('public.products.index.filter')
                    </div>

                    <div class="product-search-right" v-cloak style="width: 100%;">
                        <div class="search-result">
                            <div class="text-center">
                                <div v-for="category in products.categories" :key="category.id" class="d-inline-block">
                                    <div class="product__brand-inner" @click="fetchOfferProducts(category.id)"
                                        :class="{ 'border-primary': products.active_category_id == category.id }">
                                        <img :src="category.logo?.path || ''" alt=""
                                            class="img-fluid product__brand-image">
                                        <span class="product__brand-name" v-text="category.name"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="search-result-middle mt-4"
                                :class="{ empty: emptyProducts, loading: fetchingProducts }">
                                <div class="grid-view-products" v-if="viewMode === 'grid'">
                                    <product-card-grid-view v-for="product in products.data" :key="product.id"
                                        :product="product"></product-card-grid-view>
                                </div>

                                <div class="empty-message" v-if="! fetchingProducts && emptyProducts">
                                    @include('public.products.index.empty_results_logo')

                                    <h2>{{ trans('storefront::products.no_product_found') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </product-index>
@endsection

@push('scripts')
    <style>
        .border-primary {
            border: 1px solid #d55602;
        }
    </style>
@endpush
