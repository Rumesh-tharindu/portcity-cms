@extends('backend.theme.master', ['page' => 'Manage Permissions'])

@section('content')
<h3 class="page-title">Permissions</h3>
<p>
    <a href="{{ route('admin.permissions.create') }}" class="btn btn-success">Add New</a>
</p>

<div class="panel panel-default">
    <div class="panel-heading">
        List
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-bordered table-striped {{ count($permissions) > 0 ? 'datatable' : '' }} dt-select">
            <thead>
                <tr>
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    <th>Name</th>
                    <th>&nbsp;</th>

                </tr>
            </thead>

            <tbody>
                @if (count($permissions) > 0)
                @foreach ($permissions as $permission)
                <tr data-entry-id="{{ $permission->id }}">
                    <td></td>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <a href="{{ route('admin.permissions.edit',[$permission->id]) }}"
                            class="btn btn-xs btn-info">Edit</a>
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('Are you sure?');",
                        'route' => ['admin.permissions.destroy', $permission->id])) !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3">No entries in table</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@stop

@push('scripts')
<script>
    window.route_mass_crud_entries_destroy = '{{ route('admin.permissions.mass_destroy') }}';
</script>
@endpush
