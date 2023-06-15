@php($url=unserialize($url))
@can($url[0])
<form action="{{route($url[0],$url[1])}}" method="POST">
    @csrf
    {{-- @method('delete') --}}
    <button type="submit" onclick="return confirm('Are you sure you want to publish this item?')"
        class="btn btn-sm btn-success dt" data-toggle="tooltip" title="Publish">
        <i class="far fa-thumbs-up"></i>
    </button>
</form>
@endcan
