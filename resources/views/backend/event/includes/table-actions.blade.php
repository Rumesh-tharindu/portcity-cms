<div class="btn-group">
    @can('admin.activity.edit')
    {!! dtEditButton(route('admin.event.edit',$model)) !!}
    @endcan
    @can('admin.activity.destroy')
    {!! dtDeleteButton(['admin.event.destroy',$model]) !!}
    @endcan
</div>
