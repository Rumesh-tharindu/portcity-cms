@extends('backend.theme.master', ['page'=>'Manage FAQs'])

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>FAQs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">FAQs</li>
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

                    @if (Route::has('admin.about.faq.create'))
                    <div class="row">
                        <div class="col-md-12" align="left">
                            <div class="card-header">
                                <a class="btn btn-primary button-rectangle" href="{{route('admin.about.faq.create')}}"><i
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

                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Sort</th>
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
        "{{ route('admin.about.faq.index') }}",
        [
            {data: 'id', name: 'id'},
            {data: 'question.en', name: 'question.en'},
            {data: 'answer.en', name: 'answer.en'},
            {data: 'sort', name: 'sort'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    );
</script>
@endpush
