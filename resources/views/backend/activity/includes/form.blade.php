{{-- @include('backend.theme.components.localization-tab') --}}

<div class="card-body">

    {{ Form::model($model, $route) }}

    <div class="row">

        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('category_*', null, ['class' => 'control-label']) !!}
            {!! Form::select('category_id', $categories, null, [
            'placeholder' => 'Please select',
            'class' => 'form-control select2',
            ]) !!}
            {!! errorMessageAjax('category_id') !!}
        </div>

    </div>
    <div class="tab-content">

        <div class="tab-pane fade active show" id="custom-tabs-en" role="tabpanel" aria-labelledby="custom-tabs-en-tab">
            @include('backend.activity.includes.localization', [ 'locale' => 'en' ])
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
@include('backend.theme.components.ajax-form-submit', [ 'redirectUrl' => 'admin.activity.index' ])
@include('backend.theme.components.ajax-media-delete')
@endpush