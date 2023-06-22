@extends('layouts.app')

@section('title', 'Reset Password Email')
@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="/"><img src="{{ asset('backend/dist/img/logo/logo.png') }}" width="100" height="100" /></a>
    </div>
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="/" class="h1"><b>{{ config('app.name') }}</b> <span>&nbsp;CMS</span></a>
        </div>
        <div class="card-body">

            <p class="login-box-msg">{{ __('Reset Password') }}</p>

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="{{ __('Email Address') }}"
                        value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="error invalid-feedback" style="display: inline;"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>


                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link')
                            }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

@endsection