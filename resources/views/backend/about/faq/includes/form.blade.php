{{-- @include('backend.theme.components.localization-tab') --}}

<div class="card-body">

    {{ Form::model($model, $route) }}

    <div class="tab-content">

        <div class="tab-pane fade active show" id="custom-tabs-en" role="tabpanel" aria-labelledby="custom-tabs-en-tab">
            @include('backend.about.faq.includes.localization', [ 'locale' => 'en' ])
        </div>

    </div>


    <div class="row">
      <div class="col-xs-12 col-md-6 form-group">
        {!! Form::label('sort_*') !!}
        {!! Form::number('sort', null, [
        'class' => ['form-control'],
        'min' => 0,
        ]) !!}
        {!! errorMessageAjax('sort') !!}
      </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('status', 'Status *', ['class' => 'control-label']) !!}
            {!! Form::checkbox('status', 1, !isset($model) ? true : null, [
            'class' => 'form-control',
            'data-bootstrap-switch',
            ]) !!}
            {!! errorMessageAjax('status') !!}
        </div>

    </div>
    {!! $model ? updateButton() : saveButton() !!}
    {!! Form::close() !!}
</div>


@push('scripts')
@include('backend.theme.components.ajax-form-submit', [ 'redirectUrl' => 'admin.about.faq.index' ])
@include('backend.theme.components.ajax-media-delete')
@endpush
