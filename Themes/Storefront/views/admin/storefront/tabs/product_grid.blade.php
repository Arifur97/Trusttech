<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('storefront_product_grid_section_enabled',trans('storefront::attributes.section_status'),trans('Home Page Products'),$errors,$settings) }}

        <div class="clearfix"></div>

        <div class="box-content clearfix">
            {{ Form::text('translatable[storefront_product_grid_section_tab_1_title]',trans('storefront::attributes.title'),$errors,$settings) }}
            {{ Form::textarea('translatable[storefront_product_grid_section_tab_1_subtitle]',trans('Subtitle'),$errors,$settings) }}

            @include(
                'admin.storefront.tabs.partials.custom_products',
                [
                    'fieldNamePrefix' => 'storefront_product_grid_section_tab_1',
                    'products' => $tabOneProducts,
                ]
            )
        </div>
    </div>
</div>
