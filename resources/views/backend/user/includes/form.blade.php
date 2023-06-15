<div class="card-body">

    {{ Form::model($model, $route) }}

    <div class="row">
        <div class="col-xs-12  col-md-6 form-group">
            {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '',
            ]) !!}

            {!! errorMessageAjax('name') !!}
        </div>

        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('email', 'Email*', ['class' => 'control-label']) !!}
            {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '',
            ]) !!}

            {!! errorMessageAjax('email') !!}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-3 form-group">
            {!! Form::label('password', 'Password*', ['class' => 'control-label']) !!}
            <span data-tooltip="tooltip"
                title="*Require at least: 8 characters,one letter,one uppercase and one lowercase letter,one number,one symbol.">
                <i class="fas fa-info-circle" style="color: #f3da35"></i></span>
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '',
            ]) !!}

            {!! errorMessageAjax('password') !!}
        </div>

        <div class="col-xs-12 col-md-3 form-group">
            {!! Form::label('password_confirmation', 'Confirm Password*', ['class' => 'control-label']) !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => '']) !!}

            {!! errorMessageAjax('password_confirmation') !!}
        </div>

        <div class="col-xs-12 col-md-6 form-group">
            {!! Form::label('roles', 'Roles*', ['class' => 'control-label']) !!}
            {!! Form::select('roles[]', $roles, $model ?
            $model->roles()->pluck('name', 'name') : old('roles') , ['class' => 'form-control select2',
            'multiple' => 'multiple', 'style'=>'width: 100%;']) !!}

            {!! errorMessageAjax('roles') !!}
        </div>
    </div>

    {!! $model ? updateButton() : saveButton() !!}
    {!! Form::close() !!}
</div>


@push('scripts')
@include('backend.theme.components.ajax-form-submit', [ 'redirectUrl' => 'admin.users.index' ])
@endpush
