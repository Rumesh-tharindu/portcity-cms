@isset($locale)
@php
$localeLabel = getLocaleLabel($locale);
$localeLabelOptional = getLocaleLabel($locale, false);
@endphp
<div class="row">
    <div class="col-xs-12 col-md-12 form-group">
        {!! Form::label("type_$localeLabel") !!}
        {!! Form::text("type[$locale]", getTranslation($model, $locale, "type"), ["class" => ["form-control"]]) !!}
        {!! errorMessageAjax("type.$locale") !!}
    </div>

</div>
@endisset
