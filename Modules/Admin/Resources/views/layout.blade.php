<!DOCTYPE html>
<html lang="{{ locale() }}">
    <head>
        <base href="{{ url('/') }}">
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield('title') - Trusttech Admin
        </title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:600|Roboto:400,500" rel="stylesheet">    
        <link rel="shortcut icon" href="{{ $favicon??'' }}" type="image/x-icon">

        <style>
            .banner-img {
                width: 150px;
                height: auto;
            }
            .pcbuilder__component-img {
                width: 100px;
                height: auto;
            }
        </style>

        @foreach ($assets->allCss() as $css)
            <link media="all" type="text/css" rel="stylesheet" href="{{ v($css) }}">
        @endforeach
        <link rel="stylesheet" href="https://trusttechbd.com/assets/css/amsify.suggestags.css">
        @stack('styles')

        @include('admin::partials.globals')
    </head>

    <body class="skin-blue sidebar-mini offcanvas clearfix {{ is_rtl() ? 'rtl' : 'ltr' }}">
        <div class="left-side"></div>

        @include('admin::partials.sidebar')

        <div class="wrapper">
            <div class="content-wrapper">
                @include('admin::partials.top_nav')

                <section class="content-header clearfix">
                    @yield('content_header')
                </section>

                <section class="content">
                    @include('admin::partials.notification')

                    @yield('content')
                </section>

                <div id="notification-toast"></div>
            </div>
        </div>

        @include('admin::partials.footer')

        @include('admin::partials.confirmation_modal')

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        @foreach ($assets->allJs() as $js)
            <script src="{{ v($js) }}"></script>
        @endforeach
        {{-- in live change the domain or host also in css --}}
        <script src="https://trusttechbd.com/assets/js/jquery.amsify.suggestags.js"></script>
        @stack('scripts')
    </body>
</html>

