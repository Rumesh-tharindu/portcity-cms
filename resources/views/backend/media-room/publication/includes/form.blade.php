{{-- @include('backend.theme.components.localization-tab') --}}

<div class="card-body">

    {{ Form::model($model, $route) }}

    <div class="tab-content">

        <div class="tab-pane fade active show" id="custom-tabs-en" role="tabpanel" aria-labelledby="custom-tabs-en-tab">
            @include('backend.media-room.publication.includes.localization', ['locale' => 'en'])
        </div>

    </div>

    <div class="row">

        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('category_*', null, ['class' => 'control-label']) !!}
            {!! Form::select('category_id', $categories, null, [
            'placeholder' => 'Please select',
            'class' => 'form-control select2',
            ]) !!}
            {!! errorMessageAjax('category_id') !!}
        </div>

        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('featured_image*') !!}
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
            {!! Form::label('published_at', 'Published At *', ['class' => 'control-label']) !!}
            <div class="input-group date" id="publishedAt" data-target-input="nearest">
                {!! Form::text('published_at', null, [
                'class' => 'form-control datetimepicker-input',
                'data-target' => '#publishedAt',
                ]) !!}
                <div class="input-group-append" data-target="#publishedAt" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>

            {!! errorMessageAjax('published_at') !!}
        </div>

        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('source', null, ['class' => 'control-label']) !!}
            {!! Form::url('source', null, [
            'class' => 'form-control',
            ]) !!}
            {!! errorMessageAjax('source') !!}
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            {!! Form::label('slider_images') !!}

            {!! getImagePreview($model, 'slider_images', false) !!}

            {!! Form::file('slider_images[]', [
            'class' => 'filepond',
            'accept' => 'image/jpeg,image/jpg,image/png',
            'multiple',
            'data-allow-reorder' => true,
            'data-max-file-size' => '2MB',
            'data-max-files' => '5',
            ]) !!}

            {!! errorMessageAjax('slider_images') !!}

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
@include('backend.theme.components.editor')
@include('backend.theme.components.filepond')
@include('backend.theme.components.ajax-form-submit', ['redirectUrl' => 'admin.media-room.publication.index'])
@include('backend.theme.components.ajax-media-delete')
<script>
    //Date picker
        $('#publishedAt').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: moment().format('YYYY-MM-DD'),
        });
</script>
@endpush
