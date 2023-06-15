@extends('backend.theme.master', ['page' =>'Dashboard'])
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                {{-- <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Customers</span>
                            <span class="info-box-number">
                                {{$customersCount ?? 0}}
                                <small></small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"></span>
                            <span class="info-box-number">

                                <small></small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-green elevation-1"><i class="fab fa-product-hunt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"></span>
                            <span class="info-box-number"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-briefcase"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"></span>
                            <span class="info-box-number"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-maroon elevation-1"><i class="fas fa-tags"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"></span>
                            <span class="info-box-number"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-newspaper"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"></span>
                            <span class="info-box-number"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-blog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"></span>
                            <span class="info-box-number"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col --> --}}
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12">


                    <div class="card">
                        <div class="card-header">
                            Login Activities
                          </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table class="table table-bordered table-striped datatable dt-select">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">#</th>
                                        <th>User</th>
                                        <th>IP Address</th>
                                        <th>Browser</th>
                                        <th>Location</th>
                                        <th>Login At</th>
                                        <th>Login Successful</th>
                                        <th>Logout At</th>
                                        {{-- <th>Cleared By User</th> --}}
                                    </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
</div>
@stop
@push('scripts')
<script>
    drawDataTable(
        ".datatable",
        "{{ route('admin.dashboard.index') }}",
        [
            {data: 'id', name: 'authentication_log.id'},
            {data: 'authenticatable.name', name: 'authenticatable.name', orderable: false},
            {data: 'ip_address', name: 'authentication_log.ip_address'},
            {data: 'user_agent', name: 'authentication_log.user_agent'},
            {data: 'location', name: 'authentication_log.location'},
            {data: 'login_at', name: 'authentication_log.login_at'},
            {data: 'login_successful', name: 'authentication_log.login_successful'},
            {data: 'logout_at', name: 'authentication_log.logout_at'},
            //{data: 'cleared_by_user', name: 'authentication_logs.cleared_by_user'},
        ]
    );
</script>
@endpush
