@extends('backend.theme.master', ['page' => 'Create Publication'])

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Publication</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.media-room.publication.index') }}">Publications</a>
                        </li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card card-tabs">

            @include('backend.media-room.publication.includes.form', [
            'model' => null,
            'route' => [
            'route' => ['admin.media-room.publication.store'],
            'method' => 'post',
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