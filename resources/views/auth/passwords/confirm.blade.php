@extends('layouts.app')

@section('content')

<div class="login-logo">
    <a href="/"><img src="{{ asset('backend/dist/img/logo/logo.png') }}" width="100" height="100" /></a>
</div>
<!-- /.login-logo -->
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <a href="/" class="h1"><b>{{ config('app.name') }}</b> <span>&nbsp;CMS</span></a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">{{ __('Confirm Password') }}</p>
        <p class="login-box-msg">{{ __('Please confirm your password before continuing.') }}</p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="error invalid-feedback" style="display: inline;"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="row">

                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Confirm Password') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        @if (Route::has('password.request'))
        <p class="mb-1">
            <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
        </p>
        @endif

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.login-box -->
@endsection
