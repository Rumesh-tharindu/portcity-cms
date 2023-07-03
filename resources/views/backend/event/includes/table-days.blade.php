@if ($model->one_day)
<span class="badge badge-primary">one-day</span>
@else
<span class="badge badge-danger">{{ $model->date_to->diffInDays($model->date_from) }}-days</span>
@endif
