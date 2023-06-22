<div class="btn-group">
    @can('admin.media-room.category.edit')
    {!! dtEditButton(route('admin.media-room.category.edit',$model)) !!}
    @endcan
    @can('admin.media-room.category.destroy')
    {!! dtDeleteButton(['admin.media-room.category.destroy',$model]) !!}
    @endcan
</div>