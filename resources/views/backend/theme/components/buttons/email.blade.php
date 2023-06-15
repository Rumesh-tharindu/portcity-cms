@php($url=unserialize($url))
@can($url[0])
<form action="{{route($url[0],$url[1])}}" method="POST">
    @csrf
    @method('put')
    <button type="submit" onclick="return confirm('Are you sure you want to re-send email verification notification?')"
        class="btn btn-sm btn-success dt" data-toggle="tooltip" title="Re-send email">
        <i class="far fa-envelope"></i>
    </button>
</form>
@endcan
