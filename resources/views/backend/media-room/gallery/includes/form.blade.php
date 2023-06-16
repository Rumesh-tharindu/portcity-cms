<div class="card-body">

    {{ Form::model($model, $route) }}

    <div class="row">

        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('year', 'Year *', ['class' => 'control-label']) !!}
            <div class="input-group date" id="year" data-target-input="nearest">
                {!! Form::text('year', null, [
                'class' => 'form-control datetimepicker-input',
                'data-target' => '#year',
                ]) !!}
                <div class="input-group-append" data-target="#year" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>

            {!! errorMessageAjax('year') !!}
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            {!! Form::label('images') !!}

            {!! getImagePreview($model, 'images', false) !!}

            {!! Form::file('images[]', [
            'class' => 'filepond',
            'accept' => 'image/jpeg,image/jpg,image/png',
            'multiple',
            'data-allow-reorder' => true,
            'data-max-file-size' => '2MB',
            'data-max-files' => '100',
            ]) !!}

            {!! errorMessageAjax('images') !!}

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            {!! Form::label('video') !!}

            {!! getImagePreview($model, 'video', false) !!}

            {!! Form::file('video[]', [
            'class' => 'filepond',
            'accept' => 'video/mp4,video/ogx,video/oga,video/ogv,video/ogg,video/webm',
            'multiple',
            'data-allow-reorder' => true,
            'data-max-files' => '100',
            ]) !!}

            {!! errorMessageAjax('video') !!}

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
@include('backend.theme.components.ajax-form-submit', ['redirectUrl' => 'admin.media-room.gallery.index'])
@include('backend.theme.components.ajax-media-delete')
<script>
    //Date picker
        $('#year').datetimepicker({
            format: 'YYYY',
            defaultDate: moment().format('YYYY'),
            maxDate : 'now',
        });
</script>
@endpush
