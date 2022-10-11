<div class="row">
    <div class="col-md-8">
        @if ($product->id != null)
            {{ Form::text('id', trans('Product Code'), $errors, $product, ['readonly' => true]) }}
        @endif

        {{ Form::select('manage_stock', trans('product::attributes.manage_stock'), $errors, trans('product::products.form.manage_stock_states'), $product) }}

        <div class="{{ old('manage_stock', $product->manage_stock) ? '' : 'hide' }}" id="qty-field">
            {{ Form::number('qty', trans('product::attributes.qty'), $errors, $product, ['required' => true]) }}
        </div>

        {{ Form::select('in_stock', trans('product::attributes.in_stock'), $errors, [
            '1' => 'In Stock',
            '0' => 'Out of Stock',
            '2' => 'Upcoming',
        ], $product) }}
    </div>
</div>
