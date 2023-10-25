@extends('backend.theme.master', ['page' => 'Show Inquiry'])

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Show {{ $inquiry->type }} #{{ $inquiry->reference }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.inquiry.index') }}">Inquiries</a></li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-comment-exclamation"></i>
                    Lead generation
                </h3>
            </div>

            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Reference ID</dt>
                    <dd class="col-sm-8">{{ $inquiry->reference }}</dd>
                    <dt class="col-sm-4">Submitted At</dt>
                    <dd class="col-sm-8">{{ $inquiry->created_at->format('Y-m-d H:i:s') }}</dd>
                    <dt class="col-sm-4">Type</dt>
                    <dd class="col-sm-8">{{ $inquiry->type }}</dd>
                    <dt class="col-sm-4">First Name</dt>
                    <dd class="col-sm-8">{{ $inquiry->first_name }}
                    </dd>
                    <dt class="col-sm-4">Last Name</dt>
                    <dd class="col-sm-8">{{ $inquiry->last_name }}
                    </dd>
                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $inquiry->email }}</dd>
                    <dt class="col-sm-4">Contact Number</dt>
                    <dd class="col-sm-8">{{ $inquiry->contact_number }}</dd>
                    <dt class="col-sm-4">Country</dt>
                    <dd class="col-sm-8">{{ $inquiry->country }}</dd>
                    <dt class="col-sm-4">Company</dt>
                    <dd class="col-sm-8">{{ $inquiry->company }}</dd>
                    <dt class="col-sm-4">Message</dt>
                    <dd class="col-sm-8">{{ $inquiry->message }}</dd>
                </dl>
            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop
