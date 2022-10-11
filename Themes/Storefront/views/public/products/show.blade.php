@extends('public.layout')

@section('title', $product->meta->meta_title ?: $product->name)

@push('meta')
    <meta name="title" content="{{ $product->meta->meta_title ?: $product->name }}">
    <meta name="description" content="{{ $product->meta->meta_description ?: $product->short_description }}">
    <meta name="keywords" content="{{ $product->meta->meta_keywords ?: '' }}">
    <meta name="twitter:card" content="summary">
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $product->meta->meta_title ?: $product->name }}">
    <meta property="og:description" content="{{ $product->meta->meta_description ?: $product->short_description }}">
    <meta property="og:image" content="{{ $product->base_image->path }}">
    <meta property="og:locale" content="{{ locale() }}">

    @foreach (supported_locale_keys() as $code)
        <meta property="og:locale:alternate" content="{{ $code }}">
    @endforeach

    <meta property="product:price:amount" content="{{ $product->selling_price->convertToCurrentCurrency()->amount() }}">
    <meta property="product:price:currency" content="{{ currency() }}">
@endpush

@push('globals')
    <script>
        TrustTech.langs['storefront::product.reviews'] = '{{ trans('storefront::product.reviews') }}';
        TrustTech.langs['storefront::product.related_products'] = '{{ trans('storefront::product.related_products') }}';
    </script>

    {!! $product->meta->meta_schema ?? '' !!}
    {!! $productSchemaMarkup->toScript() !!}
@endpush

@push('styles')
    <style>
        .brief-description ul {
            margin-left: 20px;
        }

        @media screen and (max-width: 576px) {
            .base-image-wrap .base-image-slide {
                padding-bottom: 80% !important;
            }
        }

        @media screen and (max-width: 500px) {
            .breadcrumb {
                margin: 8px 0 0 !important;
            }

            .breadcrumb ul>li {
                font-size: 10px !important;
            }

            .product-name {
                font-size: 16px !important;
                margin-bottom: 8px !important;
            }

            .product-details-wrap {
                margin-top: 10px !important;
            }
        }
    </style>
@endpush

@section('breadcrumb')
    @if (!$categoryBreadcrumb)
        <li><a href="{{ route('products.index') }}">{{ trans('storefront::products.shop') }}</a></li>
    @endif

    {!! $categoryBreadcrumb !!}

    <li class="active">{{ strlen($product->name) > 28 ? str_split($product->name, 28)[0] . '...' : $product->name }}</li>
@endsection

