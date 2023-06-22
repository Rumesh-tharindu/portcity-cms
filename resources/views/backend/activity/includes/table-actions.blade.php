<div class="btn-group">
    @can('admin.activity.edit')
    {!! dtEditButton(route('admin.activity.edit',$model)) !!}
    @endcan
    @can('admin.activity.destroy')
    {!! dtDeleteButton(['admin.activity.destroy',$model]) !!}
    @endcan
</div>