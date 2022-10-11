@extends('public.layout')

@section('title', setting('home_page_title'))

@push('meta')
    <meta name="title" content="{{ setting('home_page_meta_title') ?? '' }}">
    <meta name="description" content="{{ setting('home_page_meta_desc') ?? '' }}">
    <meta name="keyword" content="{{ setting('home_page_meta_keywords') ?? '' }}">
@endpush

@push('globals')
    {!! setting('home_page_schema') ?? '' !!}
@endpush

@section('content')
    @includeUnless(is_null($slider), 'public.home.sections.slider')

    @if ($bannerSettings->banner_two_col == '1')
        <banner-two-column :data="{{ json_encode($twoColBanners) }}"></banner-two-column>
    @endif
    @if ($bannerSettings->banner_four_col == '1')
        <banner-four-column :data="{{ json_encode($fourColBanners) }}"></banner-four-column>
    @endif
    @if ($bannerSettings->banner_three_col == '1')
        <banner-three-column :data="{{ json_encode($threeColBanners) }}"></banner-three-column>
    @endif

    @if (setting('storefront_three_column_full_width_banners_enabled'))
        <banner-three-column-full-width :data="{{ json_encode($threeColumnFullWidthBanners) }}">
        </banner-three-column-full-width>
    @endif

    @if (setting('storefront_features_section_enabled'))
        <home-features :features="{{ json_encode($features) }}"></home-features>
    @endif

    @if (setting('storefront_featured_categories_section_enabled'))
        <featured-categories :data="{{ json_encode($featuredCategories) }}"></featured-categories>
    @endif

    @if (setting('storefront_product_tabs_1_section_enabled'))
        <product-tabs-one :data="{{ json_encode($productTabsOne) }}"></product-tabs-one>
    @endif

    @if (setting('storefront_flash_sale_and_vertical_products_section_enabled'))
        <flash-sale-and-vertical-products :data="{{ json_encode($flashSaleAndVerticalProducts) }}">
        </flash-sale-and-vertical-products>
    @endif

    @if (setting('storefront_product_grid_section_enabled'))
        <product-grid :data="{{ json_encode($productGrid) }}"></product-grid>
    @endif


    @if (setting('storefront_product_tabs_2_section_enabled'))
        <product-tabs-two :data="{{ json_encode($tabProductsTwo) }}"></product-tabs-two>
    @endif

    @if (setting('storefront_one_column_banner_enabled'))
        <banner-one-column :banner="{{ json_encode($oneColumnBanner) }}"></banner-one-column>
    @endif

    @if (setting('storefront_top_brands_section_enabled') && $topBrands->isNotEmpty())
        <top-brands :top-brands="{{ json_encode($topBrands) }}"></top-brands>
    @endif

    @if (setting('footer_desc'))
        <section class="footer-wrap mt-5">
            <div class="container rich__text-wrapper">
                {!! setting('footer_desc') !!}
            </div>
        </section>
    @endif

    @include('public.layout.newsletter_popup')
@endsection

@push('styles')
    <style>
        .rich__text-wrapper ul {
            margin-left: 20px;
        }

    </style>
@endpush
