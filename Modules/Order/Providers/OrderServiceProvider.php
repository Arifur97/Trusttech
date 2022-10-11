<?php

namespace Modules\Order\Providers;

use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\Order\Http\ViewComposers\LogoComposer;

class OrderServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addAdminAssets('admin.orders.show', ['admin.order.css', 'admin.order.js']);
        
        View::composer('order::admin.orders.print.show', LogoComposer::class);
    }
}

