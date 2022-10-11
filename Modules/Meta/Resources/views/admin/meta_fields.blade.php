@if ($entity->slug ?? false)
    {{ Form::text('slug', trans('page::attributes.slug'), $errors, $entity, ['required' => true]) }}
@endif

<div class="form-group">
    <label for="meta-title" class="col-md-3 control-label text-left">
        {{ trans('meta::attributes.meta_title') }}
    </label>

    <div class="col-md-9">
        <input type="text" name="meta[meta_title]" class="form-control" id="meta-title"
            value="{{ old('meta.meta_title', optional($entity->meta ?? null)->translate(locale())->meta_title ?? '') }}">
    </div>
</div>

<div class="form-group">
    <label for="meta-description" class="col-md-3 control-label text-left">
        {{ trans('meta::attributes.meta_description') }}
    </label>

    <div class="col-md-9">
        <textarea name="meta[meta_description]" class="form-control" id="meta-description" rows="10" cols="10">{{ old('meta.meta_description', optional($entity->meta ?? null)->translate(locale())->meta_description ?? '') }}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="meta-keywords" class="col-md-3 control-label text-left">
        {{ trans('Keywords') }}
    </label>

    <div class="col-md-9">
        <textarea name="meta[meta_keywords]" class="form-control" id="meta-keywords" rows="5" cols="10">{{ old('meta.meta_keywords', optional($entity->meta ?? null)->translate(locale())->meta_keywords ?? '') }}</textarea>
    </div>
</div>

@if ($hasSchema ?? false)
    <div class="form-group">
        <label for="meta-schema" class="col-md-3 control-label text-left">
            {{ trans('schema') }}
        </label>

        <div class="col-md-9">
            <textarea name="meta[meta_schema]" class="form-control" id="meta-schema" rows="5" cols="10">{{ old('meta.meta_schema', optional($entity->meta ?? null)->translate(locale())->meta_schema ?? '') }}</textarea>
        </div>
    </div>
@endif
