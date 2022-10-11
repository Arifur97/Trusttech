@extends('public.layout')

@section('title')
    @if ($dataMetaTitle ?? false)
        {{ $dataMetaTitle ?? '' }}
    @elseif (request()->has('query'))
        {{ trans('storefront::products.search_results_for') }}: "{{ request('query') }}"
    @else
        {{ $categoryName ?? ($brandName ?? trans('storefront::products.shop')) }}
    @endif
@endsection

@push('meta')
    <meta name="title" content="{{ $dataMetaTitle ?? '' }}">
    <meta name="description" content="{{ $dataMetaDesc ?? '' }}">
    <meta name="keyword" content="{{ $dataKeyword ?? '' }}">
    @if ($categoryCanonical)
        <link rel="canonical" href="{{ $categoryCanonical }}" />
    @endif
@endpush

@push('globals')
    <script>
        TrustTech.langs['storefront::products.showing_results'] = '{{ trans('storefront::products.showing_results') }}';
        TrustTech.langs['storefront::products.show_more'] = '{{ trans('storefront::products.show_more') }}';
        TrustTech.langs['storefront::products.show_less'] = '{{ trans('storefront::products.show_less') }}';
    </script>

    {!! $dataMetaSchema ?? '' !!}
@endpush

@push('styles')
    <style>
        .category__desc h1 {
            font-size: 32px !important;
            margin-bottom: 12px !important;
        }

        .category__desc h2 {
            font-size: 24px !important;
            margin-bottom: 12px !important;
        }

        .category__desc h3 {
            font-size: 20px !important;
            margin-bottom: 12px !important;
        }

        .category__desc ul {
            margin-left: 20px;
        }
    </style>
@endpush

