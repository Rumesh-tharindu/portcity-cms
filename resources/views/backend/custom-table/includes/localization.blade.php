@isset($locale)
@php
$localeLabel = getLocaleLabel($locale);
$localeLabelOptional = getLocaleLabel($locale, false);
@endphp
<div class="row">
    <div class="col-xs-12 col-md-12 form-group">
        {!! Form::label("name_$localeLabelOptional") !!}
        {!! Form::text("name[$locale]", getTranslation($model, $locale, "name"), ["class" => ["form-control"]]) !!}
        {!! errorMessageAjax("name.$locale") !!}
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-12 form-group">
        {!! Form::label("table_$localeLabel") !!}
        {!! Form::textarea("table_data[$locale]", getTranslation($model, $locale, "table_data"), [
        "class" => ["form-control summernote"],
        "rows" => 2,
        ]) !!}
        {!! errorMessageAjax("table_data.$locale") !!}
    </div>
</div>
@endisset
