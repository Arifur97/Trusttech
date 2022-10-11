<header class="header-wrap">
    <div class="header-wrap-inner">
        <div class="container" style="padding: 10px;">
            <div class="row flex-nowrap justify-content-between position-relative">
                <div class="header-column-left">
                    <div class="sidebar-menu-icon-wrap">
                        <div class="sidebar-menu-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                    <a href="{{ route('home') }}" class="header-logo">
                        @if (is_null($logo))
                            <h3>{{ setting('store_name') }}</h3>
                        @else
                            <img src="{{ $logo }}" alt="logo">
                        @endif
                    </a>
                </div>

                <header-search
                    :categories="{{ $categories }}"
                    :most-searched-keywords="{{ $mostSearchedKeywords }}"
                    initial-query="{{ request('query') }}"
                    initial-category="{{ request('category') }}"
                >
                </header-search>

                <div class="header-column-right d-flex">
                    <a href="{{ route('pcbuilder.index') }}" class="btn build-pc text-white">PC Builder</a>
                    <a href="{{ route('pcbuilder.index') }}" class="build-pc-icon">
                        <div class="icon-wrap-pc-builer">
                            <p class="pcb-p"><i class="las la-desktop pcb-icon"></i> PC Build</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @include('public.layout.navigation')
    </div>
</header>

