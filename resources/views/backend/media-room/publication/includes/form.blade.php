{{-- @include('backend.theme.components.localization-tab') --}}

<div class="card-body">

    {{ Form::model($model, $route) }}

    <div class="row">
        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('category_*', null, ['class' => 'control-label']) !!}
            {!! Form::select('category_id', $categories, null, [
            'placeholder' => 'Please select',
            'class' => 'form-control select2',
            $model ? 'disabled' : ''
            ]) !!}
            {!! errorMessageAjax('category_id') !!}
        </div>
    </div>
    <div class="tab-content">

        <div class="tab-pane fade active show" id="custom-tabs-en" role="tabpanel" aria-labelledby="custom-tabs-en-tab">
            @include('backend.media-room.publication.includes.localization', ['locale' => 'en'])
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

        <div class="col-xs-12 col-md-6 form-group not-media-kit">
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

        <div class="col-xs-12 col-md-6 form-group not-media-kit">
            {!! Form::label('source_url', null, ['class' => 'control-label']) !!}
            {!! Form::url('source', null, [
            'class' => 'form-control',
            ]) !!}
            {!! errorMessageAjax('source') !!}
        </div>

    </div>

    <div class="row not-media-kit">
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

    <div class="row media-kit">
        <div class="col-xs-12 col-md-6 ">
            {!! Form::label('pdf') !!}

            {!! getFilePreview($model, 'pdf', true) !!}

            <div class="custom-file">
                {!! Form::file('pdf', [
                'class' => 'form-control custom-file-input',
                'accept' => 'application/pdf',
                ]) !!}
                <label class="custom-file-label" for="pdf">Choose pdf</label>
            </div>

            {!! errorMessageAjax('pdf') !!}

        </div>
    </div>

    <div class="row not-media-kit">
        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('featured', 'Featured In Home page', ['class' => 'control-label']) !!}
            {!! Form::checkbox('featured', 1, !isset($model) ? false : null, [
            'class' => 'form-control',
            'data-bootstrap-switch',
            ]) !!}
            {!! errorMessageAjax('featured') !!}
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
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
            maxDate : 'now',
        });
</script>
<script>
    $(function() {
        var category_value = $('select[name=category_id]').select2().val();
            showHideInputs(category_value);

            $('select[name=category_id]').on('select2:select', function (e) {
                          category_value = e.params.data.element.value;
                          console.log(category_value);
                        showHideInputs(category_value);
                        });

            function showHideInputs(value = null) {
            if (value === null || value.length < 1) {
            $(".media-kit").hide();
            $(".not-media-kit").hide();
            } else if (value === "3") {
            $(".media-kit").show();
            $(".not-media-kit").hide();
            } else {
            $(".not-media-kit").show();
            $(".media-kit").hide();
            }
            }
    })
</script>
@endpush