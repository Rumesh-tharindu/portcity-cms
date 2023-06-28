{{-- @include('backend.theme.components.localization-tab') --}}

<div class="card-body">

    {{ Form::model($model, $route) }}

    <div class="row">

        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('plan_*', null, ['class' => 'control-label']) !!}
            {!! Form::select('plan_id', $plans, null, [
            'placeholder' => 'Please select',
            'class' => 'form-control select2',
            ]) !!}
            {!! errorMessageAjax('plan_id') !!}
        </div>


        <div class="col-xs-12 col-md-6 form-group">
                {!! Form::label("plot_number_*") !!}
                {!! Form::text("plot_number", null, ["class" => ["form-control"]]) !!}
                {!! errorMessageAjax('plot_number') !!}
        </div>

    </div>
    <div class="tab-content">

        <div class="tab-pane fade active show" id="custom-tabs-en" role="tabpanel" aria-labelledby="custom-tabs-en-tab">
            @include('backend.master-plan.plot.includes.localization', [ 'locale' => 'en' ])
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
@include('backend.theme.components.ajax-form-submit', [ 'redirectUrl' => 'admin.master-plan.plot.index' ])
@include('backend.theme.components.ajax-media-delete')
@endpush
