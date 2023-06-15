@php($url=unserialize($url))
@can($url[0])
<form action="{{route($url[0],$url[1])}}" method="POST">
    @csrf
    @method('delete')
    <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger">
        <i class="fa fa-trash"></i>
        &nbsp;Delete
    </button>
</form>
@endcan
