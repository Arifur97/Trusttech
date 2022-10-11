<div class="accordion-box-content">
    <div class="tab-content clearfix">
        <div class="panel-wrap">
            @include('admin.storefront.tabs.partials.single_banner', [
                'label' => trans('storefront::storefront.form.banner'),
                'name' => 'storefront_offer_page_banner',
                'banner' => $banner,
            ])
        </div>
    </div>
</div>
