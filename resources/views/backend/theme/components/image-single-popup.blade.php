@if(isset($media))
<a href="{{ $media->getUrl() }}" onclick="event.preventDefault();openImageGallery(this);"
    data-title="{{ $media->file_name }}" data-toggle="lightbox"
    data-gallery="hidden-{{$media->collection_name}}-{{ $media->id }}" class="btn btn-dark" title="view">
    <i class="fas fa-eye" aria-hidden="true"></i>
</a>
@endif
