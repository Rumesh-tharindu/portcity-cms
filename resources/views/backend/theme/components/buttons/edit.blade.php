@php($route = app('router')->getRoutes()->match(app('request')->create($url)))
@can($route->getName())
<a href="{{$url}}" type="button" class="btn btn-sm btn-info" data-toggle="tooltip" title="Edit">
    <i class="fa fa-fw fa-pencil-alt"></i>
</a>
@endcan
