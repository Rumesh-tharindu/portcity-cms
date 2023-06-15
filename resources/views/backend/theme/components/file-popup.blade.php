@if (!$model->getMedia($collection)->isEmpty())
@foreach ($model->getMedia($collection) as $media)
<div class="btn-group">
    <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-file"></i>&nbsp;
        {{ $media->file_name }}</button>
    <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown"
        aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu" role="menu" style="">
        <a class="dropdown-item" href="{{ $media->getUrl() }}" target="_blank"><i class="fa fa-eye"></i>
            View</a>

        @if (!$required)
        @can('admin.media.destroy')
        <a class="dropdown-item ajax-media-delete" data-id="{{ $media->id }}"
            href="{{ route('admin.media.destroy', $media) }}"><i class="fa fa-times-circle"></i>
            Delete</a>
        @endcan
        @endif

    </div>
</div>
@endforeach

@endif
