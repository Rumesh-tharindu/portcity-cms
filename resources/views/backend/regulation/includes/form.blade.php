{{-- @include('backend.theme.components.localization-tab') --}}

<div class="card-body">

    {{ Form::model($model, $route) }}

    <div class="tab-content">

        <div class="tab-pane fade active show" id="custom-tabs-en" role="tabpanel" aria-labelledby="custom-tabs-en-tab">
            @include('backend.regulation.includes.localization', [ 'locale' => 'en' ])
        </div>

    </div>

    <div class="row">

        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('featured_image') !!}
            {!! getImagePreview($model, 'featured_image', false) !!}
            <div class="custom-file">
                {!! Form::file('featured_image', [
                'class' => 'form-control custom-file-input',
                'accept' => 'image/jpeg,image/jpg,image/png',
                ]) !!}
                <label class="custom-file-label" for="featured_image">Choose image</label>
            </div>

            {!! errorMessageAjax('featured_image') !!}

        </div>

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

        <div class="col-xs-12 col-md-12 ">
            {!! Form::label('pdf') !!}

            {!! getFilePreview($model, 'pdf', false) !!}

            {!! Form::file('pdf', [
            'class' => 'filepond',
            'accept' => 'application/pdf',
            'data-max-file-size' => '200MB',
            ]) !!}

            {!! errorMessageAjax('pdf') !!}

        </div>

        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('featured', 'Featured', ['class' => 'control-label']) !!}
            {!! Form::checkbox('featured', 1, !isset($model) ? false : null, [
            'class' => 'form-control',
            'data-bootstrap-switch',
            ]) !!}
            {!! errorMessageAjax('featured') !!}
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
@include('backend.theme.components.filepond')
@include('backend.theme.components.ajax-form-submit', [ 'redirectUrl' => 'admin.regulation.index' ])
@include('backend.theme.components.ajax-media-delete')
@endpush
