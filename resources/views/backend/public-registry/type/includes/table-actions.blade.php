<div class="btn-group">
    @can('admin.public-registry.type.edit')
    {!! dtEditButton(route('admin.public-registry.type.edit',$model)) !!}
    @endcan
    @can('admin.public-registry.type.destroy')
    {!! dtDeleteButton(['admin.public-registry.type.destroy',$model]) !!}
    @endcan
</div>