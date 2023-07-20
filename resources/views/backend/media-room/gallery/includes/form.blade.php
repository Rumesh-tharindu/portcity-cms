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

        {!! errorMessageAjax('gallery') !!}

        <div class="col-xs-12 col-md-1 ">
            {!! Form::label('Add') !!}

            <button type="button" class="btn btn-primary form-control" onclick="add_row_gallery();"><i
                    class="fa fa-plus"></i></button>

        </div>

        <div class="col-xs-12 col-md-4">
            {!! Form::label('images_*') !!}

            {!! getImagePreview($model, 'images', false) !!}

            {!! Form::file('gallery[1][image]', [
            'class' => 'filepond',
            'accept' => 'image/jpeg,image/jpg,image/png',
            'data-max-file-size' => '2MB',
            ]) !!}

            {!! errorMessageAjax('gallery.1.image') !!}

        </div>

        <div class="col-xs-12 col-md-6 ">
            {!! Form::label('video_url') !!}

            {!! Form::url('gallery[1][video_url]', null, [
            'class' => 'form-control ',
            ]) !!}

            {!! errorMessageAjax('gallery.1.video_url') !!}

        </div>

        <div class="col-xs-12 col-md-1 ">
            {!! Form::label('sort') !!}

            {!! Form::number('gallery[1][sort]', null, [
            'class' => 'form-control ',
            'min' => 0,
            ]) !!}

            {!! errorMessageAjax('gallery.1.sort') !!}

        </div>

    </div>

    <input type="hidden" name="row_count_gallery"
        value="{{ isset($model) ? ($model->getMedia('images')->count() ?? 1) : 1 }}" id="row_count_gallery">
    <div id="field_wrapper_gallery">
        @isset($model)
        @forelse ($model->getMedia('images') as $image)
        @if ($loop->first)
        @continue
        @endif
        <div class="row row-gallery-{{ $loop->iteration }}">

            <div class="col-xs-12 col-md-1 form-group">
                <button type="button" class="btn btn-danger form-control"
                    onclick="remove_row_gallery({{ $loop->iteration }});"><i class="fa fa-minus"></i></button>

            </div>

            <div class="col-xs-12 col-md-4">

                {!! getImagePreview($model, 'images', false) !!}

                {!! Form::file("gallery[{$loop->iteration}][image]", [
                'class' => 'filepond',
                'accept' => 'image/jpeg,image/jpg,image/png',
                'data-max-file-size' => '2MB',
                ]) !!}

                {!! errorMessageAjax("gallery.{$loop->iteration}.image") !!}

            </div>

            <div class="col-xs-12 col-md-6 ">

                {!! Form::url("gallery[{$loop->iteration}][video_url]", null, [
                'class' => 'form-control ',
                ]) !!}

                {!! errorMessageAjax("gallery.{$loop->iteration}.video_url") !!}

            </div>

            <div class="col-xs-12 col-md-1 ">

                {!! Form::number("gallery[{$loop->iteration}][sort]", null, [
                'class' => 'form-control ',
                'min' => 0,
                ]) !!}

                {!! errorMessageAjax("gallery.{$loop->iteration}.sort") !!}

            </div>

        </div>
        @empty
        @endforelse
        @endisset

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
<script>
    //Date picker
        $('#year').datetimepicker({
            format: 'YYYY',
            defaultDate: moment().format('YYYY'),
            maxDate : 'now',
        });
</script>
<script>
    var field_wrapper_gallery = $('#field_wrapper_gallery');

        function add_row_gallery() {

            var row_count_gallery = $('#row_count_gallery').val();

            var count = parseInt(row_count_gallery) + 1;

            var fieldHTML1 = `
<div class="row row-gallery-${count}">

    <div class="col-xs-12 col-md-1 ">

        <button type="button" class="btn btn-danger form-control" onclick="remove_row_gallery(${count});"><i
                class="fa fa-minus"></i></button>

    </div>

    <div class="col-xs-12 col-md-4">

        <input class="filepond" accept="image/jpeg,image/jpg,image/png" data-max-file-size="2MB" name="gallery[${count}][image]"
            type="file">

        <p class="text-danger error gallery_${count}_image"></p>

    </div>

    <div class="col-xs-12 col-md-6 ">

        <input class="form-control " name="gallery[${count}][video_url]" type="url">

        <p class="text-danger error gallery_${count}_video_url"></p>

    </div>

    <div class="col-xs-12 col-md-1 ">

        <input class="form-control " min="0" name="gallery[${count}][sort]" type="number">

        <p class="text-danger error gallery_${count}_sort"></p>

    </div>

</div>
            `;

            $(field_wrapper_gallery).append(fieldHTML1);

            $('#row_count_gallery').val(count);

            filepondInit();

        }

        function remove_row_gallery(row) {
            $('.row-gallery-' + row).remove();
            $('#row_count_gallery').val($('#row_count_gallery').val() - 1);
        }
</script>
@endpush
