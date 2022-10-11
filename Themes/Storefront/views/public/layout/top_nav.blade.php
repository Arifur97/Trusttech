<section class="top-nav-wrap">
    <div class="container">
        <div class="top-nav">
            <div class="row justify-content-between">
                <div class="top-nav-contact">
                    <a href="tel:{{ setting('store_phone') }}">
                        <div class="d-inline-block icon-shake">
                            <i class="las la-phone"></i>
                        </div>
                        <span class="top-nav-contact-info"> {{ setting('store_phone') }}  </span>
                    </a>
                    <div class="d-inline-block ml-3">|</div>
                    <a href="mailto:{{ setting('store_email') }}">
                        <div class="d-inline-block icon-shake ml-3">
                            <i class="las la-envelope"></i>
                        </div>
                        <span class="top-nav-contact-info"> {{ setting('store_email') }}</span>
                    </a>
                </div>
                
                <div class="top-nav-left d-none d-lg-block">
                    <marquee>{{ setting('storefront_welcome_text') }}</marquee>
                </div>

                <div class="top-nav-right">
                    <ul class="list-inline top-nav-right-list">
                        {{-- <li>
                            <a href="{{ route('contact.create') }}">
                                <i class="las la-phone"></i>
                                {{ trans('storefront::layout.contact') }}
                            </a>
                        </li> --}}
                        {{-- <li>
                            <a href="{{ route('contact.create') }}">
                                Track Your Order
                            </a>
                        </li> --}}

                        <li>
                            <a href="{{ route('compare.index') }}">
                                <i class="las la-random"></i>
                                {{ trans('storefront::layout.compare') }}
                            </a>
                        </li>

                        @if (is_multilingual())
                            <li>
                                <i class="las la-language"></i>
                                <select class="custom-select-option arrow-black" onchange="location = this.value">
                                    @foreach (supported_locales() as $locale => $language)
                                        <option value="{{ localized_url($locale) }}" {{ locale() === $locale ? 'selected' : '' }}>
                                            {{ $language['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </li>
                        @endif

                        @if (is_multi_currency())
                            <li>
                                <i class="las la-money-bill"></i>
                                <select class="custom-select-option arrow-black" onchange="location = this.value">
                                    @foreach (setting('supported_currencies') as $currency)
                                        <option
                                            value="{{ route('current_currency.store', ['code' => $currency]) }}"
                                            {{ currency() === $currency ? 'selected' : '' }}
                                        >
                                            {{ $currency }}
                                        </option>
                                    @endforeach
                                </select>
                            </li>
                        @endif

                        @auth
                            <li>
                                <a href="{{ route('account.dashboard.index') }}">
                                    <i class="las la-user"></i>
                                    {{ trans('storefront::layout.account') }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}">
                                    <i class="las la-sign-in-alt"></i>
                                    {{ trans('storefront::layout.login') }}
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
