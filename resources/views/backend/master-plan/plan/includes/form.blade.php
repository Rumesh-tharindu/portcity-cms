{{-- @include('backend.theme.components.localization-tab') --}}

<div class="card-body">

    {{ Form::model($model, $route) }}

    <div class="tab-content">

        <div class="tab-pane fade active show" id="custom-tabs-en" role="tabpanel" aria-labelledby="custom-tabs-en-tab">
            @include('backend.master-plan.plan.includes.localization', [ 'locale' => 'en' ])
        </div>

    </div>

    <div class="row">

        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('map_image_*') !!}
            {!! getImagePreview($model, 'map_image', true) !!}
            <div class="custom-file">
                {!! Form::file('map_image', [
                'class' => 'form-control custom-file-input',
                'accept' => 'image/jpeg,image/jpg,image/png',
                ]) !!}
                <label class="custom-file-label" for="map_image">Choose image</label>
            </div>

            {!! errorMessageAjax('map_image') !!}

        </div>

        {{-- <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('sort_*') !!}
            {!! Form::number('sort', null, [
            'class' => ['form-control'],
            'min' => 0,
            ]) !!}
            {!! errorMessageAjax('sort') !!}
        </div> --}}
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
@include('backend.theme.components.editor')
@include('backend.theme.components.ajax-form-submit', [ 'redirectUrl' => 'admin.master-plan.plan.index' ])
@include('backend.theme.components.ajax-media-delete')
@endpush
