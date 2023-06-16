@extends('backend.theme.master', ['page'=>'Manage Publications'])

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Publications</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Publications</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">


                <div class="card">

                    @if (Route::has('admin.media-room.publication.create'))
                    <div class="row">
                        <div class="col-md-12" align="left">
                            <div class="card-header">
                                <a class="btn btn-primary button-rectangle"
                                    href="{{route('admin.media-room.publication.create')}}"><i
                                        class="fa fa-plus-circle"></i>&nbsp; Add New</a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped datatable dt-select">
                            <thead>
                                <tr>
                                    <th>Id</th>

                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Action</th>

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
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop

@push('scripts')
<script>
    drawDataTable(
        ".datatable",
        "{{ route('admin.media-room.publication.index') }}",
        [
            {data: 'id', name: 'id'},
            {data: 'title.en', name: 'title.en'},
            {data: 'category.name.en', name: 'category.name.en'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    );
</script>
@endpush