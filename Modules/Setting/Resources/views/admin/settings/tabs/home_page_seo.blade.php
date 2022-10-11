<div class="row">
    <div class="col-md-8">
        {{ Form::text('home_page_title', trans('Home Page Title'), $errors, $settings) }}
        {{ Form::text('home_page_meta_title', trans('Meta Title'), $errors, $settings) }}
        {{ Form::textarea('home_page_meta_desc', trans('Meta Description'), $errors, $settings) }}
        {{ Form::textarea('home_page_meta_keywords', trans('Meta Keywords'), $errors, $settings) }}
        {{ Form::textarea('home_page_schema', trans('Schema'), $errors, $settings) }}
    </div>
</div>
