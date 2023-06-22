@extends('layouts.app')

@section('title', 'Verify Email')
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

        <p class="login-box-msg">{{ __('Verify Your Email Address') }}</p>

        @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
        @endif
        <p class="login-box-msg">
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
        </p>

        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf

            <div class="row">
                <!-- /.col -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('click here to request another')
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
