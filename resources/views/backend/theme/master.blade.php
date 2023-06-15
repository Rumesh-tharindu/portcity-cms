<!DOCTYPE html>

<html lang="en">

<head>
    @include('backend.theme.includes.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        @include('backend.theme.includes.header')

        @yield('content')

        @include('backend.theme.includes.footer')
    </div>
    <!-- ./wrapper -->

    @include('backend.theme.includes.scripts')

</body>

</html>