@section('content')
    <product-show :product="{{ $product }}" :review-count="{{ $review->count ?? 0 }}"
        :avg-rating="{{ $review->avg_rating ?? 0 }}" inline-template>
        <section class="product-details-wrap">
            <div class="container">
                <div class="product-details-top">
                    <div class="product-details-top-inner">
                        @include('public.products.show.images')

                        <div class="product-details-info">
                            <div class="details-info-top">
                                <h1 class="product-name">{{ $product->name }}</h1>

                                <div class="product-price" v-html="price">
                                    {!! $product->formatted_price !!}
                                </div>

                                @if (setting('reviews_enabled'))
                                    <product-rating :rating-percent="ratingPercent" :review-count="totalReviews">
                                    </product-rating>
                                @endif

                                @if ($product->isInStock())
                                    @if ($product->manage_stock)
                                        <div class="availability in-stock">
                                            {{ trans('storefront::product.left_in_stock', ['count' => $product->qty]) }}
                                        </div>
                                    @else
                                        <div class="availability in-stock mb-0">
                                            {{ trans('storefront::product.in_stock') }}
                                        </div>
                                    @endif
                                @else
                                    @if ($product->isUpcoming())
                                        <div class="availability out-of-stock">
                                            {{ trans('Upcoming') }}
                                        </div>
                                    @else
                                        <div class="availability out-of-stock">
                                            {{ trans('storefront::product.out_of_stock') }}
                                        </div>
                                    @endif
                                @endif

                                <div class="availability out-of-stock">
                                    <span>Product Code: </span> {{ $product->id }}
                                </div>

                                <div class="brief-description">
                                    {!! $product->short_description !!}
                                </div>

                                <div class="details-info-top-actions">
                                    <button class="btn btn-wishlist" :class="{ 'added': inWishlist }" @click="syncWishlist">
                                        <i class="la-heart" :class="inWishlist ? 'las' : 'lar'"></i>
                                        {{ trans('storefront::product.wishlist') }}
                                    </button>

                                    <button class="btn btn-compare" :class="{ 'added': inCompareList }"
                                        @click="syncCompareList">
                                        <i class="las la-random"></i>
                                        {{ trans('storefront::product.compare') }}
                                    </button>
                                </div>
                            </div>

                            <div class="availability out-of-stock" style="margin-bottom: 10px;"
                                onclick="gotoSpecification();">View More Info</div>


                            <div class="details-info-middle">

                                <form @submit.prevent="addToCart" @input="errors.clear($event.target.name)"
                                    @change="updatePrice" @nice-select-updated="updatePrice">
                                    <div class="product-variants">
                                        @foreach ($product->options as $option)
                                            @includeIf("public.products.show.custom_options.{$option->type}")
                                        @endforeach
                                    </div>

                                    <div class="details-info-middle-actions">
                                        <div class="number-picker">
                                            <label for="qty">{{ trans('storefront::product.quantity') }}</label>

                                            <div class="input-group-quantity">
                                                <input type="text" :value="cartItemForm.qty" min="1"
                                                    max="{{ $product->manage_stock ? $product->qty : '' }}" id="qty"
                                                    class="form-control input-number input-quantity"
                                                    @input="updateQuantity($event.target.value)"
                                                    @keydown.up="updateQuantity(cartItemForm.qty + 1)"
                                                    @keydown.down="updateQuantity(cartItemForm.qty - 1)">

                                                <span class="btn-wrapper">
                                                    <button type="button" class="btn btn-number btn-plus" data-type="plus">
                                                        + </button>
                                                    <button type="button" class="btn btn-number btn-minus"
                                                        data-type="minus" disabled> - </button>
                                                </span>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-add-to-cart"
                                            :class="{ 'btn-loading': addingToCart }"
                                            {{ $product->isOutOfStock() ? 'disabled' : '' }}>
                                            <i class="las la-cart-arrow-down"></i>
                                            {{ trans('storefront::product.add_to_cart') }}
                                        </button>

                                        @if ($product->selling_price->amount() >= 5000)
                                            <button type="button" class="btn btn-primary btn-add-to-cart mx-3"
                                                data-toggle="modal" data-target="#emiModal">
                                                EMI
                                            </button>
                                        @endif
                                    </div>
                                </form>
                            </div>

                            @include('public.products.show.emi.emi_modal')

                            <div class="details-info-bottom">
                                <ul class="list-inline additional-info">
                                    @if ($product->categories->isNotEmpty())
                                        <li>
                                            <label>{{ trans('storefront::product.categories') }}</label>

                                            @foreach ($product->categories as $category)
                                                <a
                                                    href="{{ $category->url() }}">{{ $category->name }}</a>{{ $loop->last ? '' : ',' }}
                                            @endforeach
                                        </li>
                                    @endif

                                    @if ($product->product_tag)
                                        <li>
                                            <label>{{ trans('storefront::product.tags') }}</label>
                                            <div class="availability out-of-stock" style="display: inline-block;">
                                                {{ $product->product_tag }}</div>
                                        </li>
                                    @endif
                                </ul>

                                @include('public.products.show.social_share')
                            </div>
                        </div>
                    </div>

                    {{-- @include('public.products.show.right_sidebar') --}}
                </div>

                <div class="product-details-bottom flex-column-reverse flex-lg-row" id="product-info-tab">
                    @include('public.products.show.left_sidebar')

                    <div class="product-details-bottom-inner">
                        <div class="product-details-tab clearfix">
                            <ul class="nav nav-tabs tabs">
                                <li class="nav-item">
                                    <a href="#specification" data-toggle="tab" class="nav-link"
                                        :class="{ active: activeTab === 'specification' }">
                                        {{ trans('storefront::product.specification') }}
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="#description" data-toggle="tab" class="nav-link"
                                        :class="{ active: activeTab === 'description' }">
                                        {{ trans('storefront::product.description') }}
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="#video" data-toggle="tab" class="nav-link"
                                        :class="{ active: activeTab === 'video' }" v-cloak>
                                        Video
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="#question" data-toggle="tab" class="nav-link"
                                        :class="{ active: activeTab === 'question' }" v-cloak>
                                        Question
                                    </a>
                                </li>

                                @if (setting('reviews_enabled'))
                                    <li class="nav-item">
                                        <a href="#reviews" data-toggle="tab" class="nav-link"
                                            :class="{ active: activeTab === 'reviews' }" v-cloak>
                                            @{{ $trans('storefront::product.reviews', {
    count: totalReviews
}) }}
                                        </a>
                                    </li>
                                @endif
                            </ul>

                            <div class="tab-content">
                                @include('public.products.show.tab_specification', ['product' => $product])
                                @include('public.products.show.tab_description')
                                @include('public.products.show.tab_video', ['product' => $product])
                                @include('public.products.show.tab_question')
                                @include('public.products.show.tab_reviews')
                            </div>
                        </div>

                        <related-products :products="{{ $relatedProducts }}"></related-products>
                    </div>
                </div>
            </div>
        </section>
    </product-show>
@endsection

@push('scripts')
    <script src="{{ v(Theme::url('public/js/flatpickr.js')) }}"></script>
    <script src="{{ asset('assets/js/style.js') }}"></script>
@endpush
