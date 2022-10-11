{{ Form::text('name', trans('product::attributes.name'), $errors, $product, ['labelCol' => 2, 'required' => true]) }}
{{ Form::wysiwyg('description', trans('product::attributes.description'), $errors, $product, ['labelCol' => 2, 'required' => true]) }}
{{ Form::wysiwyg('specification', 'Specification', $errors, $product, ['labelCol' => 2, 'required' => false]) }}
<div class="row">
    <div class="col-md-8">
        {{ Form::select('brand_id', trans('product::attributes.brand_id'), $errors, $brands, $product) }}
        {{ Form::select('categories', trans('product::attributes.categories'), $errors, $categories, $product, ['class' => 'selectize prevent-creation', 'multiple' => true]) }}
        {{ Form::select('tax_class_id', trans('product::attributes.tax_class_id'), $errors, $taxClasses, $product) }}
        {{ Form::select('tags', 'Filter Tags', $errors, $tags, $product, ['class' => 'selectize prevent-creation', 'multiple' => true]) }}
        {{ Form::text('product_tag', trans('product::attributes.tags'), $errors, $product) }}
        {{ Form::text('video_url', 'Youtube Video Id', $errors, $product, ['labelCol' => 3, 'required' => false]) }}
        {{ Form::checkbox('virtual', trans('product::attributes.virtual'), trans('product::products.form.the_product_won\'t_be_shipped'), $errors, $product) }}
        {{ Form::checkbox('is_active', trans('product::attributes.is_active'), trans('product::products.form.enable_the_product'), $errors, $product, ['checked' => true]) }}
    </div>
</div>

@push('scripts')
    <script>
        $('input[name="product_tag"]').amsifySuggestags();
    </script>
@endpush
