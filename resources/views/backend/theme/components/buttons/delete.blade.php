@php($url=unserialize($url))
@can($url[0])
<form action="{{route($url[0],$url[1])}}" method="POST" onsubmit="event.preventDefault();submitForm(this);">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-sm btn-danger dt" data-toggle="tooltip" title="Delete">
        <i class="fa fa-fw fa-trash"></i>
    </button>
</form>
@endcan
