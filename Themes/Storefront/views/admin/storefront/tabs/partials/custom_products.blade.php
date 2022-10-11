@hasAccess('admin.products.index')
<div class="custom-products {{ setting("{$fieldNamePrefix}_product_type") === 'custom_products' ? '' : 'hide' }}">
    {{ Form::select(
        "{$fieldNamePrefix}_products",
        trans('storefront::attributes.products'),
        $errors,
        $products,
        $settings,
        ['class' => 'selectize prevent-creation', 'data-url' => route('admin.products.index'), 'multiple' => true],
    ) }}
</div>
@endHasAccess
