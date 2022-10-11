<div class="row">
    <div class="col-md-8">
        {{ Form::wysiwyg('short_description', trans('product::attributes.short_description'), $errors, $product, ['labelCol' => 3, 'required' => false]) }}
        {{ Form::text('new_from', trans('product::attributes.new_from'), $errors, $product, ['class' => 'datetime-picker']) }}
        {{ Form::text('new_to', trans('product::attributes.new_to'), $errors, $product, ['class' => 'datetime-picker'] ) }}
    </div>
</div>
