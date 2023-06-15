<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} CMS | Log in </title>

    <link rel="shortcut icon" href="http://lb-cms.test/assets/images/logo/favicon.ico" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="{{ asset('/backend/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- icheck bootstrap -->

    <link rel="stylesheet" href="{{ asset('/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Theme style -->

    <link rel="stylesheet" href="{{ asset('/backend/dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition login-page">



    @yield('content')



    <!-- jQuery -->

    <script src="{{ asset('/backend/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->

    <script src="{{ asset('/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE App -->

    <script src="{{ asset('/backend/dist/js/adminlte.min.js') }}"></script>

</body>

</html>
