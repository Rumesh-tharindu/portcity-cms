<div class="btn-group">
    @can('admin.public-registry.public-registry.edit')
    {!! dtEditButton(route('admin.public-registry.public-registry.edit',$model)) !!}
    @endcan
    @can('admin.public-registry.public-registry.destroy')
    {!! dtDeleteButton(['admin.public-registry.public-registry.destroy',$model]) !!}
    @endcan
</div>
