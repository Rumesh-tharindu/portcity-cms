@isset($locale)
@php
$localeLabel = getLocaleLabel($locale);
$localeLabelOptional = getLocaleLabel($locale, false);
@endphp
<div class="row">
    <div class="col-xs-12 col-md-6 form-group">
        {!! Form::label("name_$localeLabel") !!}
        {!! Form::text("name[$locale]", getTranslation($model, $locale, "name"), ["class" => ["form-control"]]) !!}
        {!! errorMessageAjax("name.$locale") !!}
    </div>

</div>
<div class="row">
    <div class="col-xs-12 col-md-6 form-group">
        {!! Form::label("designation_$localeLabel") !!}
        {!! Form::text("designation[$locale]", getTranslation($model, $locale, "designation"), [
        "class" => ["form-control"],
        ]) !!}
        {!! errorMessageAjax("designation.$locale") !!}
    </div>
</div>
@endisset
