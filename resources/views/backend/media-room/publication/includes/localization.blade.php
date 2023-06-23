@isset($locale)
@php
$localeLabel = getLocaleLabel($locale);
$localeLabelOptional = getLocaleLabel($locale, false);
@endphp
<div class="row">

    <div class="col-xs-12 col-md-6 form-group">
        {!! Form::label("title_$localeLabel") !!}
        {!! Form::text("title[$locale]", getTranslation($model, $locale, "title"), ["class" => ["form-control"]]) !!}
        {!! errorMessageAjax("title.$locale") !!}
    </div>

</div>

<div class="row not-media-kit">
    <div class="col-xs-12 col-md-12 form-group">
        {!! Form::label("summary_$localeLabelOptional") !!}
        {!! Form::textarea("summary[$locale]", getTranslation($model, $locale, "summary"), [
        "class" => ["form-control summernote"],
        "rows" => 2,
        ]) !!}
        {!! errorMessageAjax("summary.$locale") !!}
    </div>
</div>

<div class="row not-media-kit">
    <div class="col-xs-12 col-md-12 form-group">
        {!! Form::label("description_$localeLabelOptional") !!}
        {!! Form::textarea("description[$locale]", getTranslation($model, $locale, "description"), [
        "class" => ["form-control summernote"],
        "rows" => 2,
        ]) !!}
        {!! errorMessageAjax("description.$locale") !!}
    </div>
</div>
@endisset