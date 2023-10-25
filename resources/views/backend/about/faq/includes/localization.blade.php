@isset($locale)
@php
$localeLabel = getLocaleLabel($locale);
$localeLabelOptional = getLocaleLabel($locale, false);
@endphp
<div class="row">
    <div class="col-xs-12 col-md-12 form-group">
        {!! Form::label("question_$localeLabel") !!}
        {!! Form::text("question[$locale]", getTranslation($model, $locale, "question"), ["class" => ["form-control"]])
        !!}
        {!! errorMessageAjax("question.$locale") !!}
    </div>

</div>
<div class="row">
    <div class="col-xs-12 col-md-12 form-group">
        {!! Form::label("answer_$localeLabel") !!}
        {!! Form::textarea("answer[$locale]", getTranslation($model, $locale, "answer"), [
        "class" => ["form-control summernote"],
        "rows" => 5,
        ]) !!}
        {!! errorMessageAjax("answer.$locale") !!}
    </div>
</div>
@endisset
