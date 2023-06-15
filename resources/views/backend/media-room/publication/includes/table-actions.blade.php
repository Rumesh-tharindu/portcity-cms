<div class="btn-group">
    @can('admin.media-room.publication.edit')
    {!! dtEditButton(route('admin.media-room.publication.edit',$model)) !!}
    @endcan
    @can('admin.media-room.publication.destroy')
    {!! dtDeleteButton(['admin.media-room.publication.destroy',$model]) !!}
    @endcan
</div>
