<nav class="navbar navbar-expand-sm">
    <ul class="navbar-nav mega-menu horizontal-megamenu">
        @foreach ($primaryMenu->menus() as $menu)
            @include('public.layout.navigation.menu', ['type' => 'primary_menu'])
        @endforeach
    </ul>
</nav>

<div class="header-column-right ml-auto d-flex">
    <a href="{{ route('compare.index') }}" class="header-wishlist">
        <div class="icon-wrap">
            <i class="las la-random"></i>
            {{-- <div class="count" v-text="wishlistCount"></div> --}}
        </div>
    </a>

    <a href="{{ route('account.wishlist.index') }}" class="header-wishlist">
        <div class="icon-wrap">
            <i class="lar la-heart"></i>
            <div class="count" v-text="wishlistCount"></div>
        </div>

        {{-- <span>{{ trans('storefront::layout.favorites') }}</span> --}}
    </a>

    <div class="header-cart">
        <div class="icon-wrap">
            <i class="las la-cart-arrow-down"></i>
            <div class="count" v-text="cart.quantity"></div>
        </div>

        <span v-html="cart.subTotal.inCurrentCurrency.formatted"></span>
    </div>
</div>