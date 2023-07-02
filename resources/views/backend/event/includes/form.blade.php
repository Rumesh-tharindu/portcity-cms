{{-- @include('backend.theme.components.localization-tab') --}}

<div class="card-body">

    {{ Form::model($model, $route) }}


    <div class="tab-content">

        <div class="tab-pane fade active show" id="custom-tabs-en" role="tabpanel" aria-labelledby="custom-tabs-en-tab">
            @include('backend.event.includes.localization', [ 'locale' => 'en' ])
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('one_day', 'One Day *', ['class' => 'control-label']) !!}
            {!! Form::checkbox('one_day', 1, !isset($model) ? false : null, [
            'class' => 'form-control',
            'data-bootstrap-switch',
            ]) !!}
            {!! errorMessageAjax('one_day') !!}
        </div>

    </div>

    <div class="row">

        <div class="col-xs-12 col-md-6 form-group onedate">
            {!! Form::label('Date *', null, ['class' => 'control-label']) !!}

            <div class="input-group date" id="onedate" data-target-input="nearest">
                {!! Form::text("onedate", null, ["class" => ["form-control datetimepicker-input"], 'data-target' => "#onedate"]) !!}

            <div class="input-group-append" data-target="#onedate" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
            </div>

            {!! errorMessageAjax('date_from') !!}
        </div>

        <div class="col-xs-12 col-md-6 form-group multidate">
            {!! Form::label('Date range *', null, ['class' => 'control-label']) !!}
            <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text">
            <i class="far fa-calendar-alt"></i>
            </span>
            </div>
            {!! Form::text("date_range", null, ["id" => 'daterange', "class" => ["form-control"]]) !!}

            </div>

            {!! errorMessageAjax('date_from') !!}
            {!! errorMessageAjax('date_to') !!}

        </div>

        <div class="col-xs-12 col-md-3 form-group">
            {!! Form::label('Time From *', null, ['class' => 'control-label']) !!}
            <div class="input-group date" id="fromtimepicker" data-target-input="nearest">
                {!! Form::text("time_from", null, ["id" => 'daterange', "class" => ["form-control datetimepicker-input"], 'data-target' => "#fromtimepicker"]) !!}
            <div class="input-group-append" data-target="#fromtimepicker" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="far fa-clock"></i></div>
            </div>
            </div>

            {!! errorMessageAjax('time_from') !!}

        </div>

        <div class="col-xs-12 col-md-3 form-group">
            {!! Form::label('Time To *', null, ['class' => 'control-label']) !!}
            <div class="input-group date" id="totimepicker" data-target-input="nearest">
                {!! Form::text("time_to", null, ["id" => 'daterange', "class" => ["form-control datetimepicker-input"], 'data-target' => "#totimepicker"]) !!}
            <div class="input-group-append" data-target="#totimepicker" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="far fa-clock"></i></div>
            </div>
            </div>

            {!! errorMessageAjax('time_to') !!}
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
<script>
      $(function() {

        $(".onedate").hide();
        $(".multidate").show();
    //Date picker
    $('#onedate').datetimepicker({
      format: 'L'
    });
     $('#daterange').daterangepicker();
     $('#fromtimepicker').datetimepicker({
      format: 'LT'
    });
    $('#totimepicker').datetimepicker({
      format: 'LT'
    });

    $('input[name=one_day]').on('switchChange.bootstrapSwitch', function(event, state) {
        if(state) {
        $(".onedate").show();
        $(".multidate").hide();
    }else{
        $(".onedate").hide();
        $(".multidate").show();
    }
});
})
</script>
@include('backend.theme.components.ajax-form-submit', [ 'redirectUrl' => 'admin.event.index' ])
@include('backend.theme.components.ajax-media-delete')
@endpush
