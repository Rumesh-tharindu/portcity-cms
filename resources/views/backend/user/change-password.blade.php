@extends('backend.theme.master', ['page' =>'Change User Password'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item">Change Password</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Password Edit</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                {!! Form::open(['method' => 'POST', 'route' => ['admin.change-password.update']]) !!}

                <div class="row">
                    <div class="col-xs-12 col-md-6 form-group">
                        {!! Form::label('current_password', 'Current Password', ['class' => 'control-label']) !!}
                        {!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => '']) !!}

                        @error('current_password')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-6 form-group">
                        {!! Form::label('password', 'New Password', ['class' => 'control-label']) !!}
                        <span data-tooltip="tooltip"
                            title="*Require at least: 8 characters,one letter,one uppercase and one lowercase letter,one number,one symbol.">
                            <i class="fas fa-info-circle" style="color: #f3da35"></i></span>
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '']) !!}

                        @error('password')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-6 form-group">
                        {!! Form::label('password_confirmation', 'Confirm New Password', ['class' => 'control-label'])
                        !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => ''])
                        !!}

                        @error('password_confirmation')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                </div>
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- </div> -->
        <!-- /.col -->
        <!-- </div> -->
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@stop
