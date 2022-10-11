<section class="navigation-wrap" style="height:50px;">
    <div class="container">
        <div class="navigation-inner">
            @include('public.layout.navigation.category_menu')
            @include('public.layout.navigation.primary_menu')

            <span class="navigation-text">
                {{ setting('storefront_navbar_text') }}
            </span>
        </div>
    </div>
</section>