@section('content')
    <product-index initial-query="{{ request('query') }}" initial-brand-name="{{ $brandName ?? '' }}"
        initial-brand-banner="{{ $brandBanner ?? '' }}" initial-brand-slug="{{ request('brand') }}"
        initial-category-name="{{ $categoryName ?? '' }}" initial-category-banner="{{ $categoryBanner ?? '' }}"
        initial-category-slug="{{ request('category') }}" initial-tag-name="{{ $tagName ?? '' }}"
        initial-tag-slug="{{ request('tag') }}" :initial-attribute="{{ json_encode(request('attribute', [])) }}"
        :max-price="{{ $maxPrice }}" initial-sort="{{ request('sort', 'latest') }}"
        :initial-per-page="{{ request('perPage', 20) }}" :initial-page="{{ request('page', 1) }}"
        initial-view-mode="{{ request('viewMode', 'grid') }}" inline-template>
        <section class="product-search-wrap">
            <div class="container">
                <div class="product-search">
                    <div class="product-search-left">
                        @include('public.products.index.filter')
                    </div>

                    <div class="product-search-right" v-cloak>
                        <div class="d-none d-lg-block categories-banner" v-if="brandBanner">
                            <img :src="brandBanner" alt="Brand banner">
                        </div>

                        <div class="d-lg-block categories-banner" v-else-if="categoryBanner">
                            <img :src="categoryBanner" alt="Category banner">
                        </div>

                        <div class="search-result">
                            <div class="search-result-top">
                                <div class="content-left">
                                    <h4 v-if="queryParams.query">
                                        {{ trans('storefront::products.search_results_for') }}
                                        <span>"@{{ queryParams.query }}"</span>
                                    </h4>
                                    <h4 v-else-if="queryParams.brand" v-text="initialBrandName"></h4>
                                    <h4 v-else-if="queryParams.category" v-text="categoryName"></h4>
                                    <h4 v-else-if="queryParams.tag" v-text="initialTagName"></h4>
                                    <h4 v-else>{{ trans('storefront::products.shop') }}</h4>
                                </div>

                                <div class="content-right">
                                    <div class="mobile-view-filter">
                                        <i class="las la-sliders-h"></i>
                                        {{ trans('storefront::products.filters') }}
                                    </div>

                                    <div class="sorting-bar">
                                        <div class="view-type">
                                            <button type="submit" class="btn btn-grid-view"
                                                :class="{ active: viewMode === 'grid' }"
                                                title="{{ trans('storefront::products.grid_view') }}"
                                                @click="viewMode = 'grid'">
                                                <i class="las la-th-large"></i>
                                            </button>

                                            <button type="submit" class="btn btn-list-view"
                                                :class="{ active: viewMode === 'list' }"
                                                title="{{ trans('storefront::products.list_view') }}"
                                                @click="viewMode = 'list'">
                                                <i class="las la-list"></i>
                                            </button>
                                        </div>

                                        <div class="form-group m-r-20">
                                            <select class="form-control custom-select-option right arrow-black"
                                                v-model="queryParams.sort" ref="sortSelect">
                                                @foreach (trans('storefront::products.sort_options') as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ request('sort', 'latest') === $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <select class="form-control custom-select-option right arrow-black"
                                                v-model="queryParams.perPage" ref="perPageSelect">
                                                @foreach (trans('storefront::products.per_page_options') as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ request('perPage', 10) == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="search-result-brand-image mb-3 mt-4">
                                @if (request()->pcbuild)
                                    <form @submit.prevent="fetchPcbuilderProducts">
                                        <div class="input-group">
                                            <input type="text" class="form-control mr-3"
                                                placeholder="Search Pc Builder Product" v-model="queryParams.query">
                                            <input type="submit" class="btn btn-primary" value="Search">
                                        </div>
                                    </form>
                                @endif
                                <div class="">
                                    @if (!request()->pcbuild)
                                        @foreach ($categories as $parent)
                                            @foreach ($parent->items as $child)
                                                @if ($parent->name == ($categoryName ?? ''))
                                                    <a
                                                        href="{{ route('categories.products.index', ['category' => $child->slug]) }}">
                                                        <div class="product__brand-inner">
                                                            <img src="{{ $child->logo->path ?? '' }}" alt=""
                                                                class="img-fluid product__brand-image">
                                                            <span
                                                                class="product__brand-name">{{ $child->name ?? '' }}</span>
                                                        </div>
                                                    </a>
                                                @elseif ($child->name == ($categoryName ?? ''))
                                                    @foreach ($child->items as $grandchild)
                                                        <a
                                                            href="{{ route('categories.products.index', ['category' => $grandchild->slug]) }}">
                                                            <div class="product__brand-inner">
                                                                <img src="{{ $grandchild->logo->path ?? '' }}"
                                                                    alt="" class="img-fluid product__brand-image">
                                                                <span
                                                                    class="product__brand-name">{{ $grandchild->name ?? '' }}</span>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="search-result-middle" :class="{ empty: emptyProducts, loading: fetchingProducts }">
                                <div class="grid-view-products" v-if="viewMode === 'grid'">
                                    <product-card-grid-view v-for="product in products.data" :key="product.id"
                                        :product="product" :pcbuild="{{ request()->pcbuild ? 'true' : 'false' }}"
                                        :pccomponent="'{{ request()->pccomponent }}'"></product-card-grid-view>
                                </div>

                                <div class="list-view-products" v-if="viewMode === 'list'">
                                    <product-card-list-view v-for="product in products.data" :key="product.id"
                                        :product="product" :pcbuild="{{ request()->pcbuild ? 'true' : 'false' }}"
                                        :pccomponent="'{{ request()->pccomponent }}'"></product-card-list-view>
                                </div>

                                <div class="empty-message" v-if="! fetchingProducts && emptyProducts">
                                    @include('public.products.index.empty_results_logo')

                                    <h2>{{ trans('storefront::products.no_product_found') }}</h2>
                                </div>
                            </div>

                            <div class="search-result-bottom" v-if="! emptyProducts">
                                <span class="showing-results" v-text="showingResults"></span>

                                <v-pagination :total-page="totalPage" :current-page="queryParams.page"
                                    @page-changed="changePage" v-if="products.total > queryParams.perPage">
                                </v-pagination>
                            </div>
                        </div>
                        @if ($categoryDescription ?? false)
                            <div class="mt-5 category__desc">
                                {!! $categoryDescription !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </product-index>
@endsection
