<!DOCTYPE html>
<html lang="{{ locale() }}">

<head>
    <base href="{{ config('app.url') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>
        @hasSection('title')
            @yield('title')
        @else
            {{ setting('store_name') }}
        @endif
    </title>

    @stack('meta')

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500&display=swap" rel="stylesheet">

    @if (is_rtl())
        <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.rtl.css')) }}">
    @else
        <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.css')) }}">
    @endif

    {{-- custom css, will separate in another file --}}
    <style>
        .product-brand-image {
            padding: 10px 12px;
            height: auto;
            width: 120px !important;
        }

        .layout__marquee {
            background: rgba(2, 12, 20, 0.8);
            color: #fff;
            border-top: 1px solid red;
            position: fixed;
            bottom: 0;
            z-index: 999;
        }

        .show-attr {
            display: block;
            transition: 0.5ms ease;
        }

        .closed-attr {
            display: none;
            transition: 0.5ms ease;
        }
    </style>
    <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">

    @stack('styles')

    {!! setting('custom_header_assets') !!}

    <script>
        window.TrustTech = {
            baseUrl: '{{ config('app.url') }}',
            rtl: {{ is_rtl() ? 'true' : 'false' }},
            storeName: '{{ setting('store_name') }}',
            storeLogo: '{{ $logo }}',
            loggedIn: {{ auth()->check() ? 'true' : 'false' }},
            csrfToken: '{{ csrf_token() }}',
            stripePublishableKey: '{{ setting('stripe_publishable_key') }}',
            razorpayKeyId: '{{ setting('razorpay_key_id') }}',
            cart: {!! $cart !!},
            wishlist: {!! $wishlist !!},
            compareList: {!! $compareList !!},
            langs: {
                'storefront::layout.next': '{{ trans('storefront::layout.next') }}',
                'storefront::layout.prev': '{{ trans('storefront::layout.prev') }}',
                'storefront::layout.search_for_products': '{{ trans('storefront::layout.search_for_products') }}',
                'storefront::layout.all_categories': '{{ trans('storefront::layout.all_categories') }}',
                'storefront::layout.most_searched': '{{ trans('storefront::layout.most_searched') }}',
                'storefront::layout.search_for_products': '{{ trans('storefront::layout.search_for_products') }}',
                'storefront::layout.category_suggestions': '{{ trans('storefront::layout.category_suggestions') }}',
                'storefront::layout.product_suggestions': '{{ trans('storefront::layout.product_suggestions') }}',
                'storefront::layout.product_suggestions': '{{ trans('storefront::layout.product_suggestions') }}',
                'storefront::layout.more_results': '{{ trans('storefront::layout.more_results') }}',
                'storefront::product_card.out_of_stock': '{{ trans('storefront::product_card.out_of_stock') }}',
                'storefront::product_card.new': '{{ trans('storefront::product_card.new') }}',
                'storefront::product_card.add_to_cart': '{{ trans('storefront::product_card.add_to_cart') }}',
                'storefront::product_card.view_options': '{{ trans('storefront::product_card.view_options') }}',
                'storefront::product_card.compare': '{{ trans('storefront::product_card.compare') }}',
                'storefront::product_card.wishlist': '{{ trans('storefront::product_card.wishlist') }}',
                'storefront::product_card.available': '{{ trans('storefront::product_card.available') }}',
                'storefront::product_card.sold': '{{ trans('storefront::product_card.sold') }}',
                'storefront::product_card.years': '{{ trans('storefront::product_card.years') }}',
                'storefront::product_card.months': '{{ trans('storefront::product_card.months') }}',
                'storefront::product_card.weeks': '{{ trans('storefront::product_card.weeks') }}',
                'storefront::product_card.days': '{{ trans('storefront::product_card.days') }}',
                'storefront::product_card.hours': '{{ trans('storefront::product_card.hours') }}',
                'storefront::product_card.minutes': '{{ trans('storefront::product_card.minutes') }}',
                'storefront::product_card.seconds': '{{ trans('storefront::product_card.seconds') }}',
            },
        };
    </script>

    {!! $schemaMarkup->toScript() !!}

    @stack('globals')

    @routes
</head>

<body class="page-template {{ is_rtl() ? 'rtl' : 'ltr' }}" data-theme-color="#{{ $themeColor->getHex() }}"
    style="--color-primary: #{{ $themeColor->getHex() }};
            --color-primary-hover: #{{ $themeColor->darken(8) }};
            --color-primary-transparent: {{ color2rgba($themeColor, 0.8) }};
            --color-primary-transparent-lite: {{ color2rgba($themeColor, 0.3) }};">
    <div class="wrapper" id="app">
        @include('public.layout.top_nav')
        @include('public.layout.header')
        {{-- @include('public.layout.navigation') --}}
        @include('public.layout.breadcrumb')

        @yield('content')

        @include('public.home.sections.subscribe')
        @include('public.layout.footer')

        <div class="overlay"></div>

        @include('public.layout.sidebar_menu')
        @include('public.layout.sidebar_cart')
        @include('public.layout.alert')
        @include('public.layout.newsletter_popup')
        @include('public.layout.cookie_bar')

        <marquee width="100%" direction="left" height="30px" class="layout__marquee" id='layoutMarquee'></marquee>
    </div>

    @stack('pre-scripts')

    <script src="{{ v(Theme::url('public/js/app.js')) }}"></script>

    @stack('scripts')

    {!! setting('custom_footer_assets') !!}

    <script>
        var layoutMarquee = document.getElementById('layoutMarquee');
        $.ajax({
            type: 'GET',
            url: 'https://trusttechbd.com/storefront/marquee/get',
            success: function(data) {
                layoutMarquee.innerText = data[0].marquee_text;
            }
        });
    </script>
    {{-- for toggle product index page filtering --}}
    <script>
        var iconPlus = '-';
        $('.section-title').on('click', function() {
            $(this).next().slideToggle();
            iconPlus = $(this).children()[1].innerText;
            if (iconPlus == '+') {
                $(this).children()[1].innerText = '-';
                iconPlus = '-';
            } else {
                $(this).children()[1].innerText = '+';
                iconPlus = '+';
            }
        });
    </script>
    <script>
        var attrIconPlus = '-'

        function toogleAttr(item) {
            item.nextElementSibling.classList.toggle("closed-attr");
            item.nextElementSibling.classList.toggle("show-attr");
            attrIconPlus = item.children[1].innerText;
            if (attrIconPlus == '+') {
                item.children[1].innerText = '-';
                attrIconPlus = '-';
            } else {
                item.children[1].innerText = '+';
                attrIconPlus = '+';
            }
        }
    </script>
</body>

</html>
