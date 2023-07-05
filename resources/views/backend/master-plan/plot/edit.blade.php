@extends('backend.theme.master', ['page' => 'Edit Plot'])

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Plot</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.master-plan.plot.index') }}">Plots</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card card-tabs">

            @include('backend.master-plan.plot.includes.form', [
            'model' => $model,
            'route' => [
            'route' => ['admin.master-plan.plot.update', $model],
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

    @if ($model)
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Custom Tables</h3>
            </div>
            <div class="card-body">
                @if (Route::has('admin.custom-table.create'))
                <div class="row">
                    <div class="col-md-12" align="left">
                        <div class="card-header">
                            <a class="btn btn-primary button-rectangle"
                                href="{{ route('admin.custom-table.create', ['plot_id' => $model->id]) }}"><i
                                    class="fa fa-plus-circle"></i>&nbsp;
                                Add New</a>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    @foreach ($model->customTables as $table)
                    <div class="col-12 col-sm-6 col-md-3">
                        <a class="btn btn-block bg-navy mt-2" href="{{ route('admin.custom-table.edit', $table) }}">{{
                            !empty($table->name) ? $table->name : ("tb-$loop->iteration")}}
                            @if (!$table->status)
                            <i class="fa fa-eye-slash"></i>
                            @endif
                            <i class="fa fa-edit"></i>

                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
        <!-- /.card -->
    </section>
    @endif
</div>
<!-- /.content-wrapper -->
@stop