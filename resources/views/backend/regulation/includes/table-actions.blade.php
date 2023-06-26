<div class="btn-group">
    @can('admin.regulation.edit')
    {!! dtEditButton(route('admin.regulation.edit',$model)) !!}
    @endcan
    @can('admin.regulation.destroy')
    {!! dtDeleteButton(['admin.regulation.destroy',$model]) !!}
    @endcan
</div>
