@extends('backend.theme.master', ['page' => 'Edit Custom Table'])

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Custom Table</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        {{-- <li class="breadcrumb-item"><a href="{{ route('admin.custom-table.edit', $model) }}">{{
                                $model->title }}</a></li> --}}
                        <li class="breadcrumb-item active">Edit Custom Table</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card card-tabs">

            @include('backend.custom-table.includes.form', [
            'model' => $model,
            'route' => [
            'route' => ['admin.custom-table.update', $model],
            'method' => 'put',
            'class' => 'ajax-form',
            'files' => true,
            ],
            ])
            <div class="overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop