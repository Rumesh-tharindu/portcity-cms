{{-- @include('backend.theme.components.localization-tab') --}}

<div class="card-body">

    {{ Form::model($model, $route) }}
    <div class="row">
        <div class="col-xs-12 col-md-6 form-group">
            <a href="{{ url()->previous() }}" type="button" class="btn btn-sm btn-danger" data-toggle="tooltip"
                title="Edit">
                <i class="fa fa-fw fa-arrow-left "></i> Back
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('product*', null, ['class' => 'control-label']) !!}
            {!! Form::text('product', $product->title, [
            'class' => 'form-control',
            'disabled',
            ]) !!}
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        </div>
    </div>

    <div class="tab-content">

        <div class="tab-pane fade active show" id="custom-tabs-en" role="tabpanel" aria-labelledby="custom-tabs-en-tab">
            @include('backend.custom-table.includes.localization', ['locale' => 'en'])
        </div>
        {{-- <div class="tab-pane fade" id="custom-tabs-si" role="tabpanel" aria-labelledby="custom-tabs-si-tab">
            @include('backend.product-feature.includes.localization', ['locale' => 'si'])
        </div>
        <div class="tab-pane fade" id="custom-tabs-ta" role="tabpanel" aria-labelledby="custom-tabs-ta-tab">
            @include('backend.product-feature.includes.localization', ['locale' => 'ta'])
        </div> --}}

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
@include('backend.theme.components.editor')
@include('backend.theme.components.ajax-form-submit', [
'redirectRoute' => url()->previous(),
])
@endpush
