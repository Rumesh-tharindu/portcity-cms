
@foreach ($model->roles()->pluck('name') as $role)
<span class="badge badge-info">{{ $role }}</span>
@endforeach
