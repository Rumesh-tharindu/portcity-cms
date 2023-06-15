@extends('backend.theme.master', ['page' => 'Create Permissions'])

@section('content')
    <h3 class="page-title">Permissions</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.permissions.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Create
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            {!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>


@stop

