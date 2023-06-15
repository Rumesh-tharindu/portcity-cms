@foreach ($model->permissions as $permission)
<span class="badge badge-info">{{ str_replace(['admin.', 'unisharp.lfm'], ['', 'file-manager'], $permission->name)
    }}</span>
@endforeach
