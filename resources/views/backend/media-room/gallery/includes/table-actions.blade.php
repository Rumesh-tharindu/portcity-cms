<div class="btn-group">
    @can('admin.media-room.gallery.edit')
    {!! dtEditButton(route('admin.media-room.gallery.edit',$model)) !!}
    @endcan
    @can('admin.media-room.gallery.destroy')
    {!! dtDeleteButton(['admin.media-room.gallery.destroy',$model]) !!}
    @endcan
</div>
